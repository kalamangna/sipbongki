<?php

namespace App\Console\Commands;

use App\Models\PermohonanSurat;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PrunePermohonanDocuments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permohonan:prune-documents 
                            {--days=180 : Batas usia permohonan berstatus Selesai/Ditolak dalam hitungan hari}
                            {--dry-run : Jalankan simulasi tanpa menghapus berkas fisik secara nyata}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bersihkan berkas lampiran (KTP, KK, Pengantar) dari permohonan yang sudah selesai/ditolak melampaui batas hari retensi';

    /**
     * Kunci dokumen persyaratan di JSON data_surat
     */
    protected array $documentKeys = [
        'dokumen_ktp',
        'dokumen_kk',
        'dokumen_surat_pengantar',
        'dokumen_tempat_usaha',
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $days = (int) $this->option('days');
        $isDryRun = (bool) $this->option('dry-run');

        if ($days < 1) {
            $this->error('Batas hari (--days) harus minimal 1 hari.');
            return self::FAILURE;
        }

        $cutoffDate = now()->subDays($days);

        $this->info("Memeriksa permohonan berstatus Selesai/Ditolak sebelum {$cutoffDate->format('Y-m-d H:i:s')} (retensi {$days} hari)...");
        if ($isDryRun) {
            $this->warn('[DRY-RUN MODE] Tidak ada berkas yang akan dihapus secara nyata.');
        }

        $permohonans = PermohonanSurat::whereIn('status', ['Selesai', 'Ditolak'])
            ->where(function ($q) use ($cutoffDate) {
                $q->where('tanggal_selesai', '<=', $cutoffDate)
                  ->orWhere(function ($sub) use ($cutoffDate) {
                      $sub->whereNull('tanggal_selesai')
                          ->where('updated_at', '<=', $cutoffDate);
                  });
            })
            ->get();

        if ($permohonans->isEmpty()) {
            $this->info('Tidak ada permohonan lama yang memenuhi kriteria retensi.');
            return self::SUCCESS;
        }

        $deletedCount = 0;
        $freedBytes = 0;

        foreach ($permohonans as $permohonan) {
            $dataSurat = $permohonan->data_surat ?? [];
            $modified = false;

            foreach ($this->documentKeys as $key) {
                $filePath = data_get($dataSurat, $key);
                if (empty($filePath)) {
                    continue;
                }

                $deleted = false;

                // Cek di disk local (private)
                if (Storage::disk('local')->exists($filePath)) {
                    $fileSize = Storage::disk('local')->size($filePath);
                    if (!$isDryRun) {
                        Storage::disk('local')->delete($filePath);
                    }
                    $deleted = true;
                    $freedBytes += $fileSize;
                }
                // Fallback cek di disk public (legacy upload)
                elseif (Storage::disk('public')->exists($filePath)) {
                    $fileSize = Storage::disk('public')->size($filePath);
                    if (!$isDryRun) {
                        Storage::disk('public')->delete($filePath);
                    }
                    $deleted = true;
                    $freedBytes += $fileSize;
                }

                if ($deleted) {
                    $deletedCount++;
                    $this->line("  [#{$permohonan->nomor_permohonan}] {$key}: {$filePath}");
                    if (!$isDryRun) {
                        $dataSurat[$key] = null;
                        $modified = true;
                    }
                }
            }

            if ($modified && !$isDryRun) {
                $permohonan->update(['data_surat' => $dataSurat]);
            }
        }

        $freedFormatted = $this->formatBytes($freedBytes);

        if ($isDryRun) {
            $this->info("Simulasi selesai. Ditemukan {$deletedCount} berkas (~{$freedFormatted}) yang dapat dibersihkan dari {$permohonans->count()} permohonan.");
        } else {
            $this->info("Pembersihan berhasil. {$deletedCount} berkas fisik ({$freedFormatted}) telah dihapus dari {$permohonans->count()} permohonan.");
        }

        return self::SUCCESS;
    }

    /**
     * Format bytes into readable format (KB, MB, GB).
     */
    protected function formatBytes(int $bytes): string
    {
        if ($bytes <= 0) return '0 B';
        $units = ['B', 'KB', 'MB', 'GB'];
        $power = min((int) floor(log($bytes, 1024)), count($units) - 1);
        return round($bytes / pow(1024, $power), 2) . ' ' . $units[$power];
    }
}


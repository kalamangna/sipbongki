<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\KartuKeluarga;
use App\Models\Perangkat;
use App\Models\Jabatan;
use App\Models\Lingkungan;
use App\Models\JenisSurat;
use App\Models\PermohonanSurat;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Statistik Utama
        |--------------------------------------------------------------------------
        */

        $totalPenduduk = Penduduk::count();
        $totalKK = KartuKeluarga::count();
        $totalPerangkat = Perangkat::count();
        $totalPermohonan = PermohonanSurat::count();

        /*
        |--------------------------------------------------------------------------
        | Referensi
        |--------------------------------------------------------------------------
        */

        $totalJabatan = Jabatan::count();
        $totalLingkungan = Lingkungan::count();
        $totalJenisSurat = JenisSurat::count();

        /*
        |--------------------------------------------------------------------------
        | Aparatur
        |--------------------------------------------------------------------------
        */

        $perangkatAktif = Perangkat::where('aktif', true)->count();

        /*
        |--------------------------------------------------------------------------
        | Statistik Penduduk
        |--------------------------------------------------------------------------
        */

        $lakiLaki = Penduduk::where('jenis_kelamin', 'L')->count();
        $perempuan = Penduduk::where('jenis_kelamin', 'P')->count();

        $pekerjaanStat = Penduduk::selectRaw('pekerjaan as nama, COUNT(*) as total')
            ->whereNotNull('pekerjaan')
            ->where('pekerjaan', '!=', '')
            ->groupBy('pekerjaan')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $agamaStat = Penduduk::selectRaw('agama as nama, COUNT(*) as total')
            ->whereNotNull('agama')
            ->where('agama', '!=', '')
            ->groupBy('agama')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $statusNikahStat = Penduduk::selectRaw('status_perkawinan as nama, COUNT(*) as total')
            ->whereNotNull('status_perkawinan')
            ->where('status_perkawinan', '!=', '')
            ->groupBy('status_perkawinan')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $usiaStat = [
            '0-17' => 0,
            '18-24' => 0,
            '25-34' => 0,
            '35-49' => 0,
            '50+' => 0,
        ];

        Penduduk::whereNotNull('tanggal_lahir')
            ->select('tanggal_lahir')
            ->toBase()
            ->get()
            ->each(function ($penduduk) use (&$usiaStat) {
                if (empty($penduduk->tanggal_lahir)) {
                    return;
                }

                $umur = \Carbon\Carbon::parse($penduduk->tanggal_lahir)->age;

                if ($umur <= 17) {
                    $usiaStat['0-17']++;
                } elseif ($umur <= 24) {
                    $usiaStat['18-24']++;
                } elseif ($umur <= 34) {
                    $usiaStat['25-34']++;
                } elseif ($umur <= 49) {
                    $usiaStat['35-49']++;
                } else {
                    $usiaStat['50+']++;
                }
            });

        $aktif = Penduduk::where('aktif', true)->count();
        $nonAktif = Penduduk::where('aktif', false)->count();

        /*
        |--------------------------------------------------------------------------
        | Statistik Surat
        |--------------------------------------------------------------------------
        */

        $suratHariIni = PermohonanSurat::whereDate(
            'created_at',
            today()
        )->count();

        $suratDiproses = PermohonanSurat::where(
            'status',
            'Diproses'
        )->count();

        $suratSelesai = PermohonanSurat::where(
            'status',
            'Selesai'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Data Lingkungan
        |--------------------------------------------------------------------------
        */

        $lingkungan = Lingkungan::withCount('penduduk')
            ->orderBy('nama')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Data Terbaru
        |--------------------------------------------------------------------------
        */

        $pendudukTerbaru = Penduduk::with('lingkungan')
            ->latest()
            ->take(5)
            ->get();

        $permohonanTerbaru = PermohonanSurat::with([
                'penduduk',
                'jenisSurat'
            ])
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Chart Jenis Kelamin
        |--------------------------------------------------------------------------
        */

        $chartJK = [
            'labels' => [
                'Laki-laki',
                'Perempuan'
            ],
            'data' => [
                $lakiLaki,
                $perempuan
            ]
        ];

        /*
        |--------------------------------------------------------------------------
        | Chart Status Permohonan
        |--------------------------------------------------------------------------
        */

        $statusCounts = PermohonanSurat::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $chartPelayanan = [
            'labels' => [
                'Menunggu',
                'Diproses',
                'Selesai',
                'Ditolak'
            ],
            'data' => [
                (int) ($statusCounts['Menunggu'] ?? 0),
                (int) ($statusCounts['Diproses'] ?? 0),
                (int) ($statusCounts['Selesai'] ?? 0),
                (int) ($statusCounts['Ditolak'] ?? 0),
            ]
        ];

        /*
        |--------------------------------------------------------------------------
        | Chart Permohonan Bulanan
        |--------------------------------------------------------------------------
        */

        $bulananCounts = PermohonanSurat::whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $chartBulanan = [
            'labels' => [],
            'data'   => [],
        ];

        for ($i = 1; $i <= 12; $i++) {
            $chartBulanan['labels'][] = date('M', mktime(0, 0, 0, $i, 1));
            $chartBulanan['data'][] = (int) ($bulananCounts[$i] ?? 0);
        }

        /*
        |--------------------------------------------------------------------------
        | Chart Penduduk per Lingkungan
        |--------------------------------------------------------------------------
        */

        $chartLingkungan = [
            'labels' => $lingkungan->pluck('nama'),
            'data'   => $lingkungan->pluck('penduduk_count'),
        ];

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard.dashboard',
            compact(
                'totalPenduduk',
                'totalKK',
                'totalPerangkat',
                'totalPermohonan',

                'totalJabatan',
                'totalLingkungan',
                'totalJenisSurat',

                'perangkatAktif',

                'lakiLaki',
                'perempuan',
                'pekerjaanStat',
                'agamaStat',
                'statusNikahStat',
                'usiaStat',

                'aktif',
                'nonAktif',

                'suratHariIni',
                'suratDiproses',
                'suratSelesai',

                'lingkungan',

                'pendudukTerbaru',
                'permohonanTerbaru',

                'chartJK',
                'chartPelayanan',
                'chartBulanan',
                'chartLingkungan'
            )
        );
    }
}
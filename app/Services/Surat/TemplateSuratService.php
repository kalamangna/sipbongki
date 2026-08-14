<?php

namespace App\Services\Surat;

use App\Models\JenisSurat;
use Illuminate\Support\Str;
use InvalidArgumentException;

class TemplateSuratService
{
    /**
     * Mengembalikan view template surat secara otomatis berdasarkan kode surat
     */
    public function getView(JenisSurat $jenisSurat): string
    {
        $normalizedCode = strtoupper(trim($jenisSurat->kode));
        $slugCode = Str::slug($jenisSurat->kode);

        // 1. Mapping langsung berdasarkan kode surat resmi & aliasnya
        $mapped = match ($normalizedCode) {
            'DOMISILI', 'SK-002'
                => 'surat.templates.keterangan-domisili',

            'DOMISILI_USAHA', 'DOMISILI-USAHA'
                => 'surat.templates.domisili-usaha',

            'USAHA', 'SKU'
                => 'surat.templates.usaha',

            'SKTM', 'TIDAK_MAMPU', 'TIDAK-MAMPU'
                => 'surat.templates.surat-keterangan-tidak-mampu',

            'SKBM', 'BELUM_MENIKAH', 'BELUM-MENIKAH'
                => 'surat.templates.surat-keterangan-belum-menikah',

            'KEMATIAN'
                => 'surat.templates.kematian',

            'ORANG-SAMA', 'ORANG_SAMA', 'BEDA_NAMA', 'BEDA-NAMA'
                => 'surat.templates.orang-sama',

            'PINDAH'
                => 'surat.templates.pindah',

            'BELUM_PUNYA_RUMAH', 'BELUM-PUNYA-RUMAH'
                => 'surat.templates.belum-punya-rumah',

            'KELAHIRAN'
                => 'surat.templates.kelahiran',

            'AHLI_WARIS', 'AHLI-WARIS'
                => 'surat.templates.ahli-waris',

            'PENGHASILAN'
                => 'surat.templates.penghasilan',

            'JANDA_DUDA', 'JANDA-DUDA'
                => 'surat.templates.janda-duda',

            default => null,
        };

        if ($mapped && view()->exists($mapped)) {
            return $mapped;
        }

        // 2. Konvensi otomatis berdasarkan slug kode: surat.templates.{slug}
        $conventionalView = "surat.templates.{$slugCode}";
        if (view()->exists($conventionalView)) {
            return $conventionalView;
        }

        // 3. Fallback konvensi dengan prefix: surat.templates.surat-keterangan-{slug}
        $prefixedView = "surat.templates.surat-keterangan-{$slugCode}";
        if (view()->exists($prefixedView)) {
            return $prefixedView;
        }

        if ($mapped) {
            return $mapped;
        }

        throw new InvalidArgumentException(
            "Template surat untuk kode '{$jenisSurat->kode}' belum tersedia di direktori views (surat/templates/)."
        );
    }
}
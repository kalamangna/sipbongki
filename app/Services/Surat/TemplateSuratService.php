<?php

namespace App\Services\Surat;

use App\Models\JenisSurat;
use InvalidArgumentException;

class TemplateSuratService
{
    /**
     * Mengembalikan view template surat
     */
    public function getView(
        JenisSurat $jenisSurat
    ): string {

        /*
        |--------------------------------------------------------------------------
        | Prioritas 1
        | Gunakan template_view dari database
        |--------------------------------------------------------------------------
        */

        if (
            !empty($jenisSurat->template_view)
        ) {

            return $jenisSurat->template_view;

        }

        /*
        |--------------------------------------------------------------------------
        | Prioritas 2
        | Mapping berdasarkan kode surat
        |--------------------------------------------------------------------------
        */

        return match (strtoupper($jenisSurat->kode)) {

            /*
            |--------------------------------------------------------------------------
            | Surat Keterangan
            |--------------------------------------------------------------------------
            */

            'DOMISILI'
                => 'surat.templates.keterangan-domisili',

            'SK-002'
                => 'surat.templates.keterangan-domisili',

            'DOMISILI_USAHA'
                => 'surat.templates.domisili-usaha',

            'USAHA'
                => 'surat.templates.usaha',

            'SKTM'
                => 'surat.templates.sktm',

            'BELUM_MENIKAH'
                => 'surat.templates.belum-menikah',

            'KEMATIAN'
                => 'surat.templates.kematian',

            'PINDAH'
                => 'surat.templates.pindah',

            /*
            |--------------------------------------------------------------------------
            | Template berikut akan ditambahkan
            |--------------------------------------------------------------------------
            */

            'KELAHIRAN'
                => 'surat.templates.kelahiran',

            'AHLI_WARIS'
                => 'surat.templates.ahli-waris',

            'PENGHASILAN'
                => 'surat.templates.penghasilan',

            'BEDA_NAMA'
                => 'surat.templates.beda-nama',

            'BELUM_PUNYA_RUMAH'
                => 'surat.templates.belum-punya-rumah',

            'JANDA_DUDA'
                => 'surat.templates.janda-duda',

            default => throw new InvalidArgumentException(

                "Template surat untuk kode '{$jenisSurat->kode}' belum tersedia."

            )

        };

    }
}
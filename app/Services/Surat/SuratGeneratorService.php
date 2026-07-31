<?php

namespace App\Services\Surat;

use App\Models\PermohonanSurat;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class SuratGeneratorService
{
    protected NomorSuratService $nomorSuratService;

    protected TemplateSuratService $templateService;

    public function __construct(
        NomorSuratService $nomorSuratService,
        TemplateSuratService $templateService
    ) {
        $this->nomorSuratService = $nomorSuratService;
        $this->templateService = $templateService;
    }

    /**
     * Generate Data Surat
     */
    public function generate(
        PermohonanSurat $permohonan
    ): array {

        $permohonan->loadMissing([

            'penduduk',

            'penduduk.lingkungan',

            'jenisSurat',

            'penandatangan',

            'penandatangan.jabatan',

        ]);

        /*
        |--------------------------------------------------------------------------
        | Generate Nomor Surat
        |--------------------------------------------------------------------------
        */

       if (blank($permohonan->nomor_surat)) {

    $permohonan->nomor_surat =
        $this->nomorSuratService
            ->generate($permohonan);

    $permohonan->save();

}

        /*
        |--------------------------------------------------------------------------
        | Template
        |--------------------------------------------------------------------------
        */

        $template =
            $this->templateService
                ->getView(
                    $permohonan->jenisSurat
                );

        /*
        |--------------------------------------------------------------------------
        | Penandatangan
        |--------------------------------------------------------------------------
        */

        $penandatangan =
            $permohonan->penandatangan;

        /*
        |--------------------------------------------------------------------------
        | Format Tanggal
        |--------------------------------------------------------------------------
        */

        Carbon::setLocale('id');

        $tanggalSurat = Carbon::now();

        $tanggalCetak = Carbon::now();

        /*
        |--------------------------------------------------------------------------
        | Return
        |--------------------------------------------------------------------------
        */

        return [

            /*
            |--------------------------------------------------------------------------
            | Blade
            |--------------------------------------------------------------------------
            */

            'template' => $template,

            /*
            |--------------------------------------------------------------------------
            | Data Utama
            |--------------------------------------------------------------------------
            */

            'permohonan' => $permohonan,

            'penduduk' => $permohonan->penduduk,

            'jenisSurat' => $permohonan->jenisSurat,

            /*
            |--------------------------------------------------------------------------
            | Penandatangan
            |--------------------------------------------------------------------------
            */

            'pejabat' => $penandatangan,

            'penandatangan' => $penandatangan,

            'jabatanPenandatangan' => $penandatangan?->jabatan,

            /*
            |--------------------------------------------------------------------------
            | Nomor Surat
            |--------------------------------------------------------------------------
            */

            'nomor_surat' => $permohonan->nomor_surat,

            /*
            |--------------------------------------------------------------------------
            | Tanggal
            |--------------------------------------------------------------------------
            */

            'tanggal_surat' => $tanggalSurat,

            'tanggal_cetak' => $tanggalCetak,

            /*
            |--------------------------------------------------------------------------
            | Khusus Template
            |--------------------------------------------------------------------------
            */

            'anggotaPindah' =>
                $permohonan->anggotaPindah ?? collect(),

        ];
    }

    /**
     * Generate PDF
     */
    public function generatePdf(
        PermohonanSurat $permohonan
    ) {

        $data = $this->generate($permohonan);

        return Pdf::loadView(

                $data['template'],

                $data

            )

            ->setPaper('f4', 'portrait')

            ->stream(

                'Surat-'.$permohonan->nomor_surat.'.pdf'

            );

    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermohonanSurat;
use App\Services\Surat\SuratGeneratorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class SuratController extends Controller
{
    protected SuratGeneratorService $generator;

    public function __construct(SuratGeneratorService $generator)
    {
        $this->generator = $generator;
    }

    /**
     * Preview Surat
     */
    public function preview(
        PermohonanSurat $permohonanSurat
    ): View|RedirectResponse {

        if (! in_array($permohonanSurat->status, [
            'Diproses',
            'Selesai',
        ])) {

            return back()->with(
                'error',
                'Preview hanya dapat dilakukan pada surat yang sedang diproses atau telah selesai.'
            );
        }

        $permohonanSurat->load([

            'penduduk.lingkungan',

            'jenisSurat',

            'penandatangan',

            'penandatangan.jabatan',

        ]);

        try {

            $data = $this->generator->generate(
                $permohonanSurat
            );

            return view(
                $data['template'],
                $data
            );

        } catch (Throwable $e) {

            report($e);

            return back()->with(
                'error',
                config('app.debug')
                    ? $e->getMessage()
                    : 'Terjadi kesalahan saat membuat preview surat.'
            );
        }
    }

    /**
     * Cetak PDF
     */
    public function print(PermohonanSurat $permohonanSurat)
    {
        if (! in_array($permohonanSurat->status, [
            'Diproses',
            'Selesai',
        ])) {

            return back()->with(
                'error',
                'Surat belum dapat dicetak.'
            );
        }

        $permohonanSurat->load([

            'penduduk.lingkungan',

            'jenisSurat',

            'penandatangan',

            'penandatangan.jabatan',

        ]);

        try {

            return $this->generator->generatePdf(
                $permohonanSurat
            );

        } catch (Throwable $e) {

            report($e);

            return back()->with(
                'error',
                config('app.debug')
                    ? $e->getMessage()
                    : 'Gagal mencetak surat.'
            );
        }
    }
}
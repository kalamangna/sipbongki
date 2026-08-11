<?php

namespace App\Services\Surat;

use App\Models\PermohonanSurat;

class NomorSuratService
{
    public function generate(
        PermohonanSurat $permohonan
    ): string {

        $kodeJenis = strtoupper(
            trim($permohonan->jenisSurat->kode)
        );

        $kode = match ($kodeJenis) {

            'SKTM'      => '451.6',

            'DOMISILI'  => '145',

            'SK-002'     => '145',

            'KEMATIAN'  => '474.3',

            'SKBM'      => '145',

            'USAHA'     => '581',

            'ORANG-SAMA'   => '145',


            default     => '470',
        };

        // Ambil nomor terakhir berdasarkan kode surat
        $last = PermohonanSurat::whereNotNull('nomor_surat')
            ->where('nomor_surat', 'like', $kode.'/%')
            ->latest('id')
            ->first();

        $nomorUrut = 1;

        if ($last) {

            $bagian = explode('/', $last->nomor_surat);

            if (isset($bagian[1])) {

                $nomorUrut = ((int) trim($bagian[1])) + 1;

            }
        }

        return sprintf(
            '%s/%03d/Bk-Sut',
            $kode,
            $nomorUrut
        );
    }
}
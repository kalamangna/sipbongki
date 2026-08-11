<?php

namespace App\Exports;

use App\Models\PermohonanSurat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PermohonanSuratExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize
{
    public function collection()
    {
        return PermohonanSurat::with([
            'penduduk',
            'jenisSurat',
            'penandatangan.jabatan',
        ])
        ->orderBy('tanggal_permohonan')
        ->get()
        ->map(function ($item) {

            return [

                $item->nomor_permohonan,

                $item->nomor_surat,

                optional($item->tanggal_permohonan)
                    ?->format('d-m-Y'),

                optional($item->penduduk)->nik,

                optional($item->penduduk)->nama_lengkap,

                optional($item->jenisSurat)->nama,

                optional($item->penandatangan)->nama_lengkap,

                optional(optional($item->penandatangan)->jabatan)->nama,

                $item->status,

                $item->keperluan,

            ];

        });
    }

    public function headings(): array
    {
        return [

            'Nomor Permohonan',

            'Nomor Surat',

            'Tanggal Permohonan',

            'NIK',

            'Nama Pemohon',

            'Jenis Surat',

            'Penandatangan',

            'Jabatan',

            'Status',

            'Keperluan',

        ];
    }
}
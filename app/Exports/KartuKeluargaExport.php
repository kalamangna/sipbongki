<?php

namespace App\Exports;

use App\Models\KartuKeluarga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KartuKeluargaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return KartuKeluarga::select(
            'no_kk',
            'kepala_keluarga_id',
            'alamat',
            'rt',
            'rw'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nomor KK',
            'Kepala Keluarga',
            'Alamat',
            'RT',
            'RW'
        ];
    }
}
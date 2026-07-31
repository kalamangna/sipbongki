<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendudukExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Penduduk::select(
            'nik',
            'nama_lengkap',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'agama',
            'pendidikan',
            'pekerjaan',
            'alamat',
            'rt',
            'rw'
        )->get();
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'Pendidikan',
            'Pekerjaan',
            'Alamat',
            'RT',
            'RW'
        ];
    }
}
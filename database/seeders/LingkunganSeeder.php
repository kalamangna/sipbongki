<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lingkungan;

class LingkunganSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode' => 'L01',
                'nama' => 'Lingkungan Paruntu',
                'ketua_lingkungan' => null,
                'telepon' => null,
                'keterangan' => 'Lingkungan Paruntu Kelurahan Bongki',
                'status' => true,
            ],
            [
                'kode' => 'L02',
                'nama' => 'Lingkungan Popanda',
                'ketua_lingkungan' => null,
                'telepon' => null,
                'keterangan' => 'Lingkungan Popanda Kelurahan Bongki',
                'status' => true,
            ],
            [
                'kode' => 'L03',
                'nama' => 'Lingkungan Benteng',
                'ketua_lingkungan' => null,
                'telepon' => null,
                'keterangan' => 'Lingkungan Benteng Kelurahan Bongki',
                'status' => true,
            ],
            [
                'kode' => 'L04',
                'nama' => 'Lingkungan Samaenre',
                'ketua_lingkungan' => null,
                'telepon' => null,
                'keterangan' => 'Lingkungan Samaenre Kelurahan Bongki',
                'status' => true,
            ],
        ];

        foreach ($data as $item) {
            Lingkungan::updateOrCreate(
                ['kode' => $item['kode']],
                $item
            );
        }
    }
}
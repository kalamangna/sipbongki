<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            [
                'kode' => 'SK-001',
                'nama' => 'Surat Keterangan Tidak Mampu',
                'deskripsi' => 'Digunakan untuk keperluan bantuan sosial.',
                'nomor_urut' => 1,
                'icon' => 'bi-heart-pulse',
                'persyaratan' => "Fotokopi KTP\nFotokopi KK\nSurat Pengantar RT",
                'aktif' => true,
            ],

            [
                'kode' => 'SK-002',
                'nama' => 'Surat Keterangan Domisili',
                'deskripsi' => 'Surat domisili warga.',
                'nomor_urut' => 2,
                'icon' => 'bi-house',
                'persyaratan' => "Fotokopi KTP\nFotokopi KK",
                'aktif' => true,
            ],

            // Tambahkan data lainnya...
        ];

        foreach ($data as $item) {

            JenisSurat::updateOrCreate(

                ['kode' => $item['kode']],

                $item

            );

        }
    }
}
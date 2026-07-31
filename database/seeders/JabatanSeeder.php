<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Lurah
        |--------------------------------------------------------------------------
        */

        $lurah = Jabatan::updateOrCreate(

            ['nama' => 'Lurah'],

            [
                'slug' => 'lurah',
                'parent_id' => null,
                'urutan' => 1,
                'is_penandatangan' => true,
                'aktif' => true,
            ]

        );

        /*
        |--------------------------------------------------------------------------
        | Sekretaris
        |--------------------------------------------------------------------------
        */

        $sekretaris = Jabatan::updateOrCreate(

            ['nama' => 'Sekretaris'],

            [
                'slug' => 'sekretaris',
                'parent_id' => $lurah->id,
                'urutan' => 2,
                'is_penandatangan' => false,
                'aktif' => true,
            ]

        );

        /*
        |--------------------------------------------------------------------------
        | Kepala Seksi
        |--------------------------------------------------------------------------
        */

        $kasiPemerintahan = Jabatan::updateOrCreate(

            ['nama' => 'Kasi Pemerintahan'],

            [
                'slug' => 'kasi-pemerintahan',
                'parent_id' => $sekretaris->id,
                'urutan' => 3,
                'is_penandatangan' => false,
                'aktif' => true,
            ]

        );

        $kasiPelayanan = Jabatan::updateOrCreate(

            ['nama' => 'Kasi Pelayanan'],

            [
                'slug' => 'kasi-pelayanan',
                'parent_id' => $sekretaris->id,
                'urutan' => 4,
                'is_penandatangan' => false,
                'aktif' => true,
            ]

        );

        $kasiPPM = Jabatan::updateOrCreate(

            ['nama' => 'Kasi Pemberdayaan Masyarakat'],

            [
                'slug' => 'kasi-ppm',
                'parent_id' => $sekretaris->id,
                'urutan' => 5,
                'is_penandatangan' => false,
                'aktif' => true,
            ]

        );

        /*
        |--------------------------------------------------------------------------
        | Kepala Lingkungan
        |--------------------------------------------------------------------------
        */

        foreach ([
            'Paruntu',
            'Benteng',
            'Popanda',
            'Samaenre',
        ] as $i => $nama) {

            Jabatan::updateOrCreate(

                [
                    'nama' => 'Kepala Lingkungan ' . $nama
                ],

                [
                    'slug' => Str::slug('kepala-lingkungan-' . $nama),
                    'parent_id' => $lurah->id,
                    'urutan' => 10 + $i,
                    'is_penandatangan' => false,
                    'aktif' => true,
                ]

            );

        }

        /*
        |--------------------------------------------------------------------------
        | Staf
        |--------------------------------------------------------------------------
        */

        Jabatan::updateOrCreate(

            ['nama' => 'Staf Pemerintahan'],

            [
                'slug' => 'staf-pemerintahan',
                'parent_id' => $kasiPemerintahan->id,
                'urutan' => 20,
                'is_penandatangan' => false,
                'aktif' => true,
            ]

        );

        Jabatan::updateOrCreate(

            ['nama' => 'Staf Pelayanan'],

            [
                'slug' => 'staf-pelayanan',
                'parent_id' => $kasiPelayanan->id,
                'urutan' => 21,
                'is_penandatangan' => false,
                'aktif' => true,
            ]

        );

        Jabatan::updateOrCreate(

            ['nama' => 'Staf Pemberdayaan Masyarakat'],

            [
                'slug' => 'staf-ppm',
                'parent_id' => $kasiPPM->id,
                'urutan' => 22,
                'is_penandatangan' => false,
                'aktif' => true,
            ]

        );
    }
}
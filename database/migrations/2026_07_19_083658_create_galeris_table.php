<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create('galeris', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | Informasi Galeri
            |--------------------------------------------------------------------------
            */

            $table->string('judul');

            $table->text('deskripsi')
                ->nullable();



            /*
            |--------------------------------------------------------------------------
            | Media
            |--------------------------------------------------------------------------
            */

            $table->string('gambar');



            /*
            |--------------------------------------------------------------------------
            | Status Publikasi
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [

                'aktif',
                'nonaktif'

            ])
            ->default('aktif');


            $table->timestamps();

        });

    }



    public function down(): void
    {

        Schema::dropIfExists('galeris');

    }

};
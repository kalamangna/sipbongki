<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('website_settings', function (Blueprint $table) {


            $table->id();


            /*
            |--------------------------------------------------------------------------
            | Identitas Website
            |--------------------------------------------------------------------------
            */


            $table->string('nama_website')
                ->default('SiPBongki');


            $table->string('nama_kelurahan')
                ->default('Kelurahan Bongki');



            /*
            |--------------------------------------------------------------------------
            | Media
            |--------------------------------------------------------------------------
            */


            $table->string('logo')
                ->nullable();




            /*
            |--------------------------------------------------------------------------
            | Kontak
            |--------------------------------------------------------------------------
            */


            $table->text('alamat')
                ->nullable();


            $table->string('telepon')
                ->nullable();


            $table->string('email')
                ->nullable();




            /*
            |--------------------------------------------------------------------------
            | Sosial Media
            |--------------------------------------------------------------------------
            */


            $table->string('facebook')
                ->nullable();


            $table->string('instagram')
                ->nullable();


            $table->string('youtube')
                ->nullable();




            /*
            |--------------------------------------------------------------------------
            | Deskripsi
            |--------------------------------------------------------------------------
            */


            $table->text('deskripsi')
                ->nullable();



            $table->timestamps();


        });

    }





    public function down(): void
    {

        Schema::dropIfExists('website_settings');

    }

};
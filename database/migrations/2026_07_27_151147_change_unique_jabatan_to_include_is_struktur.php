<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jabatans', function (Blueprint $table) {

            // hapus unique lama: nama saja
            $table->dropUnique('jabatans_nama_unique');

            // tambah unique baru: nama + jenis jabatan
            $table->unique(
                ['nama', 'is_struktur'],
                'jabatans_nama_is_struktur_unique'
            );

        });
    }


    public function down(): void
    {
        Schema::table('jabatans', function (Blueprint $table) {

            $table->dropUnique(
                'jabatans_nama_is_struktur_unique'
            );

            $table->unique(
                'nama',
                'jabatans_nama_unique'
            );

        });
    }
};
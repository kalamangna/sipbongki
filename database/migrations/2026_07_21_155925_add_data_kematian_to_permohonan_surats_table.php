<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permohonan_surats', function (Blueprint $table) {

            $table->string('hari_meninggal')->nullable();
            $table->date('tanggal_meninggal')->nullable();
            $table->string('tempat_meninggal')->nullable();
            $table->string('sebab_meninggal')->nullable();

            $table->string('nama_pelapor')->nullable();
            $table->string('nik_pelapor')->nullable();
            $table->string('umur_pelapor')->nullable();
            $table->string('pekerjaan_pelapor')->nullable();
            $table->text('alamat_pelapor')->nullable();
            $table->string('hubungan_pelapor')->nullable();

        });
    }


    public function down(): void
    {
        Schema::table('permohonan_surats', function (Blueprint $table) {

            $table->dropColumn([
                'hari_meninggal',
                'tanggal_meninggal',
                'tempat_meninggal',
                'sebab_meninggal',
                'nama_pelapor',
                'nik_pelapor',
                'umur_pelapor',
                'pekerjaan_pelapor',
                'alamat_pelapor',
                'hubungan_pelapor',
            ]);

        });
    }
};
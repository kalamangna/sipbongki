<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permohonan_surats', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Nomor Surat
            |--------------------------------------------------------------------------
            */

            $table->string('nomor_permohonan')->unique();

            $table->string('nomor_surat')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Relasi
            |--------------------------------------------------------------------------
            */

            $table->foreignId('penduduk_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('jenis_surat_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Permohonan
            |--------------------------------------------------------------------------
            */

            $table->date('tanggal_permohonan');

            $table->text('keperluan')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Data Dinamis Surat
            |--------------------------------------------------------------------------
            */

            $table->json('data_surat')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [

                'Menunggu',

                'Diproses',

                'Selesai',

                'Ditolak',

            ])->default('Menunggu');

            /*
            |--------------------------------------------------------------------------
            | Operator
            |--------------------------------------------------------------------------
            */

            $table->foreignId('operator_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Penandatangan
            |--------------------------------------------------------------------------
            */

            $table->foreignId('penandatangan_id')
                ->nullable()
                ->constrained('perangkats')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Penyelesaian
            |--------------------------------------------------------------------------
            */

            $table->date('tanggal_selesai')->nullable();

            $table->text('catatan')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_surats');
    }
};
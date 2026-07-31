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
        Schema::create('perangkats', function (Blueprint $table) {
            $table->id();

            $table->string('nama_lengkap');

            $table->string('nip', 30)->nullable();

            $table->foreignId('jabatan_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->enum('jenis_kelamin', ['L', 'P'])
                  ->nullable();

            $table->string('tempat_lahir')
                  ->nullable();

            $table->date('tanggal_lahir')
                  ->nullable();

            $table->string('pendidikan')
                  ->nullable();

            $table->string('telepon')
                  ->nullable();

            $table->string('email')
                  ->nullable();

            $table->text('alamat')
                  ->nullable();

            $table->date('tanggal_mulai_jabatan')
                  ->nullable();

            $table->date('tanggal_selesai_jabatan')
                  ->nullable();

            $table->string('foto')
                  ->nullable();

            $table->boolean('aktif')
                  ->default(true);

            $table->boolean('dapat_menandatangani')
                  ->default(false);

            $table->text('keterangan')
                  ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkats');
    }
};
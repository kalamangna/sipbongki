<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();

            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);

            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            $table->string('agama')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();

            $table->text('alamat')->nullable();

            $table->foreignId('lingkungan_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();

            $table->boolean('aktif')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
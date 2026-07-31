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
        Schema::create('kartu_keluargas', function (Blueprint $table) {
            $table->id();

            // Nomor Kartu Keluarga
            $table->string('no_kk', 16)->unique();

            // Kepala keluarga (mengacu ke data penduduk)
            $table->foreignId('kepala_keluarga_id')
                  ->nullable()
                  ->constrained('penduduks')
                  ->nullOnDelete();

            // Alamat KK
            $table->text('alamat')->nullable();
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();

            // Lingkungan
            $table->foreignId('lingkungan_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // Status KK
            $table->boolean('aktif')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_keluargas');
    }
};
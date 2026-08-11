<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah relasi kartu keluarga ke tabel penduduks.
     */
    public function up(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->foreignId('kartu_keluarga_id')
                  ->nullable()
                  ->after('lingkungan_id')
                  ->constrained('kartu_keluargas')
                  ->nullOnDelete();
        });
    }

    /**
     * Hapus relasi kartu keluarga dari tabel penduduks.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kartu_keluarga_id');
        });
    }
};
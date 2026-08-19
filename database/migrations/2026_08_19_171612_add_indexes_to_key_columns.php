<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan indeks B-Tree pada kolom-kolom yang sering digunakan
     * sebagai filter pencarian, sorting, dan join.
     */
    public function up(): void
    {
        // permohonan_surats: semua indeks sudah terpasang oleh partial run sebelumnya
        // (idx_permohonan_status, idx_permohonan_nomor_surat, idx_permohonan_jenis_surat_id,
        //  idx_permohonan_penduduk_id, idx_permohonan_created_at)

        // penduduks: idx_penduduk_nama_lengkap sudah ada, tambahkan yang kurang
        Schema::table('penduduks', function (Blueprint $table) {
            $table->index('aktif',         'idx_penduduk_aktif');
            $table->index('lingkungan_id', 'idx_penduduk_lingkungan_id');
        });

        // pengaduans: belum ada indeks tambahan sama sekali
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->index('status',     'idx_pengaduan_status');
            $table->index('created_at', 'idx_pengaduan_created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hanya drop indeks yang ditambahkan oleh migration ini
        // Indeks permohonan_surats dikelola manual (sudah ada sebelum migration dicatat)

        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropIndex('idx_penduduk_aktif');
            $table->dropIndex('idx_penduduk_lingkungan_id');
        });

        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropIndex('idx_pengaduan_status');
            $table->dropIndex('idx_pengaduan_created_at');
        });
    }
};

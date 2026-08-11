<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->boolean('tampilkan_berita')->default(true)->after('meta_keyword');
            $table->boolean('tampilkan_pengumuman')->default(true)->after('tampilkan_berita');
            $table->boolean('tampilkan_agenda')->default(true)->after('tampilkan_pengumuman');
            $table->boolean('tampilkan_galeri')->default(true)->after('tampilkan_agenda');
            $table->boolean('tampilkan_pengaduan')->default(true)->after('tampilkan_galeri');
        });
    }

    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn([
                'tampilkan_berita',
                'tampilkan_pengumuman',
                'tampilkan_agenda',
                'tampilkan_galeri',
                'tampilkan_pengaduan',
            ]);
        });
    }
};

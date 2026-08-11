<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {

            $table->boolean('tampilkan_layanan')
                ->default(true)
                ->after('tampilkan_pengaduan');

            $table->boolean('tampilkan_statistik')
                ->default(true)
                ->after('tampilkan_layanan');

        });
    }

    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {

            $table->dropColumn([
                'tampilkan_layanan',
                'tampilkan_statistik',
            ]);

        });
    }
};
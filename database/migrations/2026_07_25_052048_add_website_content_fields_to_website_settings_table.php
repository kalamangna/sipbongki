<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Hero
            |--------------------------------------------------------------------------
            */

            $table->string('badge')->nullable()->after('deskripsi');

            $table->string('judul_hero')->nullable();

            $table->string('subjudul_hero')->nullable();

            $table->text('deskripsi_hero')->nullable();

            $table->string('gambar_hero')->nullable();

            $table->string('hero_button_1_text')->nullable();

            $table->string('hero_button_1_link')->nullable();

            $table->string('hero_button_2_text')->nullable();

            $table->string('hero_button_2_link')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Kontak Tambahan
            |--------------------------------------------------------------------------
            */

            $table->string('whatsapp')->nullable();

            $table->text('google_maps')->nullable();

            $table->string('jam_pelayanan')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Footer
            |--------------------------------------------------------------------------
            */

            $table->text('footer_text')->nullable();

            $table->string('copyright')->nullable();

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            $table->string('favicon')->nullable();

            $table->string('meta_title')->nullable();

            $table->text('meta_description')->nullable();

            $table->string('meta_keyword')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {

            $table->dropColumn([
                'badge',
                'judul_hero',
                'subjudul_hero',
                'deskripsi_hero',
                'gambar_hero',
                'hero_button_1_text',
                'hero_button_1_link',
                'hero_button_2_text',
                'hero_button_2_link',
                'whatsapp',
                'google_maps',
                'jam_pelayanan',
                'footer_text',
                'copyright',
                'favicon',
                'meta_title',
                'meta_description',
                'meta_keyword',
            ]);
        });
    }
};
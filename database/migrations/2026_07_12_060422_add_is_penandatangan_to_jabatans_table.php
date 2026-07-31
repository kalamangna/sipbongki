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
        Schema::table('jabatans', function (Blueprint $table) {

            $table->unsignedTinyInteger('urutan')
                ->default(99)
                ->after('nama');

            $table->boolean('is_penandatangan')
                ->default(false)
                ->after('urutan');

            $table->boolean('aktif')
                ->default(true)
                ->after('is_penandatangan');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jabatans', function (Blueprint $table) {

            $table->dropColumn([
                'urutan',
                'is_penandatangan',
                'aktif',
            ]);

        });
    }
};
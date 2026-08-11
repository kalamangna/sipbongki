<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jabatans', function (Blueprint $table) {

            $table->boolean('is_struktur')
                  ->default(false)
                  ->after('aktif');

        });
    }

    public function down(): void
    {
        Schema::table('jabatans', function (Blueprint $table) {

            $table->dropColumn('is_struktur');

        });
    }
};
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
        Schema::table('permohonan_surats', function (Blueprint $table) {

            $table->foreignId('pelapor_id')
                ->nullable()
                ->after('penduduk_id')
                ->constrained('penduduks')
                ->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonan_surats', function (Blueprint $table) {

            $table->dropConstrainedForeignId('pelapor_id');

        });
    }
};
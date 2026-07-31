<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perangkats', function (Blueprint $table) {
            if (!Schema::hasColumn('perangkats', 'jabatan_struktur_id')) {
                $table->foreignId('jabatan_struktur_id')
                    ->nullable()
                    ->after('jabatan_id')
                    ->constrained('jabatans')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('perangkats', function (Blueprint $table) {

            $table->dropForeign(['jabatan_struktur_id']);
            $table->dropColumn('jabatan_struktur_id');

        });
    }
};
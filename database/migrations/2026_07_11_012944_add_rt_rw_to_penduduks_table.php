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
        Schema::table('penduduks', function (Blueprint $table) {
            $table->string('rt', 3)->nullable()->after('alamat');
            $table->string('rw', 3)->nullable()->after('rt');
            $table->string('status_validasi_alamat')
                  ->default('Perlu Verifikasi')
                  ->after('rw');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropColumn([
                'rt',
                'rw',
                'status_validasi_alamat',
            ]);
        });
    }
};
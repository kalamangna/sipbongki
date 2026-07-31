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
        Schema::table('jenis_surats', function (Blueprint $table) {
            if (!Schema::hasColumn('jenis_surats', 'kode_surat')) {
                $table->string('kode_surat', 20)->nullable();
            }
            if (!Schema::hasColumn('jenis_surats', 'kode_nomor')) {
                $table->string('kode_nomor', 20)->nullable();
            }
            if (!Schema::hasColumn('jenis_surats', 'nomor_urut')) {
                $table->unsignedInteger('nomor_urut')
                    ->default(0);
            }
            if (!Schema::hasColumn('jenis_surats', 'icon')) {
                $table->string('icon')
                    ->nullable();
            }
            if (!Schema::hasColumn('jenis_surats', 'persyaratan')) {
                $table->text('persyaratan')
                    ->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jenis_surats', function (Blueprint $table) {

            $table->dropColumn([
                'nomor_urut',
                'icon',
                'persyaratan',
            ]);

        });
    }
};
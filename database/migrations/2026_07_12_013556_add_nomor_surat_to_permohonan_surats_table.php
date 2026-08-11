<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run Migration
     */
    public function up(): void
    {
        if (Schema::hasColumn('permohonan_surats', 'nomor_surat')) {
            return;
        }

        Schema::table('permohonan_surats', function (Blueprint $table) {

            $table->string('nomor_surat')
                ->nullable()
                ->unique()
                ->after('nomor_permohonan');

        });
    }

    /**
     * Rollback
     */
    public function down(): void
    {
        if (!Schema::hasColumn('permohonan_surats', 'nomor_surat')) {
            return;
        }

        Schema::table('permohonan_surats', function (Blueprint $table) {

            $table->dropColumn('nomor_surat');

        });
    }
};
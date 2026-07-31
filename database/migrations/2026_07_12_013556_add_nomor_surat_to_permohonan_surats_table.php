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
        Schema::table('permohonan_surats', function (Blueprint $table) {
            if (!Schema::hasColumn('permohonan_surats', 'nomor_surat')) {
                $table->string('nomor_surat')
                    ->nullable()
                    ->unique()
                    ->after('nomor_permohonan');
            }
        });
    }

    /**
     * Rollback
     */
    public function down(): void
    {
        Schema::table('permohonan_surats', function (Blueprint $table) {

            $table->dropColumn('nomor_surat');

        });
    }
};
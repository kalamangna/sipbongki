<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('permohonan_surats', 'data_surat')) {
            return;
        }

        Schema::table('permohonan_surats', function (Blueprint $table) {

            $table->json('data_surat')
                ->nullable()
                ->after('keperluan');

        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('permohonan_surats', 'data_surat')) {
            return;
        }

        Schema::table('permohonan_surats', function (Blueprint $table) {

            $table->dropColumn('data_surat');

        });
    }
};
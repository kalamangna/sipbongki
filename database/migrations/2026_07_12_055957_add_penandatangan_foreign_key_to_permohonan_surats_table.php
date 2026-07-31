<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permohonan_surats', function (Blueprint $table) {

            $table->foreign('penandatangan_id')
                ->references('id')
                ->on('perangkats')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('permohonan_surats', function (Blueprint $table) {

            $table->dropForeign(['penandatangan_id']);

        });
    }
};
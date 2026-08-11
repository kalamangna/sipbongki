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

            if (Schema::hasColumn('jenis_surats', 'template')) {
                $table->dropColumn('template');
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jenis_surats', function (Blueprint $table) {

            if (! Schema::hasColumn('jenis_surats', 'template')) {

                $table->string('template')
                    ->nullable()
                    ->after('deskripsi');

            }

        });
    }
};
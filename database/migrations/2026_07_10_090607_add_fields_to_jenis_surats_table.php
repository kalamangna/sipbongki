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

            $table->unsignedInteger('nomor_urut')
                ->default(0)
                ->after('template');

            $table->string('icon')
                ->nullable()
                ->after('nomor_urut');

            $table->text('persyaratan')
                ->nullable()
                ->after('icon');

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
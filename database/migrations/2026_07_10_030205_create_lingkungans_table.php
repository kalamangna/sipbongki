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
        Schema::create('lingkungans', function (Blueprint $table) {

            $table->id();

            $table->string('kode',20)->unique();

            $table->string('nama',100);

            $table->string('ketua_lingkungan',100)->nullable();

            $table->string('telepon',20)->nullable();

            $table->text('keterangan')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lingkungans');
    }
};
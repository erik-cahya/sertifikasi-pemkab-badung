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
        // Schema::create('pegawai', function (Blueprint $table) {
        //     $table->ulid('ref')->primary();
        //     $table->string('pegawai_nama');
        //     $table->string('pegawai_nik')->unique();
        //     $table->string('pegawai_telp');
        //     $table->string('pegawai_tempat_bekerja');
        //     $table->timestamps();
        // });

        Schema::create('pegawai', function (Blueprint $table) {
            $table->ulid('ref')->primary();
            $table->string('pegawai_nama_hotel');
            $table->unsignedInteger('pegawai_hk');
            $table->unsignedInteger('pegawai_fbs');
            $table->unsignedInteger('pegawai_fbp');
            $table->unsignedInteger('pegawai_fo');
            $table->unsignedInteger('pegawai_eng');
            $table->unsignedInteger('pegawai_oth');
            $table->unsignedInteger('pegawai_total');
            // Dokumen
            $table->string('pegawai_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};

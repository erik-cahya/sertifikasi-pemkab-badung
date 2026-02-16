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
        Schema::create('asesmen', function (Blueprint $table) {
            $table->ulid('ref')->primary();
            $table->foreignUlid('kegiatan_ref')->nullable()->references('ref')->on('kegiatan')->nullOnDelete();
            // $table->foreignUlid('kegiatan_lsp_ref')->nullable()->references('ref')->on('kegiatan_lsp')->nullOnDelete();
            $table->foreignUlid('kegiatan_jadwal_ref')->nullable()->references('ref')->on('kegiatan_jadwal')->nullOnDelete();
            $table->string('nama_lsp');
            $table->string('nama_tuk');
            $table->string('alamat_tuk');
            $table->string('nama_skema');
            $table->date('jadwal_asesmen');
            $table->integer('kuota_harian');

            // TAMBAHAN
            $table->string('nama_penanggung_jawab')->nullable();
            $table->string('no_penanggung_jawab')->nullable();
            $table->string('nama_penyelenggara_uji');
            $table->string('no_penyelenggara_uji');
            $table->string('nama_asesor');
            $table->string('no_asesor');
            $table->string('no_reg_asesor');

            // Dokumen
            $table->string('bukti_asesmen')->nullable();
            $table->string('dokumentasi_asesmen')->nullable();

            $table->foreignUlid('created_by')->nullable()->references('ref')->on('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesmen');
    }
};

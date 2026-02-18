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
        Schema::create('kegiatan_jadwal', function (Blueprint $table) {
            $table->ulid('ref')->primary();
            $table->foreignUlid('lsp_ref')->references('ref')->on('lsp')->cascadeOnDelete();
            $table->foreignUlid('kegiatan_ref')->references('ref')->on('kegiatan')->cascadeOnDelete();
            // $table->foreignUlid('kegiatan_lsp_ref')->nullable()->references('ref')->on('kegiatan_lsp')->nullOnDelete();
            $table->dateTime('mulai_asesmen');
            $table->dateTime('selesai_asesmen');
            $table->integer('kuota_lsp');

            // Dokumen
            $table->string('laporan_asesmen')->nullable();
            $table->string('laporan_asesmen2')->nullable();
            $table->string('laporan_asesmen3')->nullable();
            $table->string('laporan_asesmen4')->nullable();
            $table->string('laporan_asesmen5')->nullable();

            $table->foreignUlid('created_by')->references('ref')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_jadwal');
    }
};

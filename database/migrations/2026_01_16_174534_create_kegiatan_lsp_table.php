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
        // Schema::create('kegiatan_lsp', function (Blueprint $table) {
        //     $table->ulid('ref')->primary();
        //     $table->foreignUlid('kegiatan_ref')->references('ref')->on('kegiatan')->cascadeOnDelete();
        //     $table->foreignUlid('lsp_ref')->references('ref')->on('lsp')->cascadeOnDelete();
        //     $table->integer('kuota_lsp');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_lsp');
    }
};

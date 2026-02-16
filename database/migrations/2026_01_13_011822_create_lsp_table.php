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
        Schema::create('lsp', function (Blueprint $table) {
            $table->ulid('ref')->primary();
            $table->foreignUlid('user_ref')->references('ref')->on('users')->cascadeOnDelete();
            $table->string('lsp_nama');
            $table->string('lsp_no_lisensi')->nullable();
            $table->string('lsp_alamat')->nullable();
            $table->string('lsp_email')->nullable();
            $table->string('lsp_telp')->nullable();
            $table->string('lsp_direktur')->nullable();
            $table->string('lsp_direktur_telp')->nullable();
            $table->text('lsp_logo')->nullable();
            // $table->date('lsp_tanggal_lisensi')->nullable();
            $table->date('lsp_expired_lisensi')->nullable();

            $table->string('nama_cp_1');
            $table->string('nomor_cp_1');
            $table->string('nama_cp_2')->nullable();
            $table->string('nomor_cp_2')->nullable();
            $table->foreignUlid('created_by')->references('ref')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lsp');
    }
};

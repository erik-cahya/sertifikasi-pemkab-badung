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
        Schema::create('tuk', function (Blueprint $table) {
            $table->ulid('ref')->primary();
            $table->foreignUlid('lsp_ref')->references('ref')->on('lsp')->cascadeOnDelete();
            $table->string('tuk_nama');
            $table->string('tuk_alamat');
            $table->string('tuk_email');
            $table->string('tuk_telp');
            $table->string('tuk_cp_nama');
            $table->string('tuk_cp_email');
            $table->string('tuk_cp_telp');
            $table->boolean('tuk_verif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuk');
    }
};

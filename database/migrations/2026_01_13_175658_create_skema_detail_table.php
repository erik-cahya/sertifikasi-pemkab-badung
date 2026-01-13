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
        Schema::create('skema_detail', function (Blueprint $table) {
            $table->ulid('ref')->primary();
            $table->foreignUlid('skema_ref')->references('ref')->on('skema')->cascadeOnDelete();
            $table->string('kode_unit');
            $table->text('judul_unit');
            $table->foreignUlid('created_by')->references('ref')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skema_detail');
    }
};

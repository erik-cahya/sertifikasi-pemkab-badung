<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penandatangan', function (Blueprint $table) {
            $table->ulid('ref')->primary();
            $table->string('kegiatan_jadwal_ref');
            $table->string('tempat_ttd')->default('Mangupura');
            $table->string('nama_dinas')->nullable();
            $table->string('jabatan_penandatangan')->nullable();
            $table->string('nama_penandatangan');
            $table->string('pangkat')->nullable();
            $table->string('nip')->nullable();
            $table->timestamps();

            $table->foreign('kegiatan_jadwal_ref')
                ->references('ref')
                ->on('kegiatan_jadwal')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penandatangan');
    }
};

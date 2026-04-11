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
        Schema::table('kegiatan_jadwal', function (Blueprint $table) {
            $table->string('jadwal_signed')->nullable()->after('laporan_asesmen5');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan_jadwal', function (Blueprint $table) {
            $table->dropColumn('jadwal_signed');
        });
    }
};

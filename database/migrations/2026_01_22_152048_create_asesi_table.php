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
        Schema::create('asesi', function (Blueprint $table) {
            $table->ulid('ref')->primary();
            $table->foreignUlid('kegiatan_ref')->references('ref')->on('kegiatan')->cascadeOnDelete();
            $table->foreignUlid('lsp_ref')->references('ref')->on('lsp')->cascadeOnDelete();
            // GANTI MENJADI FK DENGAN JADWAL ASSEMEN
            $table->foreignUlid('asesmen_ref')->references('ref')->on('asesmen')->cascadeOnDelete();

            // $table->foreignUlid('tuk_ref')->references('ref')->on('tuk')->cascadeOnDelete();
            // $table->foreignUlid('tgl_asesmen')->references('ref')->on('kegiatan_jadwal')->cascadeOnDelete();
            // $table->dateTime('tgl_asesmen');
            // $table->string('skema_asesmen');

            $table->string('nama_lengkap');
            $table->string('nik');
            $table->string('tempat_lahir');
            $table->dateTime('tgl_lahir');
            $table->string('jenis_kelamin');
            $table->string('kewarganegaraan');
            $table->string('alamat');
            $table->string('kode_pos');
            $table->string('telp_rumah')->nullable();
            $table->string('telp_kantor')->nullable();
            $table->string('telp_hp');
            $table->string('email');
            $table->string('pendidikan_terakhir');

            $table->string('nama_perusahaan');
            $table->string('alamat_perusahaan');
            $table->string('departemen');
            $table->string('jabatan');
            $table->string('kode_pos_perusahaan');
            $table->string('telp_perusahaan');
            $table->string('fax_perusahaan')->nullable();
            $table->string('email_perusahaan');

            $table->string('sertikom_file')->nullable();
            $table->string('ijazah_file')->nullable();
            $table->string('ktp_file')->nullable();
            $table->string('keterangan_kerja_file')->nullable();
            $table->string('pas_foto_file')->nullable();

            $table->boolean('status')->nullable();
            $table->boolean('kompeten')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesi');
    }
};

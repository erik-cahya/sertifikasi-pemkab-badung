<?php

namespace Database\Seeders;

use App\Models\AsesiModel;
use App\Models\AsesmenModel;
use App\Models\KegiatanModel;
use App\Models\LSPModel;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AsesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil data FK yang sudah ada di database
        $kegiatan = KegiatanModel::first();
        $lsp = LSPModel::first();
        $asesmen = AsesmenModel::first();

        if (!$kegiatan || !$lsp || !$asesmen) {
            $this->command->warn('Data kegiatan, LSP, atau asesmen belum tersedia. Seeder asesi dibatalkan.');
            return;
        }

        $pendidikan = ['SMK', 'D3', 'S1', 'S2'];
        $departemenList = ['IT', 'Administrasi', 'Keuangan', 'Bidang TIK', 'Produksi'];
        $jabatanList = ['Staff IT', 'Admin', 'Analis Keuangan', 'Pranata Komputer', 'Teknisi'];

        for ($i = 0; $i < 5; $i++) {
            $jk = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $gender = $jk === 'Laki-laki' ? 'male' : 'female';

            AsesiModel::create([
                'kegiatan_ref'        => $kegiatan->ref,
                'lsp_ref'             => $lsp->ref,
                'asesmen_ref'         => $asesmen->ref,
                'nama_lengkap'        => $faker->name($gender),
                'nik'                 => $faker->numerify('51710112########'),
                'tempat_lahir'        => $faker->city(),
                'tgl_lahir'           => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin'       => $jk,
                'kewarganegaraan'     => 'WNI',
                'alamat'              => $faker->address(),
                'kode_pos'            => $faker->postcode(),
                'telp_rumah'          => $faker->optional()->phoneNumber(),
                'telp_kantor'         => $faker->optional()->phoneNumber(),
                'telp_hp'             => $faker->phoneNumber(),
                'email'               => $faker->unique()->safeEmail(),
                'pendidikan_terakhir' => $faker->randomElement($pendidikan),
                'nama_perusahaan'     => $faker->company(),
                'alamat_perusahaan'   => $faker->address(),
                'departemen'          => $faker->randomElement($departemenList),
                'jabatan'             => $faker->randomElement($jabatanList),
                'kode_pos_perusahaan' => $faker->postcode(),
                'telp_perusahaan'     => $faker->phoneNumber(),
                'fax_perusahaan'      => null,
                'email_perusahaan'    => $faker->companyEmail(),
                'nama_kontak_person'  => $faker->name(),
                'no_kontak_person'    => $faker->phoneNumber(),
                'status'              => null,
                'kompeten'            => null,
            ]);
        }

        $this->command->info('5 data asesi berhasil di-seed.');
    }
}

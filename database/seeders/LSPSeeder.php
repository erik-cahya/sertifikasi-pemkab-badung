<?php

namespace Database\Seeders;

use App\Models\LSPModel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LSPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'master@gmail.com')->value('ref');

        $lspEhi = User::create([
            'name' => 'LSP Engineering Hospitality Indonesia',
            'email' => 'info.lspehi@gmail.com',
            'username' => 'lspehi',
            'password' => bcrypt('lspehi123'),
            'roles' => strtolower(trim('lsp')),
            'is_active' => 1
        ]);
        LSPModel::create([
            'user_ref' => $lspEhi->ref,
            'lsp_nama' => 'LSP Engineering Hospitality Indonesia',
            'lsp_no_lisensi' => 'BNSP-LSP-1303-ID',
            'lsp_alamat' => 'Perumahan Taman Mahayu III/No.44, Sempidi, Mengwi, Badung, Bali',
            'lsp_email' => 'info.lspehi@gmail.com',
            'lsp_telp' => '081337803127',
            'lsp_direktur' => 'Drs. I Gusti Nyoman Wiantara, M.M',
            'lsp_direktur_telp' => '087860706785',
            'lsp_logo' => NULL,
            // 'lsp_tanggal_lisensi' => NULL,
            'lsp_expired_lisensi' => '2027-01-24',
            'nama_cp_1' => 'Soni Arimbawa',
            'nomor_cp_1' => '089580033614',
            'nama_cp_2' => 'Indah Melanie',
            'nomor_cp_2' => '081337803127',
            'created_by' => $user,
        ]);

        $lspkomodoflores = User::create([
            'name' => 'LSP Pariwisata Komodo Flores',
            'email' => 'lsppariwisatakomodoflores@gmail.com',
            'username' => 'lspkomodoflores',
            'password' => bcrypt('lspkomodoflores123'),
            'roles' => strtolower(trim('lsp')),
            'is_active' => 1
        ]);
        LSPModel::create([
            'user_ref' => $lspkomodoflores->ref,
            'lsp_nama' => 'LSP Pariwisata Komodo Flores',
            'lsp_no_lisensi' => 'BNSP-LSP-547-ID',
            'lsp_alamat' => 'Jalan Buluh Indah No 147 Denpasar',
            'lsp_email' => 'lsppariwisatakomodoflores@gmail.com',
            'lsp_telp' => '085792658087',
            'lsp_direktur' => 'Intan Gemalapuri',
            'lsp_direktur_telp' => '081353904937',
            'lsp_logo' => NULL,
            // 'lsp_tanggal_lisensi' => NULL,
            'lsp_expired_lisensi' => '2029-08-09',
            'nama_cp_1' => 'Made Mekar',
            'nomor_cp_1' => '085333779354',
            'nama_cp_2' => 'Ega',
            'nomor_cp_2' => '089626436133',
            'created_by' => $user,
        ]);

        $lsppni = User::create([
            'name' => 'LSP Pariwisata Nugraha Internasional',
            'email' => 'lsp.pni777@gmail.com',
            'username' => 'lsppni',
            'password' => bcrypt('lsppni123'),
            'roles' => strtolower(trim('lsp')),
            'is_active' => 1
        ]);
        LSPModel::create([
            'user_ref' => $lsppni->ref,
            'lsp_nama' => 'LSP Pariwisata Nugraha Internasional',
            'lsp_no_lisensi' => 'BNSP-LSP-732-ID',
            'lsp_alamat' => 'Jln. Pandu No.27 Banjar Dukuh Dalung, Kuta Utara',
            'lsp_email' => 'lsp.pni777@gmail.com',
            'lsp_telp' => '085792382157',
            'lsp_direktur' => 'Ni Wayan Wulaningsih',
            'lsp_direktur_telp' => '081916402518',
            'lsp_logo' => NULL,
            // 'lsp_tanggal_lisensi' => NULL,
            'lsp_expired_lisensi' => '2030-05-29',
            'nama_cp_1' => 'Wulan',
            'nomor_cp_1' => '081916402518',
            'nama_cp_2' => 'Setia',
            'nomor_cp_2' => '085792382157',
            'created_by' => $user,
        ]);

        $lspparindo = User::create([
            'name' => 'LSP Triatma Pariwisata Indonesia',
            'email' => 'lsptriatmapariwisataindonesia@gmail.com',
            'username' => 'lspparindo',
            'password' => bcrypt('lspparindo123'),
            'roles' => strtolower(trim('lsp')),
            'is_active' => 1
        ]);
        LSPModel::create([
            'user_ref' => $lspparindo->ref,
            'lsp_nama' => 'LSP Triatma Pariwisata Indonesia',
            'lsp_no_lisensi' => 'BNSP-LSP-019-ID',
            'lsp_alamat' => 'Jl Gatot Subroto Barat No 459C , Denpasar',
            'lsp_email' => 'lsptriatmapariwisataindonesia@gmail.com',
            'lsp_telp' => '081322212279',
            'lsp_direktur' => 'I Ketut Putra Suarthana',
            'lsp_direktur_telp' => '0811394502',
            'lsp_logo' => NULL,
            // 'lsp_tanggal_lisensi' => NULL,
            'lsp_expired_lisensi' => '2030-02-21',
            'nama_cp_1' => 'Rosalina',
            'nomor_cp_1' => '081322212279',
            'nama_cp_2' => 'Vira',
            'nomor_cp_2' => '0881037517754',
            'created_by' => $user,
        ]);

        $lspkphm = User::create([
            'name' => 'LSP Kapal Pesiar Harapan Mulya',
            'email' => 'lspkapalpesiarharapanmulya17@gmail.com',
            'username' => 'lspkphm',
            'password' => bcrypt('lspkphm123'),
            'roles' => strtolower(trim('lsp')),
            'is_active' => 1
        ]);
        LSPModel::create([
            'user_ref' => $lspkphm->ref,
            'lsp_nama' => 'LSP Kapal Pesiar Harapan Mulya',
            'lsp_no_lisensi' => 'BNSP-LSP-800-ID',
            'lsp_alamat' => 'Jl Gatot Subroto Barat No 459C , Denpasar',
            'lsp_email' => 'lspkapalpesiarharapanmulya17@gmail.com',
            'lsp_telp' => '08122102505',
            'lsp_direktur' => 'I Made Sudarsana Adi',
            'lsp_direktur_telp' => '08123656534',
            'lsp_logo' => NULL,
            // 'lsp_tanggal_lisensi' => NULL,
            'lsp_expired_lisensi' => '2025-03-19',
            'nama_cp_1' => 'Agnes',
            'nomor_cp_1' => '08122102505',
            'nama_cp_2' => 'Santi',
            'nomor_cp_2' => '082247211116',
            'created_by' => $user,
        ]);
    }
}

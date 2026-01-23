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
        $userCreated = User::create([
            'name' => 'LSP INDONESIA I',
            'email' => 'lspindonesia@gmail.com',
            'username' => 'lspindo',
            'password' => bcrypt('lspindo'),
            'roles' => strtolower(trim('lsp')),
            'is_active' => 1
        ]);

        LSPModel::create([
            'user_ref' => $userCreated->ref,
            'lsp_nama' => 'LSP Indonesia',
            'lsp_no_lisensi' => 'BNSP-LSP-00000-ID',
            'lsp_alamat' => 'Jln. Ngurah Rai',
            'lsp_email' => 'admin@lsp-indo.com',
            'lsp_telp' => '089599497',
            'lsp_direktur' => 'Pak Ahmad',
            'lsp_direktur_telp' => '9120940392',
            'lsp_logo' => NULL,
            'lsp_tanggal_lisensi' => '2026-01-01',
            'lsp_expired_lisensi' => '2026-10-01',
            'created_by' => $userCreated->ref,
        ]);

        $lspTekno = User::create([
            'name' => 'LSP Teknologi Digital',
            'email' => 'lsptekno@gmail.com',
            'username' => 'lsptekno',
            'password' => bcrypt('lsptekno'),
            'roles' => strtolower(trim('lsp')),
            'is_active' => 1
        ]);

        LSPModel::create([
            'user_ref' => $lspTekno->ref,
            'lsp_nama' => 'LSP P3 Teknologi Digital',
            'lsp_no_lisensi' => 'BNSP-LSP-6504-ID',
            'lsp_alamat' => 'Jln. Demangan Baru, Depok',
            'lsp_email' => 'admin@lsp-teknologi.com',
            'lsp_telp' => '0541848148',
            'lsp_direktur' => 'Makmur',
            'lsp_direktur_telp' => '018412154',
            'lsp_logo' => NULL,
            'lsp_tanggal_lisensi' => '2022-01-01',
            'lsp_expired_lisensi' => '2028-11-08',
            'created_by' => $lspTekno->ref,
        ]);
    }
}

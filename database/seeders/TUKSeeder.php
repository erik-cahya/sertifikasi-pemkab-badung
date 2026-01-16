<?php

namespace Database\Seeders;

use App\Models\TUKModel;
use App\Models\LSPModel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class TUKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'master@gmail.com')->value('ref');
        $lsp = LSPModel::where('lsp_nama', 'LSP Engineering Hospitality Indonesia')->value('ref');


        $data = [
            [
                'ref' => (string) Str::ulid(),
                'lsp_ref' => $lsp,
                'tuk_nama' => 'Sekretariat ACE Bali',
                'tuk_alamat' => 'Jl. Raya Kampus Unud, Jimbaran, Kec. Kuta Sel., Kabupaten Badung, Bali 80364',
                'tuk_email' => 'tuk@gmail.com',
                'tuk_telp' => '08123456789',
                'tuk_cp_nama' => 'Erik',
                'tuk_cp_email' => 'erik@gmail.com',
                'tuk_cp_telp' => '08234567890',
                'tuk_verif' => 0,
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        TUKModel::insert($data);
    }
}

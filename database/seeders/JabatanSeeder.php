<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DepartemenModel;
use App\Models\JabatanModel;
use Illuminate\Support\Str;
use App\Models\User;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'master@gmail.com')->value('ref');
        $departemen = DepartemenModel::where('departemen_nama', 'Engineering')->value('ref');


        $data = [
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $departemen,
                'jabatan_nama' => 'Chief Engineer',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $departemen,
                'jabatan_nama' => 'Assistant Chief Engineer',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $departemen,
                'jabatan_nama' => 'Supervisor Engineer',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        JabatanModel::insert($data);
    }
}

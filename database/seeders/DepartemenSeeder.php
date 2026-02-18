<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DepartemenModel;
use Illuminate\Support\Str;
use App\Models\User;


class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'master@gmail.com')->value('ref');

        $data = [
            [
                'ref' => (string) Str::ulid(),
                'departemen_nama' => 'Engineering',
                'departemen_kode' => 1,
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_nama' => 'Front Office',
                'departemen_kode' => 2,
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_nama' => 'House Keeping',
                'departemen_kode' => 3,
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_nama' => 'Food & Beverage Service',
                'departemen_kode' => 4,
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_nama' => 'Food & Beverage Product',
                'departemen_kode' => 5,
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DepartemenModel::insert($data);
    }
}

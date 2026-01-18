<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PegawaiModel;
use Illuminate\Support\Str;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'ref' => (string) Str::ulid(),
                'pegawai_nama' => 'Beta Pegawai',
                'pegawai_nik' => '000000000000',
                'pegawai_telp' => '081234567890',
                'pegawai_tempat_bekerja' => 'Beta Company',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        PegawaiModel::insert($data);
    }
}

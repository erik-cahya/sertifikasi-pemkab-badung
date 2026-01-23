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
                'pegawai_nama_hotel' => 'Beta Hotel',
                'pegawai_hk' => '10',
                'pegawai_fbs' => '15',
                'pegawai_fbp' => '20',
                'pegawai_fo' => '25',
                'pegawai_eng' => '5',
                'pegawai_oth' => '30',
                'pegawai_total' => 10 + 15 + 20 + 25 + 5 + 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        PegawaiModel::insert($data);
    }
}

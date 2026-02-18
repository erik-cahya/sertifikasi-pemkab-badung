<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Master Admin',
                'email' => 'master@gmail.com',
                'username' => 'masteradmin',
                'password' => bcrypt('master123'),
                'roles' => 'master',
                'is_active' => 1
            ],
            [
                'name' => 'Dinas',
                'email' => 'dinas@gmail.com',
                'username' => 'dinas',
                'password' => bcrypt('dinas123'),
                'roles' => 'dinas',
                'is_active' => 1
            ],
        ];

        foreach ($user as $row) {
            User::create($row);
        }
    }
}

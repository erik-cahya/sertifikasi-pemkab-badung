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
                'name' => 'Admin LSP',
                'email' => 'master@gmail.com',
                'password' => bcrypt('master123'),
                'roles' => 'master',
                'is_active' => 1
            ]
        ];

        foreach ($user as $row) {
            User::create($row);
        }
    }
}

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
        $engineering = DepartemenModel::where('departemen_kode', 1)->value('ref');
        $frontOffice = DepartemenModel::where('departemen_kode', 2)->value('ref');
        $houseKeeping = DepartemenModel::where('departemen_kode', 3)->value('ref');
        $foodBeverageService = DepartemenModel::where('departemen_kode', 4)->value('ref');
        $foodBeverageProduct = DepartemenModel::where('departemen_kode', 5)->value('ref');

        $data = [
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $engineering,
                'jabatan_nama' => 'Director of Engineering',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $engineering,
                'jabatan_nama' => 'Chief Engineer',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $engineering,
                'jabatan_nama' => 'Assistant Chief Engineer',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $engineering,
                'jabatan_nama' => 'Engineering Supervisor',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $engineering,
                'jabatan_nama' => 'Duty Engineer',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $engineering,
                'jabatan_nama' => 'Engineering Technician',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $engineering,
                'jabatan_nama' => 'Electrical Technician',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $engineering,
                'jabatan_nama' => 'Mechanical Technician',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $engineering,
                'jabatan_nama' => 'HVAC Technician',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $engineering,
                'jabatan_nama' => 'Plumbing Technician',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $engineering,
                'jabatan_nama' => 'General Technician',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],


            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $frontOffice,
            //     'jabatan_nama' => 'Front Office Manager',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $frontOffice,
            //     'jabatan_nama' => 'Front Office Supervisor',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $frontOffice,
                'jabatan_nama' => 'Receptionist',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $frontOffice,
            //     'jabatan_nama' => 'Telephone Operator',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $frontOffice,
                'jabatan_nama' => 'Bell Boy',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $frontOffice,
                'jabatan_nama' => 'Front Office',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $houseKeeping,
            //     'jabatan_nama' => 'Executive Housekeeper',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $houseKeeping,
            //     'jabatan_nama' => 'Laundry Manager',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $houseKeeping,
            //     'jabatan_nama' => 'Floor Supervisor',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $houseKeeping,
                'jabatan_nama' => 'Laundry Attendant',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $houseKeeping,
                'jabatan_nama' => 'Room Attendant',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $houseKeeping,
                'jabatan_nama' => 'Public Area Cleaner',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $houseKeeping,
                'jabatan_nama' => 'Housekeeping',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $houseKeeping,
            //     'jabatan_nama' => 'Housekeeping Manager',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],

            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $foodBeverageService,
            //     'jabatan_nama' => 'F&B Director',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $foodBeverageService,
            //     'jabatan_nama' => 'F&B Outlet Manager',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $foodBeverageService,
            //     'jabatan_nama' => 'Head Waiter',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $foodBeverageService,
                'jabatan_nama' => 'Bartender',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $foodBeverageService,
                'jabatan_nama' => 'Waiter/ss',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $foodBeverageProduct,
            //     'jabatan_nama' => 'Executive Chef',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $foodBeverageProduct,
            //     'jabatan_nama' => 'Sous Chef',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $foodBeverageProduct,
            //     'jabatan_nama' => 'Demi Chef',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'ref' => (string) Str::ulid(),
            //     'departemen_ref' => $foodBeverageProduct,
            //     'jabatan_nama' => 'Chef de Partie',
            //     'created_by' => $user,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $foodBeverageProduct,
                'jabatan_nama' => 'Commis Chef',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $foodBeverageProduct,
                'jabatan_nama' => 'Commis Pastry',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $foodBeverageProduct,
                'jabatan_nama' => 'Baker',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ref' => (string) Str::ulid(),
                'departemen_ref' => $foodBeverageProduct,
                'jabatan_nama' => 'Butcher',
                'created_by' => $user,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        JabatanModel::insert($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    public function run()
    {

        $dept = Department::firstOrCreate(
            ['name' => 'Bursary'],
            ['code' => 'BURSARY-' . rand(100, 999)]
        );


        $unit = Unit::firstOrCreate(
            [
                'name' => 'Accounts Unit',
                'department_id' => $dept->id
            ],
            ['code' => 'ACC-' . rand(100, 999)]
        );

        $users = [
            ['System Admin', 'admin@poly.edu.ng', 'admin']
        ];

        foreach ($users as [$name, $email, $role]) {
            User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'department_id' => $dept->id,
                    'unit_id' => $unit->id,
                    'is_active' => true,
                    'role' => $role,
                ]
            );
        }

        $this->command->info('Demo users seeded successfully (Simplified Roles).');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'rector',
            'bursar',
            'deputy_bursar',
            'accountant',
            'cashier',
            'auditor',
            'dept_officer',
            'admin',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Ensure at least one super admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@poly.edu.ng'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('password'),
            ]
        );

        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }
    }
}

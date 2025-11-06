<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DemoSeeder extends Seeder
{
    public function run()
    {
        // Ensure base department & unit exist
        $dept = Department::firstOrCreate(['name' => 'Bursary']);
        $unit = Unit::firstOrCreate(['name' => 'Accounts Unit']);

        // Define all system roles from your eBursary plan
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

        // Create demo users for each role
        $users = [
            ['System Admin', 'admin@poly.edu.ng', 'admin'],
            ['Rector User', 'rector@poly.edu.ng', 'rector'],
            ['Bursar User', 'bursar@poly.edu.ng', 'bursar'],
            ['Deputy Bursar User', 'deputy@poly.edu.ng', 'deputy_bursar'],
            ['Accountant User', 'accountant@poly.edu.ng', 'accountant'],
            ['Cashier User', 'cashier@poly.edu.ng', 'cashier'],
            ['Auditor User', 'auditor@poly.edu.ng', 'auditor'],
            ['Dept Officer', 'officer@poly.edu.ng', 'dept_officer'],
        ];

        foreach ($users as [$name, $email, $role]) {
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'department_id' => $dept->id,
                    'unit_id' => $unit->id,
                    'is_active' => true,
                ]
            );

            // assign role safely (avoid duplicates)
            if (!$user->hasRole($role)) {
                $user->syncRoles([$role]);
            }
        }

        $this->command->info('✅ Demo users and roles seeded successfully.');
    }
}

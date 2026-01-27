<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Budget;
use App\Models\BudgetHead;
use App\Models\Department;

class BudgetSeeder extends Seeder
{
    public function run()
    {
        // Ensure we have a department
        $dept = Department::firstOrCreate(
            ['name' => 'Bursary'],
            ['code' => 'BUR-001']
        );

        // Create a Budget for the current year
        $budget = Budget::create([
            'department_id' => $dept->id,
            'year' => date('Y'),
            'total_amount' => 10000000.00, // 10 Million
            'description' => 'Annual Budget for Bursary Department'
        ]);

        $heads = [
            ['name' => 'Office Equipment', 'allocated_amount' => 2000000.00],
            ['name' => 'Travel & Transport', 'allocated_amount' => 1500000.00],
            ['name' => 'Training & Development', 'allocated_amount' => 3000000.00],
            ['name' => 'General Maintenance', 'allocated_amount' => 1000000.00],
            ['name' => 'Staff Welfare', 'allocated_amount' => 2500000.00],
        ];

        foreach ($heads as $head) {
            BudgetHead::create([
                'budget_id' => $budget->id,
                'name' => $head['name'],
                'allocated_amount' => $head['allocated_amount'],
                'description' => 'Allocation for ' . $head['name']
            ]);
        }

        $this->command->info('Budgets and Budget Heads seeded successfully.');
    }
}

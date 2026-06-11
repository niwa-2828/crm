<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        Employee::insert([
            [
                'id' => 1,
                'name' => 'にわ',
                'company_id' => 6,
            ],
            [
                'id' => 3,
                'name' => 'くろき',
                'company_id' => 2,
            ],
            [
                'id' => 4,
                'name' => 'わたかべ',
                'company_id' => 8,
            ],
        ]);
    }
}

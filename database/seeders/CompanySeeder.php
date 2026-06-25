<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $now = now();
    
        $companies = [
            [
                'name' => 'kuroki',
                'mail' => 'kuroki@kuroki.com',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'niwa',
                'mail' => 'niwa@niwa.com',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'watakabe',
                'mail' => 'watakabe@watakabe.com',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Laravel',
                'mail' => 'laravel@laravel.com',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'index',
                'mail' => 'index@index.com',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
    
        Company::insert($companies);
    }
}

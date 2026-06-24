<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run()
    {
        Company::insert([
            [
                'id' => 2,
                'name' => 'kuroki',
                'mail' => 'kuroki@kuroki.com',
            ],
            [
                'id' => 6,
                'name' => 'niwa',
                'mail' => 'niwa@niwa.com',
            ],
            [
                'id' => 8,
                'name' => 'watakabe',
                'mail' => 'watakabe@watakabe.com',
            ],
            [
                'id' => 10,
                'name' => 'Laravel',
                'mail' => 'laravel@laravel.com',
            ],
            [
                'id' => 11,
                'name' => 'index',
                'mail' => 'index@index.com',
            ],
        ]);
    }
}

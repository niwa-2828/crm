<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        Language::insert([
            [
                'id' => 1,
                'title' => 'Laravel',

            ],
            [
                'id' => 2,
                'title' => 'Vue.js',
            ],
            [
                'id' => 3,
                'title' => 'Python',

            ],
            [
                'id' => 4,
                'title' => 'TypeScript',

            ],
        ]);
    }
}

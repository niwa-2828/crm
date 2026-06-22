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
                'language' => 'Laravel',

            ],
            [
                'id' => 2,
                'language' => 'Vue.js',
            ],
            [
                'id' => 3,
                'language' => 'Python',

            ],
            [
                'id' => 4,
                'language' => 'TypeScript',

            ],
        ]);
    }
}

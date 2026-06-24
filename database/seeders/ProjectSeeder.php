<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        Project::insert([
            [
                'id' => 3,
                'title' => 'kuroki-work',
                'company_id' => 2,
                'detail' => '黒木さんからのお仕事です。',
            ],
            [
                'id' => 4,
                'title' => 'watakabe-work',
                'company_id' => 8,
                'detail' => '自分の仕事です。',
            ],
            [
                'id' => 7,
                'title' => 'niwa-work',
                'company_id' => 6,
                'detail' => '丹羽さんからのお仕事です。',
            ],
            [
                'id' => 6,
                'title' => 'freelance',
                'company_id' => 10,
                'detail' => 'フリーランス向け高単価案件です。注：10万手数料です。',
            ],
        ]);
    }
}

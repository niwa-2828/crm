<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        Attendance::insert([
            [
                'id' => 1,
                'user_id' => 1,
                'clock_in',
                'break_in',
                'break_out',
                'clock_out',
            ],
            [
              'id' => 2,
              'user_id' => 2,
              'clock_in',
              'break_in',
              'break_out',
              'clock_out',
            ],
            [
              'id' => 3,
              'user_id' => 3,
              'clock_in',
              'break_in',
              'break_out',
              'clock_out',
            ],
            [
              'id' => 4,
              'user_id' => 4,
              'clock_in',
              'break_in',
              'break_out',
              'clock_out',
            ],
        ]);
    }
}

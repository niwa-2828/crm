<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
  public function run()
  {
    $attendanceInsertData = [
      [
        'user_id' => 1,
        'work_date' => '2026-06-17',
        'clock_in' => '2026-06-17 09:00:00',
        'break_in' => '2026-06-17 12:00:00',
        'break_out' => '2026-06-17 13:00:00',
        'clock_out' => '2026-06-17 18:00:00',
        'type' => 'clockOut',
        'break_minutes' => 60,
        'work_minutes' => 160,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'user_id' => 1,
        'work_date' => '2026-06-18',
        'clock_in' => '2026-06-18 09:30:00',
        'break_in' => '2026-06-18 12:30:00',
        'break_out' => '2026-06-18 13:30:00',
        'clock_out' => '2026-06-18 18:30:00',
        'type' => 'clockOut',
        'break_minutes' => 60,
        'work_minutes' => 160,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'user_id' => 2,
        'work_date' => '2026-06-17',
        'clock_in' => '2026-06-17 09:00:00',
        'break_in' => '2026-06-17 12:00:00',
        'break_out' => '2026-06-17 13:00:00',
        'clock_out' => '2026-06-17 18:00:00',
        'type' => 'clockOut',
        'break_minutes' => 60,
        'work_minutes' => 160,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'user_id' => 2,
        'work_date' => '2026-06-18',
        'clock_in' => '2026-06-18 09:30:00',
        'break_in' => '2026-06-18 12:30:00',
        'break_out' => '2026-06-18 13:30:00',
        'clock_out' => '2026-06-18 18:30:00',
        'type' => 'clockOut',
        'break_minutes' => 60,
        'work_minutes' => 160,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    Attendance::insert($attendanceInsertData);
  }
}

<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\AttendanceCorrectionRequest;

use App\Enums\AttendanceCorrectionStatus;
use App\Enums\AttendanceStatus;

class AttendanceService
{
  public function getMonthlyAttendances(int $userId)
  {

    $startDate = now()->startOfMonth()->toDateString();
    $endDate = now()->endOfMonth()->toDateString();

    // ログインしたユーザーの打刻データ
    $attendances = Attendance::where('user_id', $userId)
      ->whereBetween('work_date', [$startDate, $endDate])
      ->selectRaw("
        id,
        user_id,
        DATE_FORMAT(work_date, '%c月%e日') as workDate,
        type,
        TIME_FORMAT(clock_in, '%H:%i') as clockInTime,
        TIME_FORMAT(break_in, '%H:%i') as breakInTime,
        TIME_FORMAT(break_out, '%H:%i') as breakOutTime,
        TIME_FORMAT(clock_out, '%H:%i') as clockOutTime
    ")
      ->orderBy('work_date', 'desc')
      ->get();

      foreach ($attendances as $attendance) {
        $attendance->typeLabel = AttendanceStatus::from($attendance->type)->label();
      
        $attendanceCorrectionRequest = AttendanceCorrectionRequest::where('attendance_id', $attendance->id)
          ->where('user_id', $userId)
          ->orderBy('created_at', 'desc')
          ->first();
      
        $attendance->correctionStatus = null;
        $attendance->correctionStatusLabel = '申請なし';
      
        if ($attendanceCorrectionRequest !== null) {
          $attendance->correctionStatus = $attendanceCorrectionRequest->status;
          $attendance->correctionStatusLabel = AttendanceCorrectionStatus::from($attendanceCorrectionRequest->status)->label();
        }
      }
    return $attendances;
  }
}

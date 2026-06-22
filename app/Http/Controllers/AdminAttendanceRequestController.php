<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UpdateAdminAttendanceRequestController;
use App\Http\Requests\UpdateAdminAttendanceRequest;
use App\Models\AttendanceCorrectionRequest;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminAttendanceRequestController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $attendanceCorrectionRequests = AttendanceCorrectionRequest::selectRaw("
      id,
      attendance_id,
      user_id,
      DATE_FORMAT(requested_work_date, '%Y年%m月%d日') as requestedWorkDate,
      TIME_FORMAT(requested_clock_in, '%H:%i') as requestedClockInTime,
      TIME_FORMAT(requested_break_in, '%H:%i') as requestedBreakInTime,
      TIME_FORMAT(requested_break_out, '%H:%i') as requestedBreakOutTime,
      TIME_FORMAT(requested_clock_out, '%H:%i') as requestedClockOutTime,
      reason,
      status,
      DATE_FORMAT(created_at, '%Y年%m月%d日 %H:%i') as requestedAt
      ")
      ->orderBy('created_at', 'desc')
      ->get();

    return Inertia::render('Admin/Attendances/Index', [
      'attendanceCorrectionRequests' => $attendanceCorrectionRequests,
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    try {
      $attendanceCorrectionRequest = AttendanceCorrectionRequest::where('id', $id)
        ->selectRaw("
      id,
      attendance_id,
      user_id,
      DATE_FORMAT(requested_work_date, '%Y年%m月%d日') as requestedWorkDate,
      TIME_FORMAT(requested_clock_in, '%H:%i') as requestedClockInTime,
      TIME_FORMAT(requested_break_in, '%H:%i') as requestedBreakInTime,
      TIME_FORMAT(requested_break_out, '%H:%i') as requestedBreakOutTime,
      TIME_FORMAT(requested_clock_out, '%H:%i') as requestedClockOutTime,
      reason,
      admin_comment,
      status,
      DATE_FORMAT(created_at, '%Y年%m月%d日 %H:%i') as requestedAt
      ")
        ->firstOrFail();

      $attendance = Attendance::where('id', $attendanceCorrectionRequest->attendance_id)
        ->selectRaw("
            id,
            user_id,
            DATE_FORMAT(work_date, '%Y年%m月%d日') as workDate,
            type,
            TIME_FORMAT(clock_in, '%H:%i') as clockInTime,
            TIME_FORMAT(break_in, '%H:%i') as breakInTime,
            TIME_FORMAT(break_out, '%H:%i') as breakOutTime,
            TIME_FORMAT(clock_out, '%H:%i') as clockOutTime
        ")
        ->firstOrFail();

      return Inertia::render('Admin/Attendances/Show', [
        'attendanceCorrectionRequest' => $attendanceCorrectionRequest,
        'attendance' => $attendance,
      ]);
    } catch (ModelNotFoundException $e) {
      return to_route('admin.attendances.index')
        ->with([
          'message' => '指定のデータが見つかりません。',
          'status' => 'danger'
        ]);
    }
  }


  public function approve(UpdateAdminAttendanceRequest $request, $id)
  {
    try {
      $adminComment = $request->input('admin_comment');

      $attendanceCorrectionRequest = AttendanceCorrectionRequest::where('id', $id)
        ->firstOrFail();

      $attendance = Attendance::where('id', $attendanceCorrectionRequest->attendance_id)
        ->firstOrFail();

      $workDate = $attendanceCorrectionRequest->requested_work_date;

      $clockIn = null;
      $breakIn = null;
      $breakOut = null;
      $clockOut = null;

      if ($attendanceCorrectionRequest->requested_clock_in !== null) {
        $clockIn = $workDate . ' ' . $attendanceCorrectionRequest->requested_clock_in;
      }

      if ($attendanceCorrectionRequest->requested_break_in !== null) {
        $breakIn = $workDate . ' ' . $attendanceCorrectionRequest->requested_break_in;
      }

      if ($attendanceCorrectionRequest->requested_break_out !== null) {
        $breakOut = $workDate . ' ' . $attendanceCorrectionRequest->requested_break_out;
      }

      if ($attendanceCorrectionRequest->requested_clock_out !== null) {
        $clockOut = $workDate . ' ' . $attendanceCorrectionRequest->requested_clock_out;
      }

      // 勤怠データの更新
      $approvedAttendance = [
        'work_date' => $workDate,
        'clock_in' => $clockIn,
        'break_in' => $breakIn,
        'break_out' => $breakOut,
        'clock_out' => $clockOut,
      ];

      $attendance->update($approvedAttendance);

      // 承認フラグの更新
      $approvedAttendanceCorrectionRequest = [
        'status' => 'approved',
        'admin_comment' => $adminComment,
      ];

      $attendanceCorrectionRequest->update($approvedAttendanceCorrectionRequest);

      return to_route('admin.attendances.index')
        ->with([
          'message' => '勤怠修正申請を承認しました。',
          'status' => 'success',
        ]);
    } catch (ModelNotFoundException $e) {
      return to_route('admin.attendances.index')
        ->with([
          'message' => '指定のデータが見つかりません。',
          'status' => 'danger',
        ]);
    }
  }


  public function reject(UpdateAdminAttendanceRequest $request, int $id)
  {
    try {
      $adminComment = $request->input('admin_comment');

      $attendanceCorrectionRequest = AttendanceCorrectionRequest::where('id', $id)
        ->firstOrFail();

      $rejectAttendanceCorrectionRequest = [
        'status' => 'rejected',
        'admin_comment' => $adminComment,
      ];

      $attendanceCorrectionRequest->update($rejectAttendanceCorrectionRequest);

      return to_route('admin.attendances.index')
        ->with([
          'message' => '勤怠修正申請を却下しました。',
          'status' => 'success',
        ]);
    } catch (ModelNotFoundException $e) {
      return to_route('admin.attendances.index')
        ->with([
          'message' => '指定のデータが見つかりません。',
          'status' => 'danger',
        ]);
    }
  }
}

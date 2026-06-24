<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Inertia\Inertia;
use Carbon\Carbon;

use App\Http\Requests\StoreAttendanceRequest;
use App\Enums\AttendanceStatus;
use App\Services\AttendanceService;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AttendanceController extends Controller
{

  public function __construct(
    private AttendanceService $attendanceService
  ) {

  }

  public function index()
  {
    $userId = Auth::id();

    $attendance = $this->attendanceService->getMonthlyAttendances($userId);

    return Inertia::render('Attendances/Index', [
      'attendances' => $attendance,
    ]);
  }


  public function create()
  {
    $userId = Auth::id();
    $workDate = now()->toDateString();

    // ログインしたユーザーの打刻データ
    $attendance = Attendance::where('user_id', $userId)
      ->where('work_date', $workDate)
      ->selectRaw("
          id,
          user_id,
          work_date,
          type,
          TIME_FORMAT(clock_in, '%H:%i') as clockInTime,
          TIME_FORMAT(break_in, '%H:%i') as breakInTime,
          TIME_FORMAT(break_out, '%H:%i') as breakOutTime,
          TIME_FORMAT(clock_out, '%H:%i') as clockOutTime
      ")
      ->first();

    $attendanceStatuses = '未出勤';

    if ($attendance !== null) {
      $attendanceStatuses = AttendanceStatus::from($attendance->type)->label();
    }

    return Inertia::render('Attendances/Create', [
      'attendanceInfo' => $attendance,
      'attendanceStatuses' => $attendanceStatuses,

    ]);
  }


  public function store(StoreAttendanceRequest $request)
  {
    $validated = $request->validated();

    $userId = Auth::id();
    $now = $validated['nowTime'];
    $workDate = date('Y-m-d', strtotime($now));

    // ログインしたユーザーが当日打刻をしているかどうか
    $attendance = Attendance::where('user_id', $userId)
      ->where('work_date', $workDate)
      ->first();

    $type = $validated['type'];

    // 出勤 typeカラムがnullのとき
    if ($type === "clockIn" && $attendance === null) {
      $attendanceCreate = Attendance::create([
        'user_id'   => $userId,
        'work_date' => $workDate,
        'type'      => $type,
        'clock_in'  => $now,
      ]);

      return response()->json([
        'time' => date('H:i', strtotime($attendanceCreate->clock_in)),
        'statusLabel' => AttendanceStatus::from($type)->label(),
      ]);
    };

    // 休憩開始　typeカラムがclockInのとき
    if ($type === "breakIn" && $attendance !== null && $attendance->type === "clockIn") {
      Attendance::where('user_id', $userId)
        ->where('work_date', $workDate)
        ->update([
          'type' => $type,
          'break_in' => $now,
        ]);

      return response()->json([
        'time' => date('H:i', strtotime($now)),
        'statusLabel' => AttendanceStatus::from($type)->label(),
      ]);
    };

    // 休憩終了　typeカラムがbreakInのとき
    if ($type === "breakOut" && $attendance !== null && $attendance->type === "breakIn") {
      Attendance::where('user_id', $userId)
        ->where('work_date', $workDate)
        ->update([
          'type' => $type,
          'break_out' => $now,
        ]);

      return response()->json([
        'time' => date('H:i', strtotime($now)),
        'statusLabel' => AttendanceStatus::from($type)->label(),
      ]);
    };

    //退勤　typeカラムがbreakOutのとき
    if ($type === "clockOut" && $attendance !== null && $attendance->type === "breakOut") {
      Attendance::where('user_id', $userId)
        ->where('work_date', $workDate)
        ->update([
          'type' => $type,
          'clock_out' => $now,
        ]);

      return response()->json([
        'time' => date('H:i', strtotime($now)),
        'statusLabel' => AttendanceStatus::from($type)->label(),
      ]);
    };

    return response()->json([
      'time' => null,
      'message' => 'この打刻は、現在の勤怠状態では実行できません。',
    ]);
  }

  public function show()
{
  return Inertia::render('Attendances/Show', [
  ]);
}


  public function edit(int $id)
  {
    try {
      $attendance = Attendance::where('id', $id)
      ->where('user_id', Auth::id())
      ->selectRaw("
          id,
          user_id,
          DATE_FORMAT(work_date, '%Y-%m-%d') as workDate,
          TIME_FORMAT(clock_in, '%H:%i') as clockInTime,
          TIME_FORMAT(break_in, '%H:%i') as breakInTime,
          TIME_FORMAT(break_out, '%H:%i') as breakOutTime,
          TIME_FORMAT(clock_out, '%H:%i') as clockOutTime
      ")
      ->first();

      return Inertia::render('Attendances/Edit', [
        'attendance' => $attendance,
      ]);

    } catch (ModelNotFoundException $e) {
      return to_route('attendances.index')
        ->with([
          'message' => '指定のデータが見つかりません。',
          'status' => 'danger'
        ]);
    }
  }


  public function update(Request $request, int $id)
  {
    //
  }


  public function destroy(int $id)
  { {
      $attendance = Attendance::findOrFail($id);

      $attendance->delete();

      return to_route('attendances.index')
        ->with([
          'message' => '削除しました。',
          'status' => 'danger'
        ]);
    }
  }
}

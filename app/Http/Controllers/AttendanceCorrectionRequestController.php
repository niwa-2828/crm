<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceCorrectionRequest;
use App\Models\AttendanceCorrectionRequest;
use Illuminate\Support\Facades\Auth;

class AttendanceCorrectionRequestController extends Controller
{
  public function store(StoreAttendanceCorrectionRequest $request)
  {
    $validated = $request->validated();

    $requestedClockIn = null;
    $requestedBreakIn = null;
    $requestedBreakOut = null;
    $requestedClockOut = null;
    $reason = null;
  
    if (isset($validated['requested_clock_in'])) {
      $requestedClockIn = $validated['requested_clock_in'];
    }
  
    if (isset($validated['requested_break_in'])) {
      $requestedBreakIn = $validated['requested_break_in'];
    }
  
    if (isset($validated['requested_break_out'])) {
      $requestedBreakOut = $validated['requested_break_out'];
    }
  
    if (isset($validated['requested_clock_out'])) {
      $requestedClockOut = $validated['requested_clock_out'];
    }
  
    if (isset($validated['reason'])) {
      $reason = $validated['reason'];
    }
  
    $attendanceCorrectionRequest = [
      'attendance_id' => $validated['attendance_id'],
      'user_id' => Auth::id(),
      'requested_work_date' => $validated['requested_work_date'],
      'requested_clock_in' => $requestedClockIn,
      'requested_break_in' => $requestedBreakIn,
      'requested_break_out' => $requestedBreakOut,
      'requested_clock_out' => $requestedClockOut,
      'reason' => $reason,
      'status' => 'pending',
    ];

    AttendanceCorrectionRequest::create($attendanceCorrectionRequest);

    return to_route('attendances.index')
      ->with([
        'message' => '勤怠修正を申請しました。',
        'status' => 'success',
      ]);
  }
}

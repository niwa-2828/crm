<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceCorrectionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
      'attendance_id',
      'user_id',
      'requested_work_date',
      'requested_clock_in',
      'requested_break_in',
      'requested_break_out' ,
      'requested_clock_out' ,
      'reason',
      'admin_comment',
      'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Enums\AttendanceStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
  use HasFactory;
  protected $fillable = [
    'user_id',
    'work_date',
    'type',
    'clock_in',
    'break_in',
    'break_out',
    'clock_out',
    'work_minutes',
    'break_minutes',
  ];

  protected $casts = [
    'work_date' => 'date',
    'clock_in' => 'datetime',
    'break_in' => 'datetime',
    'break_out' => 'datetime',
    'clock_out' => 'datetime',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}

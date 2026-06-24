<?php

namespace App\Enums;

enum AttendanceStatus: string
{
  case CLOCK_IN = 'clockIn';
  case BREAK_IN = 'breakIn';
  case BREAK_OUT = 'breakOut';
  case CLOCK_OUT = 'clockOut';

  public function label(): string
  {
    return match ($this) {
      self::CLOCK_IN => '出勤中',
      self::BREAK_IN => '休憩中',
      self::BREAK_OUT => '勤務中',
      self::CLOCK_OUT => '退勤済',
    };
  }
}

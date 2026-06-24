<?php

namespace App\Enums;

enum AttendanceCorrectionStatus: string
{
  case PENDING = 'pending';
  case APPROVED = 'approved';
  case REJECTED = 'rejected';

  public function label(): string
  {
    return match ($this) {
      self::PENDING => '承認待ち',
      self::APPROVED => '承認済み',
      self::REJECTED => '却下済み',
    };
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'company_id',
    'detail',
  ];

  public function company()
  {
    return $this->belongsTo(Company::class);
  }
}

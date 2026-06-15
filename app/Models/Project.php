<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

  public function languages()
  {
    return $this->belongsToMany(Language::class);
  }

}

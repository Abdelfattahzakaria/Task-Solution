<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
  use HasFactory;
  protected $fillable = [
    "name_en",
    "name_ar",
    "grade_id",
  ];
  //---------------------------------------------------------------------------------------------------------------
  //---------------------------------------------------------------------------------------------------------------
  public function grade(): BelongsTo
  {
    return $this->belongsTo(Grade::class);
  }
  //---------------------------------------------------------------------------------------------------------------
  //---------------------------------------------------------------------------------------------------------------
  public function sections():HasMany{
    return $this->hasMany(Section::class);     
  }
} 

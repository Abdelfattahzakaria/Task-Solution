<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Section extends Model
{
  use HasFactory;
  protected $fillable = [
    "name_en",
    "name_ar",
    "grade_id",
    "classroom_id",
  ];
  //---------------------------------------------------------------------------------------------------------------
  //---------------------------------------------------------------------------------------------------------------
  public function grade(): BelongsTo
  {
    return $this->belongsTo(Grade::class);
  }
  //---------------------------------------------------------------------------------------------------------------
  //---------------------------------------------------------------------------------------------------------------
  public function classroom(): BelongsTo
  {
    return $this->belongsTo(Classroom::class);
  }
  //---------------------------------------------------------------------------------------------------------------
  //---------------------------------------------------------------------------------------------------------------
  public function teachers():BelongsToMany{
    return $this->belongsToMany(Teacher::class,"pivotteachersections");
  }
}    
     
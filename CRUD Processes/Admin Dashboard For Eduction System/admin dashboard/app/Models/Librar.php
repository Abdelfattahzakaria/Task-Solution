<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Librar extends Model
{
  use HasFactory;
  protected $fillable = [
    "title",
    "file_name",
    "grade_id",
    "classroom_id",
    "section_id",
    "teacher_id",
  ];
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function teacher(): BelongsTo
  {
    return $this->belongsTo(Teacher::class);
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function grade():BelongsTo{
    return $this->belongsTo(Grade::class);
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function classroom():BelongsTo{
    return $this->belongsTo(Classroom::class);
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function section():BelongsTo{
    return $this->belongsTo(Section::class);
  }
}

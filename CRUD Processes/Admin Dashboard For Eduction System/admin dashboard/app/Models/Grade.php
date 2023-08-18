<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
  use HasFactory;
  protected $fillable = [
    "name_ar",
    "name_en",
    "notes",
  ];
  //---------------------------------------------------------------------------------------------------------------
  //---------------------------------------------------------------------------------------------------------------
  public function classrooms(): HasMany
  {
    return $this->hasMany(Classroom::class);
  }
  //---------------------------------------------------------------------------------------------------------------
  //---------------------------------------------------------------------------------------------------------------
  public function sections():HasMany{
    return $this->hasMany(Section::class);    
  }
}

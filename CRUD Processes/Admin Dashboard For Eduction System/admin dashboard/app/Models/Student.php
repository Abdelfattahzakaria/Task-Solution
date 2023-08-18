<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Student extends Authenticatable      
{
  use HasFactory;
  use SoftDeletes;
  protected $guarded = [];
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------     
  public function gender(): BelongsTo
  {
    return $this->belongsTo(Gender::class);
  }
  //-------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------- 
  public function grade(): BelongsTo
  {
    return $this->belongsTo(Grade::class);
  }
  //-------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------- 
  public function classroom(): BelongsTo
  {
    return $this->belongsTo(Classroom::class);
  }
  //-------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------- 
  public function section(): BelongsTo
  {
    return $this->belongsTo(Section::class);
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function nationalit(): BelongsTo
  {
    return $this->belongsTo(Nationalit::class);
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function pareent(): BelongsTo
  {
    return $this->belongsTo(Pareent::class);
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function images(): MorphMany
  {
    return $this->morphMany("App\Models\Image", "imageable");
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------    
  public function student_account(): HasMany
  {
    return $this->hasMany(Studentsaccounting::class);
  }
  //-------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------- 
  public function attendance(): HasMany
  {
    return $this->hasMany(Attendance::class);  
  }  
}

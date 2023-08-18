<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne; 
class Teacher extends Authenticatable     
{
    use HasFactory;
    protected $fillable=[
      "email",
      "password",
      "name",
      "Name_En",
      "specialtion_id",
      "gender_id",
      "Joining_Date",
      "Address",
    ];       
    //----------------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------------
    public function gender():BelongsTo{
      return $this->belongsTo(Gender::class);  
    }  
    //----------------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------------
    public function specialtion():BelongsTo{
      return $this->belongsTo(Specialtion::class);     
    } 
    //----------------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------------
    public function sections(){
      return $this->belongsToMany(Section::class,"pivotteachersections"); 
    }
}        
             
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gender extends Model
{
    use HasFactory;
    protected $fillable=[
      "Name_Ar",
      "Name_En",  
    ];
    //----------------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------------
    public function teachers():HasMany{
      return $this->hasMany(Teacher::class);  
    }
}    

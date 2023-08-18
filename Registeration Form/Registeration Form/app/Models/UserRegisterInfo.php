<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRegisterInfo extends Model
{
    use HasFactory;
    protected $fillable= ["fname","lname","photoName","created_at","updated_at"]; 
    use SoftDeletes;   
}



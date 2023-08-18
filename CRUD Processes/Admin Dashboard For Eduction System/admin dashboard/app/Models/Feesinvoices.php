<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feesinvoices extends Model
{
    use HasFactory;
    protected $guarded = [];
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function fee(): BelongsTo
    {
        return $this->belongsTo(Fee::class);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function grade():BelongsTo{
        return $this->belongsTo(Grade::class); 
    }

    public function classroom():BelongsTo{
        return $this->belongsTo(Classroom::class);  
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_register_infos', function (Blueprint $table) {
            $table->id();
            $table->string("fname",50);
            $table->string("lname",50); 
            $table->string("photoName");  
            $table->softDeletes();     
            $table->timestamps();
        });
    }
    //------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------
    public function down(): void
    {
        Schema::dropIfExists('user_register_infos');
    }
};
 
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{

    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Email')->unique();
            $table->string('Password');
            $table->string('Name_Ar');
            $table->string('Name_En'); 
            $table->foreignId("specialtion_id")->references("id")->on("specialtions"); 
            $table->foreignId("gender_id")->references("id")->on("genders");   
            $table->date('Joining_Date');
            $table->text('Address');   
        });  
    }  
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
     
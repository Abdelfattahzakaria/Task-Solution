<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('name_ar');
            $table->text('name_en');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId("gender_id")->references("id")->on("genders")->cascadeOnDelete();  
            $table->foreignId("nationalit_id")->references("id")->on("nationalits")->cascadeOnDelete();  
            $table->foreignId("bloodtybe_id")->references("id")->on("bloodtybes")->cascadeOnDelete();
            $table->date('Date_Birth');
            $table->foreignId("grade_id")->references("id")->on("grades")->cascadeOnDelete(); 
            $table->foreignId("classroom_id")->references("id")->on("classrooms")->cascadeOnDelete();   
            $table->foreignId("section_id")->references("id")->on("sections")->cascadeOnDelete();
            $table->foreignId("pareent_id")->references("id")->on("pareents")->cascadeOnDelete();
            $table->string('academic_year');
            $table->softDeletes();  
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
}; 
       
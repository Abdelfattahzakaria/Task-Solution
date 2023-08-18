<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("student_id")->references("id")->on("students")->cascadeOnDelete(); 
            $table->foreignId("from_grade")->constrained(table:"grades",indexName:"from_grade_field");  
            $table->foreignId('from_Classroom')->constrained(table:"classrooms",indexName:"from_Classroom_field");
            $table->foreignId('from_section')->constrained(table:"sections",indexName:"from_section_field"); 
            $table->foreignId("to_grade")->constrained(table:"grades",indexName:"to_grade_field");  
            $table->foreignId('to_Classroom')->constrained(table:"classrooms",indexName:"to_Classroom_field");
            $table->foreignId('to_section')->constrained(table:"sections",indexName:"to_section_field"); 
            $table->string("old_academic_year");
            $table->string("new_academic_year");    
        });
    }      
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};

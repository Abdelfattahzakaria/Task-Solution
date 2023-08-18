<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name_en");
            $table->string("name_ar"); 
            $table->integer("status")->default(1);     
            $table->foreignId("grade_id")->references("id")->on("grades")->cascadeOnDelete(); 
            $table->foreignId("classroom_id")->references("id")->on("classrooms")->cascadeOnDelete();    
        });      
    }
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
       
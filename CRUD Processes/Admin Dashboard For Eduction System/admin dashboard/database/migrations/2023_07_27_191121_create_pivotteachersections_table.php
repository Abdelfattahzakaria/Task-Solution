<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pivotteachersections', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("teacher_id")->references("id")->on("teachers")->cascadeOnDelete();   
            $table->foreignId("section_id")->references("id")->on("sections")->cascadeOnDelete();    
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pivotteachersections');
    }
};  
    
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title_ar');
            $table->string('title_en');
            $table->decimal('amount',8,2); 
            $table->foreignId('grade_id')->references('id')->on('grades')->cascadeOnDelete();
            $table->foreignId('classroom_id')->references('id')->on('classrooms')->cascadeOnDelete();
            $table->string('description')->nullable();
            $table->string('year'); 
            $table->integer('Fee_type'); 
        });
    }      
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{

    public function up(): void
    {
        Schema::create('feesinvoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('invoice_date');
            $table->foreignId('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->foreignId('grade_id')->references('id')->on('grades')->cascadeOnDelete();
            $table->foreignId('classroom_id')->references('id')->on('classrooms')->cascadeOnDelete();
            $table->foreignId('fee_id')->references('id')->on('fees')->cascadeOnDelete();  
            $table->decimal('amount',8,2);
            $table->string('description')->nullable();
        }); 
    }
    public function down(): void 
    {
        Schema::dropIfExists('feesinvoices');
    }
};   

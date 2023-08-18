<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paymentstudents', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->decimal('amount',8,2)->nullable();
            $table->string('description');
            $table->timestamps();
        });  
    }
    public function down(): void
    {
        Schema::dropIfExists('paymentstudents');
    }
};
  
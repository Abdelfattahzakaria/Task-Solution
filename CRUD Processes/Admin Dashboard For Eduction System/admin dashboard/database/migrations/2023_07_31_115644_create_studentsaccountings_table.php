<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('studentsaccountings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->decimal('Debit',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
            $table->string('description')->nullable();
            $table->string('type');
            $table->foreignId('processingfee_id')->nullable()->references('id')->on('processingfees')->cascadeOnDelete();
            $table->foreignId('paymentstudent_id')->nullable()->references('id')->on('paymentstudents')->cascadeOnDelete();
            $table->foreignId('feesinvoice_id')->nullable()->references('id')->on('feesinvoices')->cascadeOnDelete();
            $table->foreignId('receiptstudent_id')->nullable()->references('id')->on('receiptstudents')->cascadeOnDelete();
            $table->timestamps();     
        });       
    }  
    public function down(): void 
    {
        Schema::dropIfExists('studentsaccountings');
    }
};  
    
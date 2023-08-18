<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foundstudents', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('receiptstudent_id')->nullable()->references('id')->on('receiptstudents')->cascadeOnDelete();
            $table->foreignId('paymentstudent_id')->nullable()->references('id')->on('paymentstudents')->cascadeOnDelete();
            $table->decimal('Debit',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
            $table->string('description');
            $table->timestamps(); 
        }); 
    }
    public function down(): void 
    {
        Schema::dropIfExists('foundstudents');
    }
}; 
    
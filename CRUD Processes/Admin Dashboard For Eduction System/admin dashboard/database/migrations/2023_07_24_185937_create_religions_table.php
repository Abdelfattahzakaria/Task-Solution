<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{

    public function up(): void
    {
        Schema::create('religions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name_ar");
            $table->string("name_en");    
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('religions');
    }
};
   
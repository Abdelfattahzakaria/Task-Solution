<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{

    public function up(): void
    {
        Schema::create('parentattachments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("File_Name");
            $table->foreignId("pareent_id")->references("id")->on("pareents")->cascadeOnDelete();    
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('parentattachments');
    }
};
 
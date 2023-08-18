<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pareents', function (Blueprint $table) {
            $table->id();
            $table->string('Email')->unique();
            $table->string('Password');

            //Fatherinformation
            $table->string('Name_Father_Ar');
            $table->string('Name_Father_En');
            $table->string('National_ID_Father');
            $table->string('Passport_ID_Father');
            $table->string('Phone_Father');
            $table->string('Job_Father_Ar');
            $table->string('Job_Father_En');
            $table->string('Address_Father');
            $table->foreignId("father_bloodtybe_id")->constrained(
                table: "bloodtybes",
                indexName: "father_bloodtybe",
            );
            $table->foreignId("father_nationality_id")->constrained(
                table: "nationalits",
                indexName: "father_nationality",
            );
            $table->foreignId("father_religion_id")->constrained(
                table: "religions",
                indexName: "father_religion",
            );  
            //Mother information
            $table->string('Name_Mother_Ar');
            $table->string('Name_Mother_En'); 
            $table->string('National_ID_Mother');
            $table->string('Passport_ID_Mother');
            $table->string('Phone_Mother');  
            $table->string('Job_Mother_Ar');
            $table->string('Job_Mother_En');      
            $table->string('Address_Mother');
            $table->timestamps();
            $table->foreignId("mother_bloodybe_id")->constrained(
                table: "bloodtybes",
                indexName: "mother_bloodtybe",
            );
            $table->foreignId("mother_nationality_id")->constrained(
                table: "nationalits",
                indexName: "mother_nationality",
            );
            $table->foreignId("mother_religion_id")->constrained(
                table: "religions", 
                indexName: "mother_religion",
            );
        });  
    }  
    public function down(): void
    {
        Schema::dropIfExists('pareents');
    }
};
   
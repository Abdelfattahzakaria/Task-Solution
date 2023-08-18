<?php
namespace Database\Seeders;

use App\Models\Specialtion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Specialtionseeder extends Seeder
{
    public function run(): void
    {
       DB::table("specialtions")->delete(); 
       $specializations = [
        ['en'=> 'Arabic', 'ar'=> 'عربي'],
        ['en'=> 'Sciences', 'ar'=> 'علوم'],
        ['en'=> 'Computer', 'ar'=> 'حاسب الي'],
        ['en'=> 'English', 'ar'=> 'انجليزي'],
    ];
    foreach($specializations as $specialization):
      Specialtion::create([
        "Name_Ar"=> $specialization["ar"], 
        "Name_En"=> $specialization["en"], 
      ]);   
    endforeach; 
    } 
} 
   
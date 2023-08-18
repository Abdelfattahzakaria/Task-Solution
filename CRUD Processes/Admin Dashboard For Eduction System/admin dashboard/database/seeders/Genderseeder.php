<?php
namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Genderseeder extends Seeder
{
    public function run(): void
    {
      DB::table("genders")->delete();
      $genders = [
        ['en'=> 'Male', 'ar'=> 'ذكر'],
        ['en'=> 'Female', 'ar'=> 'انثي'],
      ];   
      foreach($genders as $gender): 
        Gender::create([
          "Name_Ar"=> $gender["ar"],
          "Name_En"=> $gender["en"],
        ]);
      endforeach; 
    }     
} 

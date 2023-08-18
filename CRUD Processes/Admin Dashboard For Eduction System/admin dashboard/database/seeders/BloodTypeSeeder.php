<?php
namespace Database\Seeders;
use App\Models\Bloodtybe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BloodTypeSeeder extends Seeder
{
    public function run(): void
    { 
      DB::table("bloodtybes")->delete();  
      $bgs = ['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
      foreach($bgs as $bg):
        Bloodtybe::create([
          "name"=> $bg,   
        ]);
      endforeach; 
    }
}
       
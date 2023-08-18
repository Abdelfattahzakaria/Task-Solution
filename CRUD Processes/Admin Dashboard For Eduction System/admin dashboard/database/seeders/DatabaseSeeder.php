<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BloodType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(NationalitySeeder::class); 
        $this->call(ReligionSeeder::class);     
        $this->call(BloodTypeSeeder::class);  
        $this->call(Genderseeder::class);   
        $this->call(Specialtionseeder::class);   
        $this->call(SettingDataTable::class); 
    }
}    
   
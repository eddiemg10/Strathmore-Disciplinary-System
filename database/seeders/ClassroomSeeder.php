<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i < 7; $i++){
            Classroom::create([
                "name" => "Grade ".$i,
            ]);
        }

        for($i=7; $i < 9; $i++){
            Classroom::create([
                "name" => "Class ".$i,
            ]);
        }

        for($i=1; $i < 5; $i++){
            Classroom::create([
                "name" => "Form ".$i." A",
            ]);

            Classroom::create([
                "name" => "Form ".$i." α",
            ]);
        }
        
    }
}

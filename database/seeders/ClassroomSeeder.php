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
                "class_teacher" => ($i+10),
            ]);
        }

        for($i=7; $i < 9; $i++){
            Classroom::create([
                "name" => "Class ".$i,
                "class_teacher" => ($i+10),

            ]);
        }

        for($i=1; $i < 5; $i++){
            Classroom::create([
                "name" => "Form ".$i." A",
                "class_teacher" => ($i+18),

            ]);

            Classroom::create([
                "name" => "Form ".$i." α",
                "class_teacher" => ($i+18),

            ]);
        }
        
    }
}

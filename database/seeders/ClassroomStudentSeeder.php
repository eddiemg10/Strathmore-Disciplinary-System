<?php

namespace Database\Seeders;

use App\Models\ClassroomStudent;
use Illuminate\Database\Seeder;

class ClassroomStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

            for($i = 1; $i < 17; $i++){

                $start = 1;
                $stop = 41;

                for($j=$start; $j < $stop; $j++){
                    ClassroomStudent::create([
                        "student_id" => $j,
                        "classroom_id" => $i,
                    ]);
                }

                $start+=40;
                $stop+=40;
                
            }

        
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $i = 1;
        static $j = 1;

        $j++;

        if($j % 41 === 0){
            $i++;
        }
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'classroom_id' => $i
        ];

        // for($i = 1; $i < 17; $i++){

        //     $start = 1;
        //     $stop = 41;

        //     for($j=$start; $j < $stop; $j++){
        //         return [
        //             'first_name' => $this->faker->firstName,
        //             'last_name' => $this->faker->lastName,
        //             'classroom_id' => $i
        //         ];
        //     }

        //     $start+=40;
        //     $stop+=40;
            
        // }
    }
}

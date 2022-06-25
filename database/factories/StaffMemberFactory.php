<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StaffMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        static $id = 6;
        
        return [
            "user_id" => $id++,
            "staff_number" => $this->faker->unique()->numerify('######'),
        ];
    }
}

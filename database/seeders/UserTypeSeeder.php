<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserType::insert([
            ["type" => "parent"], ["type" => "admin"], ["type" => "teacher"], ["type" => "senior teacher"]
        ]);
    }
}

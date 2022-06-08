<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;


class UserTypeListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i = 1; $i < 6; $i++)
        \App\Models\UserTypeList::create([
            "user_id" => $i,
            "user_type_id" => 1
        ]);

        for($i = 6; $i < 11; $i++)
        \App\Models\UserTypeList::create([
            "user_id" => $i,
            "user_type_id" => 3
        ]);

        \App\Models\UserTypeList::create([
            "user_id" => 1,
            "user_type_id" => 2
        ]);
    }
}

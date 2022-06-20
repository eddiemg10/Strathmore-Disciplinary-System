<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        \App\Models\User::truncate();
        \App\Models\UserType::truncate();
        \App\Models\UserTypeList::truncate();
        Schema::enableForeignKeyConstraints();

        \App\Models\User::factory(40)->create();

        
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StaffMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   
        \App\Models\StaffMember::factory(20)->create();
    
    }
}

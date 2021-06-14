<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\Body_Part::factory(1)->create();
        //\App\Models\Workout::factory(1)->create();
        \App\Models\Training::factory(1)->create();
    }
}

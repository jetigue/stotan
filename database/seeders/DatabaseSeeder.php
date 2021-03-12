<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Training\Intensity;
use App\Models\Training\Macrocycle;
use App\Models\Training\Mesocycle;
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
        Team::factory()->times(5)->hasUsers(10)->hasMacrocycles(3)->create();

        $this->call([
            TrainingSessionsSeeder::class,
            ColorSeeder::class
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Training\Intensity;
use App\Models\Training\RunTypes\Intermittent;
use App\Models\Training\RunTypes\Progressive;
use App\Models\Training\RunTypes\Steady;
use Illuminate\Database\Seeder;

class TrainingSessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Intensity::factory()->times(5)->create();
        Intermittent::factory()->times(5)->create();
        Steady::factory()->times(5)->create();
        Progressive::factory()->times(5)->create();
    }
}

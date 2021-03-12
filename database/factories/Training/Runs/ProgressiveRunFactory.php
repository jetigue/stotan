<?php

namespace Database\Factories\Training\Runs;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Training\Runs\ProgressiveRun;

class ProgressiveRunFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProgressiveRun::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'team_id' => Team::factory(),
        ];
    }
}

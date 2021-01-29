<?php

namespace Database\Factories\Training\Activities;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Training\Activities\IntermittentRun;

class IntermittentRunFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IntermittentRun::class;

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

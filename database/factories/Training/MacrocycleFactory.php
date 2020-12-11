<?php

namespace Database\Factories\Training;

use App\Models\Team;
use App\Models\Training\Macrocycle;
use Illuminate\Database\Eloquent\Factories\Factory;

class MacrocycleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Macrocycle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Track', 'Cross Country', 'Indoor']) . ' ' . $this->faker->year,
            'begin_date' => $this->faker->randomElement(['2020-05-01', '2020-01-01', '2020-01-12']),
            'end_date' => $this->faker->randomElement(['2020-11-11', '2020-12-01', '2021-01-12']),
            'team_id' => Team::factory(),

        ];
    }
}

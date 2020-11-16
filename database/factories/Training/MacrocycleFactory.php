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
            'begin_date' => $this->faker->date($format = 'Y-m-d', $max = '2019-01-01'),
            'end_date' => $this->faker->date($format = 'Y-m-d', $max = '2021-01-01'),
            'team_id' => Team::factory(),
        ];
    }
}

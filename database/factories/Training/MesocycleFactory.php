<?php

namespace Database\Factories\Training;

use App\Models\Team;
use App\Models\Training\Macrocycle;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Training\Mesocycle;

class MesocycleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mesocycle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Phase' . ' ' . $this->faker->numberBetween($min = 1, $max = 5),
            'begin_date' => $this->faker->date($format = 'Y-m-d', $max = '2019-01-01'),
            'end_date' => $this->faker->date($format = 'Y-m-d', $max = '2021-01-01'),
            'macrocycle_id' => Macrocycle::factory(),
            'team_id' => Team::factory(),
        ];
    }
}

<?php

namespace Database\Factories\Training\RunTypes;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Training\RunTypes\Steady;

class SteadyRunTypesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Steady::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
        ];
    }
}

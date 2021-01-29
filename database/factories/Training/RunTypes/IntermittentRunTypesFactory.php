<?php

namespace Database\Factories\Training\RunTypes;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Training\RunTypes\Intermittent;

class IntermittentRunTypesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Intermittent::class;

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

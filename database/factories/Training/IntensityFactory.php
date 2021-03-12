<?php

namespace Database\Factories\Training;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Training\Intensity;

class IntensityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Intensity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'percentVO2Max' => $this->faker->numberBetween(75,100),
            'percentMaxHR'=> $this->faker->numberBetween(75,100),
            'purpose' => $this->faker->sentence(),
            'jd_points' => $this->faker->numberBetween(100, 210)
        ];
    }
}

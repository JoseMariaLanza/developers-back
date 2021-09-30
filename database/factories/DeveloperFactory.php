<?php

namespace Database\Factories;

use App\Models\Developer;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeveloperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Developer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'profession' => 'profession' . $this->faker->name(),
            'position' => 'position' . $this->faker->name(),
            'technology' => 'technology' . $this->faker->name(),
           // 'library' => 'library' . $this->faker->name()
            

        ];
    }
}

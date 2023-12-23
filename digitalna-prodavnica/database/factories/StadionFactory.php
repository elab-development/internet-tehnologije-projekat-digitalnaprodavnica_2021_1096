<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stadion>
 */
class StadionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naziv' => $this->faker->randomElement(['Marakana', 'Stamford Bridge', 'Old Trafford', 'Santiago Bernabeu', 'Hala Pionir']),
            'adresa' => $this->faker->address(),
        ];
    }
}

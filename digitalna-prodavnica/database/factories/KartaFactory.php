<?php

namespace Database\Factories;

use App\Models\Utakmica;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karta>
 */
class KartaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brojKarte' => $this->faker->unique()->numerify('KARTA###'),
            'cena' => $this->faker->randomFloat(2, 10, 100),
            'kolicina' => $this->faker->numberBetween(100, 1000),
            'utakmicaId' => Utakmica::factory()->create()->id,
        ];
    }
}

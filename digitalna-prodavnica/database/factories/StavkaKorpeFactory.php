<?php

namespace Database\Factories;

use App\Models\Knjiga;
use App\Models\Korpa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StavkaKorpe>
 */
class StavkaKorpeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $korpa = Korpa::inRandomOrder()->first();
        $knjiga = Knjiga::inRandomOrder()->first();

        return [
            'korpa_id' => $korpa ? $korpa->id : Korpa::factory()->create()->korpa_id,
            'knjiga_id' => $knjiga ? $knjiga->id : Knjiga::factory()->create()->knjiga_id,
            'kolicina' => $this->faker->numberBetween(1, 5),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Knjiga;
use App\Models\Korpa;
use App\Models\StavkaKorpe;
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
            'korpa_id' => $korpa->korpa_id,
            'knjiga_id' => $knjiga->knjiga_id,
            'kolicina' => 1,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Korisnik;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Korpa>
 */
class KorpaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $korisnik = Korisnik::inRandomOrder()->first();
        return [
            'korisnik_id' => $korisnik ? $korisnik->korisnikId : Korisnik::factory()->create()->korisnik_id,
        ];
    }
}

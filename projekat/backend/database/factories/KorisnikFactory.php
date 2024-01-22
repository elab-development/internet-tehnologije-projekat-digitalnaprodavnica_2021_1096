<?php

namespace Database\Factories;

use App\Models\Korisnik;
use App\Models\Korpa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Korisnik>
 */
class KorisnikFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->email(),
            'password' => Hash::make($this->faker->password()),
            'username' => $this->faker->unique()->userName(),
            'ime' => $this->faker->firstName(),
            'prezime' => $this->faker->lastName(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Korisnik $korisnik) {
            $korisnik->korpa()->save(Korpa::factory()->make());
        });
    }
}

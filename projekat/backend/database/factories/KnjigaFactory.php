<?php

namespace Database\Factories;

use App\Models\Autor;
use App\Models\Izdavac;
use App\Models\Knjiga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Knjiga>
 */
class KnjigaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'isbn' => $this->faker->numerify('###-##-#####-##-#'),
            'naziv' => $this->faker->sentence(3),
            'kategorija' => $this->faker->randomElement(['sci_fi', 'naucna_fantastika', 'triler', 'roman', 'komedija']),
            'opis' => $this->faker->paragraph(5),
            'pismo' => $this->faker->randomElement(['latinica', 'cirilica']),
            'godina' => $this->faker->year('now'),
            'strana' => $this->faker->numberBetween(50, 800),
            'cena' => $this->faker->numberBetween(300, 10000),
            'izdavac_id' => Izdavac::inRandomOrder()->first()->izdavac_id,
        ];
    }
}

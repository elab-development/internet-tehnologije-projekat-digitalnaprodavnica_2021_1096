<?php

namespace Database\Seeders;

use App\Models\Karta;
use Illuminate\Database\Seeder;

class KartaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Karta::create([
            'brojKarte' => 'DL1111',
            'cena' => 2000,
            'kolicina' => 54000,
            'utakmicaId' => 1,
        ]);

        Karta::create([
            'brojKarte' => 'DL2222',
            'cena' => 3000,
            'kolicina' => 60000,
            'utakmicaId' => 2,
        ]);

        Karta::create([
            'brojKarte' => 'DL3333',
            'cena' => 4000,
            'kolicina' => 45000,
            'utakmicaId' => 3,
        ]);
    }
}

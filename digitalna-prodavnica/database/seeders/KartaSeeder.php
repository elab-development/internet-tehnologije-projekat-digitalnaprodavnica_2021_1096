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
            'brojKarte' => 'FBL1111',
            'cena' => 2000,
            'kolicina' => 54000,
            'utakmicaId' => 1,
        ]);

        Karta::create([
            'brojKarte' => 'FBL2222',
            'cena' => 3000,
            'kolicina' => 60000,
            'utakmicaId' => 2,
        ]);

        Karta::create([
            'brojKarte' => 'FBL3333',
            'cena' => 4000,
            'kolicina' => 45000,
            'utakmicaId' => 3,
        ]);

        Karta::create([
            'brojKarte' => 'BBL1111',
            'cena' => 1500,
            'kolicina' => 8000,
            'utakmicaId' => 4,
        ]);

        Karta::create([
            'brojKarte' => 'BBL2222',
            'cena' => 7500,
            'kolicina' => 20000,
            'utakmicaId' => 5,
        ]);

        Karta::create([
            'brojKarte' => 'BBL3333',
            'cena' => 5000,
            'kolicina' => 15000,
            'utakmicaId' => 6,
        ]);
    }
}

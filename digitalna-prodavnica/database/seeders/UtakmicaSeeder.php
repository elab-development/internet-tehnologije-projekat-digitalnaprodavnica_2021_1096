<?php

namespace Database\Seeders;

use App\Models\Stadion;
use App\Models\Utakmica;
use Illuminate\Database\Seeder;

class UtakmicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Utakmica::create([
            'timDomacin' => 'FK Crvena zvezda',
            'timGost' => 'Chelsea FC',
            'tipSporta' => 'fudbal',
            'datumVreme' => '2024-01-17 18:30:00',
            'stadionId' => '1',
        ]);

        Utakmica::create([
            'timDomacin' => 'Chelsea FC',
            'timGost' => 'Real Madrid',
            'tipSporta' => 'fudbal',
            'datumVreme' => '2024-01-18 18:30:00',
            'stadionId' => '2',
        ]);

        Utakmica::create([
            'timDomacin' => 'Real Madrid',
            'timGost' => 'Crvena zvezda',
            'tipSporta' => 'fudbal',
            'datumVreme' => '2024-01-19 18:30:00',
            'stadionId' => '3',
        ]);
    }
}

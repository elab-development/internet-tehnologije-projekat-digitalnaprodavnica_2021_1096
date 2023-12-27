<?php

namespace Database\Seeders;

use App\Models\Utakmica;
use Carbon\Carbon;
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
            'datumVreme' => Carbon::create(2024, 1, 17, 19, 0, 0),
            'stadionId' => '1',
        ]);

        Utakmica::create([
            'timDomacin' => 'Chelsea FC',
            'timGost' => 'Real Madrid CF',
            'tipSporta' => 'fudbal',
            'datumVreme' => Carbon::create(2024, 2, 21, 21, 30, 0),
            'stadionId' => '2',
        ]);

        Utakmica::create([
            'timDomacin' => 'Real Madrid CF',
            'timGost' => 'FK Crvena zvezda',
            'tipSporta' => 'fudbal',
            'datumVreme' => Carbon::create(2024, 3, 4, 18, 0, 0),
            'stadionId' => '3',
        ]);
    }
}

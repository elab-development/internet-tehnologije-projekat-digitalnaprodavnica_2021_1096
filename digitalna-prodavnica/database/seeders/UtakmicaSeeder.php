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

        Utakmica::create([
            'timDomacin' => 'KK Crvena zvezda',
            'timGost' => 'KK Partizan',
            'tipSporta' => 'kosarka',
            'datumVreme' => Carbon::create(2024, 2, 17, 19, 0, 0),
            'stadionId' => '4',
        ]);

        Utakmica::create([
            'timDomacin' => 'LA Lakers',
            'timGost' => 'Denver Nuggets',
            'tipSporta' => 'kosarka',
            'datumVreme' => Carbon::create(2024, 2, 5, 20, 30, 0),
            'stadionId' => '5',
        ]);

        Utakmica::create([
            'timDomacin' => 'Alba Berlin',
            'timGost' => 'Saski Baskonia',
            'tipSporta' => 'kosarka',
            'datumVreme' => Carbon::create(2024, 3, 7, 17, 45, 0),
            'stadionId' => '6',
        ]);
    }
}

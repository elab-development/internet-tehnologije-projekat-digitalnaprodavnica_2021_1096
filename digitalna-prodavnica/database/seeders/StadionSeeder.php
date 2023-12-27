<?php

namespace Database\Seeders;

use App\Models\Stadion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StadionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stadion::create([
            'naziv' => 'Stadion Rajko Mitic',
            'adresa' => 'Ljutice Bogdana 1a',
        ]);

        Stadion::create([
            'naziv' => 'Stamford Bridge',
            'adresa' => 'Fulham Rd.',
        ]);

        Stadion::create([
            'naziv' => 'Santiago Bernabeu',
            'adresa' => 'Av. de Concha Espina 1',
        ]);
    }
}

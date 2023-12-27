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
            'adresa' => 'Ljutice Bogdana 1a, Beograd, Srbija',
        ]);

        Stadion::create([
            'naziv' => 'Stamford Bridge',
            'adresa' => 'Fulham Rd., London, United Kingdom',
        ]);

        Stadion::create([
            'naziv' => 'Santiago Bernabeu',
            'adresa' => 'Av. de Concha Espina 1, Madrid, Spain',
        ]);

        Stadion::create([
            'naziv' => 'Hala Pionir',
            'adresa' => 'Carlija Caplina 39, Beograd, Srbija',
        ]);

        Stadion::create([
            'naziv' => 'Staples Center',
            'adresa' => '1111 S Figueroa St., California, United States',
        ]);

        Stadion::create([
            'naziv' => 'Mercedes-Benz Arena Berlin',
            'adresa' => 'Mercedes-Platz 1, Berlin, Germany',
        ]);
    }
}

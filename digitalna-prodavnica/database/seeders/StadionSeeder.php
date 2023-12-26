<?php

namespace Database\Seeders;

use App\Models\Stadion;
use Illuminate\Database\Seeder;

class StadionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stadioni = ['Marakana', 'Stamford Bridge', 'Santiago Bernabeu'];
        $adrese = ['Ljutice Bogdana 1a', 'Fulham Rd.', 'Av. de Concha Espina 1'];

        for ($i = 0; $i < count($stadioni); $i++) {
            Stadion::create([
                'naziv' => $stadioni[$i],
                'adresa' => $adrese[$i],
            ]);
        }
    }
}

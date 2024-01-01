<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Karta;
use App\Models\Korisnik;
use App\Models\Stadion;
use App\Models\Utakmica;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KorisnikSeeder::class,
            IzdavacSeeder::class,
            AutorSeeder::class,
            KnjigaSeeder::class,
            KnjigaAutorSeeder::class,
        ]);
    }
}

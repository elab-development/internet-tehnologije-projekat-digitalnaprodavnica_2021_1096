<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            StavkaKorpeSeeder::class,
        ]);
    }
}

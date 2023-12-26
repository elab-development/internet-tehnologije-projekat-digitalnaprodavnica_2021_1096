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
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Korisnik::factory(10)->create();
        Stadion::factory()->count(3)->create();
        Utakmica::factory()->count(3)->create();
        Karta::factory()->count(3)->create();
    }
}

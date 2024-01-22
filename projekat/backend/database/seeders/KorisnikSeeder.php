<?php

namespace Database\Seeders;

use App\Models\Korisnik;
use Illuminate\Database\Seeder;

class KorisnikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Korisnik::factory()
            ->count(29)
            ->create();

        // kreiranje admin korisnika
        $korisnik = Korisnik::create([
            'email' => 'draskovicdusan4@gmail.com',
            'username' => 'dusan',
            'password' => 'admin',
            'ime' => 'Dusan',
            'prezime' => 'Draskovic',
            'isAdmin' => 1,
        ]);

        $korisnik->korpa()->create();
    }
}

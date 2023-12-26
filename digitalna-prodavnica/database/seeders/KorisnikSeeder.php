<?php

namespace Database\Seeders;

use App\Models\Korisnik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KorisnikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Korisnik::create([
            'email' => 'dusan@gmail.com',
            'password' => 'admin',
            'ime' => 'Dusan',
            'prezime' => 'Draskovic',
            'isAdmin' => true,
        ]);

        Korisnik::create([
            'email' => 'luka@gmail.com',
            'password' => 'admin',
            'ime' => 'Luka',
            'prezime' => 'Boskovic',
            'isAdmin' => true,
        ]);
    }
}

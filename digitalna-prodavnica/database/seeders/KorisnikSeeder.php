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
            'username' => 'ddusan',
            'ime' => 'Dusan',
            'prezime' => 'Draskovic',
            'isAdmin' => true,
        ]);

        Korisnik::create([
            'email' => 'luka@gmail.com',
            'password' => 'admin',
            'username' => 'lonbaj',
            'ime' => 'Luka',
            'prezime' => 'Boskovic',
            'isAdmin' => true,
        ]);

        Korisnik::create([
            'email' => 'draskovicdusan4@gmail.com',
            'password' => 'dusan12',
            'username' => 'random',
            'ime' => 'Neko',
            'prezime' => 'Nekic',
        ]);
    }
}

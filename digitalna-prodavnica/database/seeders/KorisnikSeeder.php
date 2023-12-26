<?php

namespace Database\Seeders;

use App\Models\Korisnik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'prezime' => 'Draskovic'
        ]);

        Korisnik::create([
            'email' => 'luka@gmail.com',
            'password' => 'admin',
            'ime' => 'Luka',
            'prezime' => 'Boskovic'
        ]);

        $email = 'dusan@gmail.com';
        DB::table('korisnik')
            ->where('email', $email)
            ->update(['isAdmin' => true]);

        $email = 'luka@gmail.com';
        DB::table('korisnik')
            ->where('email', $email)
            ->update(['isAdmin' => true]);
    }
}

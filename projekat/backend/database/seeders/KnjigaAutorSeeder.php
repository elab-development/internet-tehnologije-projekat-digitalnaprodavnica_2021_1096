<?php

namespace Database\Seeders;

use App\Models\Autor;
use App\Models\Knjiga;
use Illuminate\Database\Seeder;

class KnjigaAutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $knjige = Knjiga::all();
        $autori = Autor::all();

        $knjige->each(function ($knjiga) use ($autori) {
            $knjiga->autori()->attach(
                $autori->random(rand(1, 3))->pluck('autor_id')->toArray()
            );
        });
    }
}

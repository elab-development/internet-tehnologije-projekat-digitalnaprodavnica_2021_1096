<?php

namespace Database\Seeders;

use App\Models\Knjiga;
use App\Models\Korisnik;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProdajaSeeder extends Seeder
{

    public function run(): void
    {

        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            DB::table('korisnik_knjiga')->insert([
                'korisnik_id' => Korisnik::inRandomOrder()->first()->korisnik_id,
                'knjiga_id' => Knjiga::inRandomOrder()->first()->knjiga_id,
                'created_at' => $faker->dateTimeBetween('-10 years', 'now'),
            ]);
        }
    }
}

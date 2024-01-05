<?php

namespace Database\Seeders;

use App\Models\Korpa;
use Illuminate\Database\Seeder;

class KorpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Korpa::factory()
            ->count(30)
            ->create();
    }
}

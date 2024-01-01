<?php

namespace Database\Seeders;

use App\Models\StavkaKorpe;
use Illuminate\Database\Seeder;

class StavkaKorpeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StavkaKorpe::factory()
            ->count(30)
            ->create();
    }
}

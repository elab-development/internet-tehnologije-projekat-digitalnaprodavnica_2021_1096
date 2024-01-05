<?php

namespace Database\Seeders;

use App\Models\Knjiga;
use Illuminate\Database\Seeder;

class KnjigaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Knjiga::factory()
            ->count(30)
            ->create();
    }
}

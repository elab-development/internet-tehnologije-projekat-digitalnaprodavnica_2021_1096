<?php

namespace Database\Seeders;

use App\Models\Izdavac;
use Illuminate\Database\Seeder;

class IzdavacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Izdavac::factory()
            ->count(20)
            ->create();
    }
}

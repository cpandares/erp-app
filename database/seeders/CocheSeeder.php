<?php

namespace Database\Seeders;

use App\Models\Coche;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CocheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coche::factory()->count(20)->create();
    }
}

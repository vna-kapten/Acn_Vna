<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clothes;   // ← WAJIB

class ClothesSeeder extends Seeder
{
    public function run(): void
    {
        Clothes::factory(20)->create();
    }
}

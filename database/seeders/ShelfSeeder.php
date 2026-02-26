<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shelf;

class ShelfSeeder extends Seeder
{
    public function run(): void
    {
        Shelf::factory()->count(5)->create();
    }
}

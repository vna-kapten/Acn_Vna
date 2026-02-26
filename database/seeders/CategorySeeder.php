<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Baju', 'description' => 'Segala jenis kaos dan kemeja'],
            ['name' => 'Celana', 'description' => 'Segala jenis celana panjang dan pendek'],
            ['name' => 'Jaket', 'description' => 'Outerwear, hoodie, dan sweater'],
            ['name' => 'Sepatu', 'description' => 'Segala jenis alas kaki'],
            ['name' => 'Aksesoris', 'description' => 'Topi, tas, dan lainnya'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}

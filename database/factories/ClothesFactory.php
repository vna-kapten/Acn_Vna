<?php

namespace Database\Factories;

use App\Models\Clothes;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClothesFactory extends Factory
{
    protected $model = Clothes::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'price' => $this->faker->numberBetween(50000, 500000),
            'stock' => $this->faker->numberBetween(5, 50),
            'description' => $this->faker->sentence(10),
            'image_url' => null,
            'size' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL', 'XXL']),
            'color' => $this->faker->colorName(),
            'condition' => $this->faker->randomElement(['Seperti Baru', 'Sangat Baik', 'Baik', 'Cukup Baik']),
        ];
    }
}

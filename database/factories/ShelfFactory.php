<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shelf>
 */
class ShelfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shelf_id' => Str::uuid(),
            'shelf_name' => fake()->word(),
            'shelf_position' => fake()->randomElement(['A1', 'B2', 'C3', 'D4']),
        ];
    }
}

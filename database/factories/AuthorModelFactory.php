<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuthorModel>
 */
class AuthorModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            return [
'author_id' => (string) Str::uuid(),
'author_name' => fake()->name(),
'author_description' => fake()->text(150),
'created_at' => Carbon::now(),
'updated_at' => Carbon::now(),
];
        ;
    }
}

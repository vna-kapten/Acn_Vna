<?php

namespace Database\Factories;

use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PublisherFactory extends Factory
{
    protected $model = Publisher::class;

    public function definition(): array
    {
        return [
            'publisher_id' => Str::uuid(),
            'publisher_name' => fake()->company(),
            'publisher_description' => fake()->sentence(),
        ];
    }
}

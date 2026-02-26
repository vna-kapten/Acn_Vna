<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition(): array
    {
        return [
            'author_id' => (string) Str::uuid(),
            'author_name' => $this->faker->name(),
            'author_description' => $this->faker->text(150),
        ];
    }

//      protected $model = Author::class;

//     public function definition(): array
//     {
//         return [
//             'author_name' => $this->faker->name(),
//             'author_description' => $this->faker->sentence(),
//   ];
// } 
}
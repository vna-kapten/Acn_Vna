<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'book_id' => Str::uuid(),
            'title' => $this->faker->sentence(3),
            'isbn' => $this->faker->isbn13(),
            'author_id' => \App\Models\Author::factory(),
            'publisher_id' => \App\Models\Publisher::factory(),
            'category_id' => \App\Models\Category::factory(),
            'shelf_id' => \App\Models\Shelf::factory(),
            'year' => $this->faker->year(),
            'description' => $this->faker->paragraph(),
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'book_id';
    public $incrementing = false; // karena UUID
    protected $keyType = 'string';

    protected $fillable = [
        'book_id',
        'title',
        'isbn',
        'author_id',
        'publisher_id',
        'category_id',
        'shelf_id',
        'year',
        'description',
        'book_img',
        'book_quantity',
    ];
}

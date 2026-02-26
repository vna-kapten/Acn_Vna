<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['author', 'publisher', 'category', 'shelf'])->get();
        return view('user.books.index', compact('books'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->load(['author', 'publisher', 'category', 'shelf']);
        return view('user.books.show', compact('book'));
    }
}

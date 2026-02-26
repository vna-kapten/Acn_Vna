<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Category;
use App\Models\Shelf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['author', 'publisher', 'category', 'shelf'])->get();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();
        $shelves = Shelf::all();
        return view('admin.books.create', compact('authors', 'publishers', 'categories', 'shelves'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:255|unique:books,isbn',
            'author_id' => 'required|exists:authors,author_id',
            'publisher_id' => 'required|exists:publishers,publisher_id',
            'category_id' => 'required|exists:categories,category_id',
            'shelf_id' => 'required|exists:shelves,shelf_id',
            'year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
        ]);

        $data = $request->except(['book_img']);
        $data['book_id'] = Str::uuid();

        if ($request->hasFile('book_img')) {
            $data['book_img'] = $request->file('book_img')->store('books', 'public');
        }

        Book::create($data);

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->load(['author', 'publisher', 'category', 'shelf']);
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();
        $shelves = Shelf::all();
        return view('admin.books.edit', compact('book', 'authors', 'publishers', 'categories', 'shelves'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:255|unique:books,isbn,' . $book->book_id . ',book_id',
            'author_id' => 'required|exists:authors,author_id',
            'publisher_id' => 'required|exists:publishers,publisher_id',
            'category_id' => 'required|exists:categories,category_id',
            'shelf_id' => 'required|exists:shelves,shelf_id',
            'year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
        ]);

        $data = $request->except(['book_img']);

        if ($request->hasFile('book_img')) {
            if ($book->book_img) {
                Storage::disk('public')->delete($book->book_img);
            }
            $data['book_img'] = $request->file('book_img')->store('books', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->book_img) {
            Storage::disk('public')->delete($book->book_img);
        }
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowings = Borrowing::where('borrowing_user_id', Auth::id())->with('borrowingDetails.book')->get();
        return view('user.borrowings.index', compact('borrowings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::where('book_stock', '>', 0)->get();
        return view('user.borrowings.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'exists:books,book_id',
            'borrowing_date' => 'required|date',
            'return_date' => 'required|date|after:borrowing_date',
        ]);

        $borrowing = Borrowing::create([
            'borrowing_id' => (string) \Illuminate\Support\Str::uuid(),
            'borrowing_user_id' => Auth::id(),
            'borrowing_date' => $request->borrowing_date,
            'return_date' => $request->return_date,
            'status' => 'pending',
        ]);

        foreach ($request->book_ids as $bookId) {
            $borrowing->borrowingDetails()->create([
                'borrowing_detail_id' => (string) \Illuminate\Support\Str::uuid(),
                'book_id' => $bookId,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('user.borrowings.index')->with('success', 'Borrowing request submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        if ($borrowing->borrowing_user_id !== Auth::id()) {
            abort(403);
        }
        $borrowing->load('borrowingDetails.book');
        return view('user.borrowings.show', compact('borrowing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrowing $borrowing)
    {
        if ($borrowing->borrowing_user_id !== Auth::id() || $borrowing->status !== 'pending') {
            abort(403);
        }
        $books = Book::where('book_stock', '>', 0)->get();
        return view('user.borrowings.edit', compact('borrowing', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id() || $borrowing->status !== 'pending') {
            abort(403);
        }

        $request->validate([
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'exists:books,book_id',
            'borrowing_date' => 'required|date',
            'return_date' => 'required|date|after:borrowing_date',
        ]);

        $borrowing->update([
            'borrowing_date' => $request->borrowing_date,
            'return_date' => $request->return_date,
        ]);

        $borrowing->borrowingDetails()->delete(); // Remove old details

        foreach ($request->book_ids as $bookId) {
            $borrowing->borrowingDetails()->create([
                'borrowing_detail_id' => (string) \Illuminate\Support\Str::uuid(),
                'book_id' => $bookId,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('user.borrowings.index')->with('success', 'Borrowing request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->borrowing_user_id !== Auth::id() || $borrowing->status !== 'pending') {
            abort(403);
        }
        $borrowing->delete();
        return redirect()->route('user.borrowings.index')->with('success', 'Borrowing request deleted successfully.');
    }
}

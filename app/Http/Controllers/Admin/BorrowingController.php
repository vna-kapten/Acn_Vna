<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'borrowingDetails.book'])->get();
        return view('admin.borrowings.index', compact('borrowings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.borrowings.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'borrowing_user_id' => 'required|exists:users,id',
            'borrowing_notes' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['borrowing_id'] = Str::uuid();

        Borrowing::create($data);

        return redirect()->route('admin.borrowings.index')->with('success', 'Borrowing created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['user', 'borrowingDetails.book']);
        return view('admin.borrowings.show', compact('borrowing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrowing $borrowing)
    {
        $users = User::all();
        return view('admin.borrowings.edit', compact('borrowing', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'borrowing_user_id' => 'required|exists:users,id',
            'borrowing_isreturned' => 'boolean',
            'borrowing_notes' => 'nullable|string',
            'borrowing_fine' => 'nullable|integer|min:0',
        ]);

        $borrowing->update($request->all());

        return redirect()->route('admin.borrowings.index')->with('success', 'Borrowing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        $borrowing->delete();
        return redirect()->route('admin.borrowings.index')->with('success', 'Borrowing deleted successfully.');
    }
}

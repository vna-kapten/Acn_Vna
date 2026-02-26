<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shelf;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shelves = Shelf::all();
        return view('admin.shelves.index', compact('shelves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shelves.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shelf_name' => 'required|string|max:150',
            'shelf_position' => 'required|string|max:25',
        ]);

        Shelf::create($request->only(['shelf_name', 'shelf_position']));

        return redirect()->route('admin.shelves.index')->with('success', 'Shelf created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shelf $shelf)
    {
        return view('admin.shelves.show', compact('shelf'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shelf $shelf)
    {
        return view('admin.shelves.edit', compact('shelf'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shelf $shelf)
    {
        $request->validate([
            'shelf_name' => 'required|string|max:150',
            'shelf_position' => 'required|string|max:25',
        ]);

        $shelf->update($request->only(['shelf_name', 'shelf_position']));

        return redirect()->route('admin.shelves.index')->with('success', 'Shelf updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shelf $shelf)
    {
        $shelf->delete();
        return redirect()->route('admin.shelves.index')->with('success', 'Shelf deleted successfully.');
    }
}

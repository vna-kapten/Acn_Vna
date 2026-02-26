<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clothes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClothesController extends Controller
{
    public function index()
    {
        // $this->authorize('admin');
        $clothes = Clothes::with('category')->latest()->paginate(15);
        return view('admin.clothes.index', compact('clothes'));
    }

    public function create()
    {
        // $this->authorize('admin');
        $categories = \App\Models\Category::all();
        return view('admin.clothes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // $this->authorize('admin');
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'condition' => 'nullable|string|in:Baru,Sangat Baik,Baik,Cukup Baik',
            'image_url' => 'nullable|url',
        ]);

        Clothes::create($data);

        return redirect()->route('admin.clothes.index')->with('success', 'Pakaian berhasil ditambahkan.');
    }

    public function edit(Clothes $clothes)
    {
        // $this->authorize('admin');
        $categories = \App\Models\Category::all();
        return view('admin.clothes.edit', compact('clothes', 'categories'));
    }

    public function update(Request $request, Clothes $clothes)
    {
        // $this->authorize('admin');
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'condition' => 'nullable|string|in:Baru,Sangat Baik,Baik,Cukup Baik',
            'image_url' => 'nullable|url',
        ]);

        $clothes->update($data);

        return redirect()->route('admin.clothes.index')->with('success', 'Pakaian berhasil diperbarui.');
    }

    public function destroy(Clothes $clothes)
    {
        // $this->authorize('admin');
        
        if ($clothes->image_url) {
            Storage::disk('public')->delete($clothes->image_url);
        }
        $clothes->delete();
        return redirect()->route('admin.clothes.index')->with('success', 'Pakaian berhasil dihapus.');
    }
}

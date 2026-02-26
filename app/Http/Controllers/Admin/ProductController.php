<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric|min:0',
        ]);

        Product::create($request->all());
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
         $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric|min:0',
        ]);

        Product::findOrFail($id)->update($request->all());
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil dihapus');
    }
}

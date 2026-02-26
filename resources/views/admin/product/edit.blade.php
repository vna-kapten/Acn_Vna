@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Produk</h1>
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                <input type="text" name="nama" value="{{ $product->nama }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                <input type="text" name="kategori" value="{{ $product->kategori }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Stok</label>
                <input type="number" name="stok" value="{{ $product->stok }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Harga</label>
                <input type="number" name="harga" value="{{ $product->harga }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ $product->deskripsi }}</textarea>
            </div>
            <div class="flex justify-between items-center">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                <a href="{{ route('admin.product.index') }}" class="text-gray-600 hover:text-gray-800 font-bold">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

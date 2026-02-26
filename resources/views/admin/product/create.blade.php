@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-xl">
        <h1 class="text-3xl font-bold mb-8 text-gray-800 flex items-center">
            <span class="mr-3">📦</span> Tambah Produk Baru
        </h1>
        <form action="{{ route('admin.product.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                    <input type="text" name="nama" placeholder="Contoh: Kaos Vintage" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                    <input type="text" name="kategori" placeholder="Contoh: Baju" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Stok</label>
                    <input type="number" name="stok" placeholder="0" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Harga (Rp)</label>
                    <input type="number" name="harga" placeholder="0" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition" required>
                </div>
                <div class="mb-6 md:col-span-2">
                    <label class="block text-gray-700 font-bold mb-2">Deskripsi Produk</label>
                    <textarea name="deskripsi" rows="4" placeholder="Tuliskan detail produk di sini..." class="bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition"></textarea>
                </div>
            </div>
            <div class="flex justify-end items-center mt-8 space-x-4">
                <a href="{{ route('admin.product.index') }}" class="text-gray-500 hover:text-gray-700 font-semibold px-4 py-2 transition">Batal</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

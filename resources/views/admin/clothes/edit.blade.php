@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Pakaian</h1>
        <form action="{{ route('admin.clothes.update', $clothes->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2 cursor-pointer" for="name">Nama Pakaian</label>
                <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 hover:border-indigo-300 transition duration-200" value="{{ old('name', $clothes->name) }}" required>
                @error('name') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2 cursor-pointer" for="category_id">Kategori</label>
                 <div class="relative">
                    <select id="category_id" name="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 hover:border-indigo-300 transition duration-200 bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $clothes->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                @error('category_id') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2 cursor-pointer" for="price">Harga (Rp)</label>
                    <input type="number" id="price" name="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 hover:border-indigo-300 transition duration-200" value="{{ old('price', $clothes->price) }}" required>
                    @error('price') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2 cursor-pointer" for="stock">Stok</label>
                    <input type="number" id="stock" name="stock" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 hover:border-indigo-300 transition duration-200" value="{{ old('stock', $clothes->stock) }}" required>
                    @error('stock') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2 cursor-pointer" for="size">Ukuran</label>
                    <input type="text" id="size" name="size" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 hover:border-indigo-300 transition duration-200" value="{{ old('size', $clothes->size) }}">
                    @error('size') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2 cursor-pointer" for="color">Warna</label>
                    <input type="text" id="color" name="color" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 hover:border-indigo-300 transition duration-200" value="{{ old('color', $clothes->color) }}">
                    @error('color') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2 cursor-pointer" for="condition">Kondisi</label>
                    <div class="relative">
                        <select id="condition" name="condition" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 hover:border-indigo-300 transition duration-200 bg-white">
                            <option value="">-- Pilih --</option>
                            <option value="Baru" {{ old('condition', $clothes->condition) == 'Baru' ? 'selected' : '' }}>Baru</option>
                            <option value="Sangat Baik" {{ old('condition', $clothes->condition) == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                            <option value="Baik" {{ old('condition', $clothes->condition) == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Cukup Baik" {{ old('condition', $clothes->condition) == 'Cukup Baik' ? 'selected' : '' }}>Cukup Baik</option>
                        </select>
                         <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('condition') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2 cursor-pointer" for="description">Deskripsi</label>
                <textarea id="description" name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 hover:border-indigo-300 transition duration-200">{{ old('description', $clothes->description) }}</textarea>
                @error('description') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2 cursor-pointer" for="image_url">Link Gambar (URL)</label>
                @if($clothes->image_url)
                    <div class="mb-3">
                        <p class="text-gray-600 text-sm mb-1">Gambar saat ini:</p>
                        <!-- Check if it is a URL or local file -->
                        <img src="{{ Str::startsWith($clothes->image_url, 'http') ? $clothes->image_url : asset('storage/'.$clothes->image_url) }}" alt="{{ $clothes->name }}" class="w-32 h-32 object-cover rounded shadow-sm border">
                    </div>
                @endif
                <input type="url" id="image_url" name="image_url" value="{{ old('image_url', Str::startsWith($clothes->image_url, 'http') ? $clothes->image_url : '') }}" placeholder="https://example.com/gambar-baju.jpg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 hover:border-indigo-300 transition duration-200">
                <p class="text-gray-500 text-xs mt-1">Gunakan link gambar dari internet (Google Images, dll).</p>
                @error('image_url') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Update
                </button>
                <a href="{{ route('admin.clothes.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

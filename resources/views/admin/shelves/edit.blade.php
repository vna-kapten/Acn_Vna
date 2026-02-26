@extends('admin.layout.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Shelf</h1>

        <form method="POST" action="{{ route('admin.shelves.update', $shelf) }}" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="shelf_name" class="block text-sm font-medium text-gray-700">Shelf Name</label>
                <input type="text" name="shelf_name" id="shelf_name" value="{{ old('shelf_name', $shelf->shelf_name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('shelf_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="shelf_location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="shelf_location" id="shelf_location" value="{{ old('shelf_location', $shelf->shelf_location) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('shelf_location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.shelves.show', $shelf) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Shelf</button>
            </div>
        </form>
    </div>
</div>
@endsection

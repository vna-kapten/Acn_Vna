@extends('admin.layout.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Publisher</h1>

        <form method="POST" action="{{ route('admin.publishers.update', $publisher) }}" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="publisher_name" class="block text-sm font-medium text-gray-700">Publisher Name</label>
                <input type="text" name="publisher_name" id="publisher_name" value="{{ old('publisher_name', $publisher->publisher_name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('publisher_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="publisher_address" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea name="publisher_address" id="publisher_address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('publisher_address', $publisher->publisher_address) }}</textarea>
                @error('publisher_address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="publisher_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="publisher_phone" id="publisher_phone" value="{{ old('publisher_phone', $publisher->publisher_phone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('publisher_phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.publishers.show', $publisher) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Publisher</button>
            </div>
        </form>
    </div>
</div>
@endsection

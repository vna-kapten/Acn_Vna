@extends('admin.layout.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Book Details</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">ID:</strong>
                <p class="mt-1 text-sm text-gray-900">{{ $book->book_id }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">Title:</strong>
                <p class="mt-1 text-sm text-gray-900">{{ $book->title }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">Author:</strong>
                <p class="mt-1 text-sm text-gray-900">{{ $book->author->author_name }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">Publisher:</strong>
                <p class="mt-1 text-sm text-gray-900">{{ $book->publisher->publisher_name }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">Category:</strong>
                <p class="mt-1 text-sm text-gray-900">{{ $book->category->category_name }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">Shelf:</strong>
                <p class="mt-1 text-sm text-gray-900">{{ $book->shelf->shelf_name }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">Description:</strong>
                <p class="mt-1 text-sm text-gray-900">{{ $book->description }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">Quantity:</strong>
                <p class="mt-1 text-sm text-gray-900">{{ $book->book_quantity }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">Image:</strong>
                @if($book->book_img)
                    <img src="{{ asset('storage/' . $book->book_img) }}" alt="{{ $book->title }}" class="mt-1 max-w-xs rounded shadow-lg">
                @else
                    <p class="mt-1 text-sm text-gray-500">No image available</p>
                @endif
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.books.edit', $book) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                <a href="{{ route('admin.books.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection

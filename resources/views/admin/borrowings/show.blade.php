@extends('admin.layout.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Borrowing Details</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">ID:</strong>
                <p class="mt-1 text-sm text-gray-900">{{ $borrowing->borrowing_id }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">User:</strong>
                <p class="mt-1 text-sm text-gray-900">{{ $borrowing->user->name }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">Borrowing Date:</strong>
                <p class="mt-1 text-sm text-gray-900">{{ $borrowing->borrowing_date }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">Return Date:</strong>
                <p class="mt-1 text-sm text-gray-900">{{ $borrowing->return_date }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-sm font-medium text-gray-700">Status:</strong>
                <p class="mt-1 text-sm text-gray-900">{{ $borrowing->borrowing_status }}</p>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.borrowings.edit', $borrowing) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                <a href="{{ route('admin.borrowings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection

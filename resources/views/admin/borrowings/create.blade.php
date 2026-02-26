@extends('admin.layout.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Add New Borrowing</h1>

        <form method="POST" action="{{ route('admin.borrowings.store') }}" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="borrowing_date" class="block text-sm font-medium text-gray-700">Borrowing Date</label>
                <input type="date" name="borrowing_date" id="borrowing_date" value="{{ old('borrowing_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('borrowing_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="return_date" class="block text-sm font-medium text-gray-700">Return Date</label>
                <input type="date" name="return_date" id="return_date" value="{{ old('return_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('return_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="borrowing_status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="borrowing_status" id="borrowing_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="borrowed" {{ old('borrowing_status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                    <option value="returned" {{ old('borrowing_status') == 'returned' ? 'selected' : '' }}>Returned</option>
                    <option value="overdue" {{ old('borrowing_status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
                @error('borrowing_status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.borrowings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Borrowing</button>
            </div>
        </form>
    </div>
</div>
@endsection

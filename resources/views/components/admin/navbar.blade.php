<nav class="bg-white border-b px-6 py-3 flex items-center justify-between">
    <div class="flex items-center gap-4">
        <h1 class="font-bold text-lg text-black">{{ $adminName }}</h1>
        <ul class="flex gap-4 text-sm text-black">
            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-gray-600">Dashboard</a></li>
            <li><a href="{{ route('admin.books.index') }}" class="hover:text-gray-600">Books</a></li>
            <li><a href="{{ route('admin.publishers.index') }}" class="hover:text-gray-600">Publishers</a></li>
            <li><a href="{{ route('admin.categories.index') }}" class="hover:text-gray-600">Categories</a></li>
            <li><a href="{{ route('admin.borrowings.index') }}" class="hover:text-gray-600">Borrowings</a></li>
            <li><a href="{{ route('admin.users.index') }}" class="hover:text-gray-600">Users</a></li>
            <li><a href="{{ route('admin.settings') }}" class="hover:text-gray-600">Settings</a></li>
        </ul>
    </div>
    <div class="flex items-center gap-2">
        <span class="text-sm text-black">{{ auth()->user()->name ?? 'Admin' }}</span>
        <img src="{{ auth()->user()->profile_photo_url ?? 'https://i.pinimg.com/736x/7f/8c/7e/7f8c7ef69f24031df5113493a1b10bd5.jpg' }}"
             alt="Profile"
             class="w-10 h-10 rounded-full border">
    </div>
</nav>

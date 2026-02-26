<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <x-admin.sidebar :menus="[
            ['href' => route('admin.dashboard'), 'icon' => '🏠', 'label' => 'Dashboard'],
            ['href' => route('admin.publishers.index'), 'icon' => '📚', 'label' => 'Publishers'],
            ['href' => route('admin.shelves.index'), 'icon' => '📦', 'label' => 'Shelves'],
            ['href' => route('admin.categories.index'), 'icon' => '🏷️', 'label' => 'Categories'],
            ['href' => route('admin.books.index'), 'icon' => '📖', 'label' => 'Books'],
            ['href' => route('admin.borrowings.index'), 'icon' => '📋', 'label' => 'Borrowings'],
            ['href' => route('admin.users.index'), 'icon' => '👥', 'label' => 'Users'],
        ]" />

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <x-admin.navbar />

            <!-- Page content -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>

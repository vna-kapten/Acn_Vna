<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} - Toko Thrift</title>
    @vite('resources/css/app.css')
    <!-- Fallback CDN if Vite not running -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 font-sans antialiased">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-indigo-700 to-purple-700 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold hover:text-indigo-100 transition">Toko Thrift</a>
                </div>
                <div class="flex items-center space-x-6">
                    <span class="text-indigo-100 text-sm font-medium">👤 {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm font-bold transition shadow-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar + Content -->
    <div class="flex h-screen bg-gray-100 overflow-hidden">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg hidden md:block flex-shrink-0 relative z-30">
            <div class="h-full overflow-y-auto p-4 custom-scrollbar">
                <div class="mb-6 px-2">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>
                    <nav class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 border-l-4 border-transparent' }} font-medium transition-all duration-200 group">
                            <span class="text-xl mr-3 group-hover:scale-110 transition-transform">📊</span> Dashboard
                        </a>
                        
                        @if(Auth::user()->role == 'admin')
                        <a href="{{ route('admin.clothes.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.clothes.*') ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 border-l-4 border-transparent' }} font-medium transition-all duration-200 group">
                            <span class="text-xl mr-3 group-hover:scale-110 transition-transform">👕</span> Kelola Pakaian
                        </a>
                        <a href="{{ route('admin.product.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.product.*') ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 border-l-4 border-transparent' }} font-medium transition-all duration-200 group">
                            <span class="text-xl mr-3 group-hover:scale-110 transition-transform">🛍️</span> Produk Umum
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 border-l-4 border-transparent' }} font-medium transition-all duration-200 group">
                            <span class="text-xl mr-3 group-hover:scale-110 transition-transform">📦</span> Pesanan
                        </a>
                         <a href="{{ route('admin.payments.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.payments.*') ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 border-l-4 border-transparent' }} font-medium transition-all duration-200 group">
                            <span class="text-xl mr-3 group-hover:scale-110 transition-transform">💳</span> Pembayaran
                        </a>
                        @endif
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-hidden flex flex-col relative w-full">
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4 md:p-8 scroll-smooth">
                 @yield('content')
                 
                 <div class="mt-12 text-center text-gray-500 text-sm pb-4">
                    <p>&copy; 2026 Toko Thrift. Semua hak dilindungi.</p>
                </div>
            </main>
        </div>
    </div>
</body>
</html>

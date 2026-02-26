<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Thrift</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow p-4">
        <div class="container mx-auto flex justify-between">
            <a href="/" class="font-bold">Toko Thrift</a>
            <div>
                @if(!auth()->check() || auth()->user()->role != 'admin')
                    <a href="/" class="mr-4">Home</a>
                @endif
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <a href="{{ route('admin.clothes.index') }}" class="mr-4 text-indigo-600 font-bold">Kelola Shop</a>
                @else
                    <a href="/clothes" class="mr-4">Shop</a>
                @endif
                <a href="{{ route('user.product.index') }}" class="mr-4">Produk</a>
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="mr-4">Dashboard</a>
                @else
                    <a href="/cart" class="mr-4 relative inline-block">
                        <i class="fas fa-shopping-cart"></i> Cart
                        @php
                            $cartCount = collect(session('cart', []))->sum('quantity');
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-2 -right-3 bg-red-600 text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                    <a href="/profile" class="mr-4">Profile</a>
                @endif
            </div>
        </div>
    </nav>
    <main class="py-6">
        @yield('content')
    </main>
    <footer class="bg-gray-800 text-gray-300 py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2026 Toko Thrift. Semua hak dilindungi.</p>
        </div>
    </footer>
</body>
</html>
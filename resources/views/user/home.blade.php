<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Thrift - Belanja Pakaian Bekas Berkualitas</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-800">Toko Thrift</span>
                </div>

                <!-- Navigation -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="/" class="text-gray-700 hover:text-indigo-600 font-medium">Home</a>
                    <a href="{{ route('clothes.index') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Pakaian</a>
                    <a href="/about" class="text-gray-700 hover:text-indigo-600 font-medium">Tentang</a>
                    <a href="/contact" class="text-gray-700 hover:text-indigo-600 font-medium">Kontak</a>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-700 hover:text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 6.293A1 1 0 006 21h12a1 1 0 00.707-1.707L17 13M17 13l4-8m-4 8h2"></path>
                        </svg>
                        @php
                            $cartCount = collect(session('cart', []))->sum('quantity');
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                    @auth
                        <a href="{{ route('profile.index') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Login</a>
                        <a href="{{ url('/register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative w-full h-96 bg-gradient-to-r from-indigo-600 to-purple-600 flex items-center justify-center text-center text-white overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 left-1/4 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
            <div class="absolute top-0 right-1/4 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
        </div>
        
        <div class="relative z-10 max-w-2xl px-6">
            <h1 class="text-5xl font-bold mb-4">Toko Thrift Terpercaya</h1>
            <p class="text-xl mb-6">Temukan pakaian berkualitas dengan harga terjangkau</p>
            <a href="{{ route('clothes.index') }}" class="inline-block px-8 py-3 bg-white text-indigo-600 font-bold rounded-lg hover:bg-gray-100 transition">
                Belanja Sekarang
            </a>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-white py-12 border-b">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-indigo-600">{{ $totalClothes ?? 0 }}</div>
                    <p class="text-gray-600 mt-2">Koleksi Pakaian</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-green-600">1000+</div>
                    <p class="text-gray-600 mt-2">Pelanggan Puas</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600">100%</div>
                    <p class="text-gray-600 mt-2">Kepuasan Terjamin</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12">Koleksi Terbaru</h2>
            
            @if($clothes && $clothes->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($clothes as $item)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group">
                            <!-- Product Image -->
                            <div class="relative h-64 overflow-hidden bg-gray-50">
                                <img src="{{ $item->image_src }}" 
                                     alt="{{ $item->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                
                                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full shadow-sm text-xs font-bold text-indigo-600 border border-indigo-50">
                                    Rp {{ number_format($item->price ?? 0, 0, ',', '.') }}
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-6">
                                <div class="mb-4">
                                    <h3 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-indigo-600 transition truncate">{{ $item->name ?? 'Produk' }}</h3>
                                    <span class="inline-block px-2 py-1 bg-gray-100 text-gray-500 text-[10px] font-bold uppercase tracking-wider rounded">
                                        {{ $item->category->name ?? 'Kategori' }}
                                    </span>
                                </div>
                                
                                <p class="text-gray-500 text-sm mb-6 line-clamp-2 h-10">
                                    {{ $item->description ?? 'Pakaian berkualitas dari toko thrift kami' }}
                                </p>

                                <!-- Actions -->
                                <div class="space-y-2">
                                     @if(($item->stock ?? 0) > 0)
                                        <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col gap-2">
                                            @csrf
                                            <input type="hidden" name="clothes_id" value="{{ $item->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            
                                            <button type="submit" class="w-full py-2.5 px-4 bg-indigo-50 text-indigo-700 rounded-xl hover:bg-indigo-100 font-bold transition flex items-center justify-center text-sm">
                                                <i class="fas fa-cart-plus mr-2"></i> Masuk Keranjang
                                            </button>

                                            <button type="submit" name="buy_now" value="1" class="w-full py-2.5 px-4 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-bold shadow-md transition transform active:scale-95 flex items-center justify-center text-sm">
                                                <i class="fas fa-bolt mr-2"></i> Beli Sekarang
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="w-full py-3 px-4 bg-gray-100 text-gray-400 rounded-xl cursor-not-allowed font-bold">
                                            Stok Habis
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p class="text-gray-600 text-lg">Belum ada koleksi pakaian</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Categories -->
    @if($categories && $categories->count() > 0)
        <section class="bg-gray-100 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-4xl font-bold text-center mb-12">Kategori Pakaian</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach($categories as $category)
                        <a href="{{ route('clothes.index') }}" class="group">
                            <div class="bg-white rounded-lg p-6 text-center hover:shadow-lg transition">
                                <div class="text-4xl mb-3">👕</div>
                                <h3 class="font-semibold text-gray-800 group-hover:text-indigo-600">{{ $category->name }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="bg-indigo-600 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">Siap untuk Belanja?</h2>
            <p class="text-xl mb-8">Daftar sekarang dan dapatkan diskon spesial untuk pembelian pertama Anda</p>
            @guest
                <a href="{{ url('/register') }}" class="inline-block px-8 py-3 bg-white text-indigo-600 font-bold rounded-lg hover:bg-gray-100 transition">
                    Daftar Gratis
                </a>
            @else
                <a href="{{ route('clothes.index') }}" class="inline-block px-8 py-3 bg-white text-indigo-600 font-bold rounded-lg hover:bg-gray-100 transition">
                    Mulai Belanja
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="font-bold text-white mb-4">Tentang Kami</h3>
                    <p>Toko Thrift terpercaya menyediakan pakaian berkualitas dengan harga terjangkau untuk semua kalangan.</p>
                </div>
                <div>
                    <h3 class="font-bold text-white mb-4">Kategori</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white">Pakaian Pria</a></li>
                        <li><a href="#" class="hover:text-white">Pakaian Wanita</a></li>
                        <li><a href="#" class="hover:text-white">Pakaian Anak</a></li>
                        <li><a href="#" class="hover:text-white">Aksesori</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-white mb-4">Bantuan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white">Hubungi Kami</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-white">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-white mb-4">Ikuti Kami</h3>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-300 hover:text-white text-2xl">f</a>
                        <a href="#" class="text-gray-300 hover:text-white text-2xl">𝕏</a>
                        <a href="#" class="text-gray-300 hover:text-white text-2xl">📷</a>
                        <a href="#" class="text-gray-300 hover:text-white text-2xl">▶</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-8 text-center">
                <p>&copy; 2026 Toko Thrift. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</body>
</html>
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-6xl">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Side: Order Summary & Customer Info -->
        <div class="lg:w-2/3">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                <div class="bg-indigo-600 px-8 py-6">
                    <h1 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-shopping-bag mr-3"></i> Konfirmasi Pesanan
                    </h1>
                </div>

                <div class="p-8">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        
                        <!-- Customer Info Section -->
                        <div class="mb-10">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center border-b pb-2">
                                <i class="fas fa-user-circle mr-2 text-indigo-600"></i> Informasi Pengiriman
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2">Nama Penerima</label>
                                    <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 transition" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2">Nomor Telepon / WA</label>
                                    <input type="text" name="phone" placeholder="Contoh: 08123456789" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 transition" required>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 font-bold mb-2">Alamat Lengkap</label>
                                    <textarea name="shipping_address" rows="3" placeholder="Masukkan alamat pengiriman Anda secara lengkap..." class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 transition" required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Payment & Location Section -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center border-b pb-2">
                                    <i class="fas fa-credit-card mr-2 text-indigo-600"></i> Metode Pembayaran
                                </h2>
                                
                                <div class="space-y-3">
                                    <!-- BCA -->
                                    <label class="flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-indigo-50 transition">
                                        <input type="radio" name="payment_method" value="bca" class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300" checked>
                                        <div class="ml-4 flex items-center">
                                            <div class="w-10 h-10 flex items-center justify-center bg-blue-100 rounded-lg text-blue-800 mr-3">
                                                 <i class="fas fa-university"></i>
                                            </div>
                                            <div>
                                                <span class="block font-bold text-gray-800">Transfer Bank BCA</span>
                                                <span class="text-xs text-gray-500">Cek Otomatis</span>
                                            </div>
                                        </div>
                                    </label>

                                    <!-- DANA -->
                                    <label class="flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-blue-50 transition">
                                        <input type="radio" name="payment_method" value="dana" class="h-5 w-5 text-blue-500 focus:ring-blue-500 border-gray-300">
                                        <div class="ml-4 flex items-center">
                                            <div class="w-10 h-10 flex items-center justify-center bg-blue-100 rounded-lg text-blue-500 mr-3">
                                                 <i class="fas fa-wallet"></i>
                                            </div>
                                            <div>
                                                <span class="block font-bold text-gray-800">DANA</span>
                                                <span class="text-xs text-gray-500">E-Wallet</span>
                                            </div>
                                        </div>
                                    </label>

                                    <!-- OVO -->
                                    <label class="flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-purple-50 transition">
                                        <input type="radio" name="payment_method" value="ovo" class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300">
                                        <div class="ml-4 flex items-center">
                                            <div class="w-10 h-10 flex items-center justify-center bg-purple-100 rounded-lg text-purple-600 mr-3">
                                                 <i class="fas fa-mobile-alt"></i>
                                            </div>
                                            <div>
                                                <span class="block font-bold text-gray-800">OVO</span>
                                                <span class="text-xs text-gray-500">E-Wallet</span>
                                            </div>
                                        </div>
                                    </label>

                                    <!-- COD -->
                                    <label class="flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-green-50 transition">
                                        <input type="radio" name="payment_method" value="cod" class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300">
                                        <div class="ml-4 flex items-center">
                                            <div class="w-10 h-10 flex items-center justify-center bg-green-100 rounded-lg text-green-600 mr-3">
                                                 <i class="fas fa-hand-holding-usd"></i>
                                            </div>
                                            <div>
                                                <span class="block font-bold text-gray-800">COD (Bayar di Tempat)</span>
                                                <span class="text-xs text-gray-500">Cash on Delivery</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                @error('payment_method')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center border-b pb-2">
                                    <i class="fas fa-map-marker-alt mr-2 text-indigo-600"></i> Lokasi Toko Kami
                                </h2>
                                <div class="rounded-xl overflow-hidden border border-gray-300 h-48 relative group">
                                    <!-- Google Maps Iframe Mockup -->
                                    <iframe 
                                        width="100%" 
                                        height="100%" 
                                        frameborder="0" style="border:0" 
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.216666666667!2d106.82716666666666!3d-6.175391666666667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e76d99db%3A0x64c01d46f56c66cf!2sNational%20Monument!5e0!3m2!1sen!2sid!4v1643123456789!5m2!1sen!2sid" 
                                        allowfullscreen class="grayscale group-hover:grayscale-0 transition duration-500">
                                    </iframe>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">
                                    <i class="fas fa-info-circle mr-1"></i> Baju Anda berada di gudang pusat kami (Lokasi Monas, Jakarta).
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 border-t pt-8 flex justify-between items-center">
                            <a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-indigo-600 font-bold flex items-center transition">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Keranjang
                            </a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-10 rounded-2xl shadow-lg transform transition hover:-translate-y-1 flex items-center">
                                Konfirmasi & Bayar <i class="fas fa-check-circle ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Side: Sticky Order Summary -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden sticky top-24">
                <div class="p-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2 text-center uppercase tracking-widest">Ringkasan Belanja</h2>
                    
                    <div class="space-y-6 mb-8 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($cart as $item)
                        <div class="flex items-center">
                            <div class="h-16 w-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200">
                                @if(isset($item['image_url']))
                                    @php
                                        $imgSrc = $item['image_url'];
                                        if (!\Illuminate\Support\Str::startsWith($imgSrc, 'http')) {
                                             $imgSrc = asset('storage/' . $imgSrc);
                                        }
                                    @endphp
                                    <img src="{{ $imgSrc }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                                @else
                                    <div class="h-full w-full flex items-center justify-center text-gray-400">👕</div>
                                @endif
                            </div>
                            <div class="ml-4 flex-grow">
                                <h4 class="font-bold text-gray-800 text-sm italic line-clamp-1">{{ $item['name'] }}</h4>
                                <div class="flex justify-between items-center mt-1">
                                    <span class="text-xs text-gray-500">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                                    <span class="text-sm font-bold text-indigo-600">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t pt-4 space-y-3">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Pengiriman</span>
                            <span class="text-green-600 font-bold text-sm bg-green-50 px-2 py-1 rounded">GRATIS</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t">
                            <span class="text-lg font-bold text-gray-800">Total Pembayaran</span>
                            <span class="text-2xl font-bold text-indigo-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endsection

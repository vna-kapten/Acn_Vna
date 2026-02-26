@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-5xl">

    <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center">
        <span class="mr-3">🛒</span> Keranjang Belanja
    </h1>

    @if(empty($cart) || count($cart) == 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
            <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-shopping-basket text-4xl text-indigo-300"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Keranjang Kosong</h2>
            <p class="text-gray-500 mb-8">Wah, keranjangmu masih kosong nih. Yuk mulai belanja!</p>
            <a href="{{ route('clothes.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition transform hover:-translate-y-1 shadow-lg">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items List -->
            <div class="lg:w-2/3 space-y-6">
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                @php 
                    $subtotal = $item['price'] * $item['quantity']; 
                    $total += $subtotal; 
                @endphp
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col sm:flex-row items-center gap-6 relative group transition hover:shadow-md">
                    
                    <!-- Delete Button (Top Right for Mobile, Right Centered for Desktop) -->
                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST" class="absolute top-4 right-4 z-10">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-600 transition p-2 bg-white rounded-full hover:bg-red-50" title="Hapus Item">
                            <i class="fas fa-trash-alt text-lg"></i>
                        </button>
                    </form>

                    <!-- Image -->
                    <div class="w-full sm:w-24 h-24 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0 border border-gray-200">
                         @if(isset($item['image_url']))
                            @php
                                $imgSrc = $item['image_url'];
                                if (!\Illuminate\Support\Str::startsWith($imgSrc, 'http')) {
                                     // Fallback for old session data
                                     $imgSrc = asset('storage/' . $imgSrc);
                                }
                            @endphp
                            <img src="{{ $imgSrc }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-2xl">👕</div>
                        @endif
                    </div>

                    <!-- Details -->
                    <div class="flex-grow text-center sm:text-left w-full">
                        <h3 class="font-bold text-gray-800 text-lg mb-1">{{ $item['name'] }}</h3>
                        <p class="text-gray-500 text-sm mb-4">Harga Satuan: <span class="font-semibold text-indigo-600">Rp {{ number_format($item['price'], 0, ',', '.') }}</span></p>
                        
                        <!-- Actions Row -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            
                            <!-- Quantity Control -->
                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <input type="hidden" name="clothes_id" value="{{ $item['id'] }}">
                                
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                    <!-- Use type="submit" to trigger update when clicked -->
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="px-3 py-1 bg-gray-50 hover:bg-gray-100 text-gray-600 transition border-r border-gray-300">
                                        <i class="fas fa-minus text-xs"></i>
                                    </button>
                                    
                                    <input type="text" readonly value="{{ $item['quantity'] }}" class="w-12 text-center text-sm font-bold text-gray-800 border-none focus:ring-0 py-1 bg-white">
                                    
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-3 py-1 bg-gray-50 hover:bg-gray-100 text-gray-600 transition border-l border-gray-300">
                                        <i class="fas fa-plus text-xs"></i>
                                    </button>
                                </div>
                            </form>

                            <!-- Subtotal -->
                            <div class="text-right">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Subtotal</p>
                                <p class="text-lg font-bold text-gray-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Summary Sidebar -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 sticky top-24">
                    <h2 class="text-lg font-bold text-gray-800 mb-6 pb-4 border-b">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Item</span>
                            <span class="font-bold">{{ count($cart) }} Pcs</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Pengiriman</span>
                            <span class="text-green-600 font-bold text-sm bg-green-50 px-2 py-1 rounded">GRATIS</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-100 mb-8">
                        <span class="text-gray-800 font-bold text-lg">Total Harga</span>
                        <span class="text-2xl font-extrabold text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('orders.checkout') }}" class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl text-center shadow-lg transition transform hover:-translate-y-1">
                        Lanjut ke Pembayaran <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    
                    <div class="mt-4 text-center">
                        <a href="{{ route('clothes.index') }}" class="text-gray-500 hover:text-indigo-600 text-sm font-semibold transition">
                            <i class="fas fa-arrow-left mr-1"></i> Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 md:p-8 max-w-5xl">
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <a href="{{ route('profile.index') }}" class="text-gray-500 hover:text-indigo-600 transition">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <span class="text-gray-300">|</span>
                <span class="text-sm font-bold text-gray-500 uppercase tracking-widest">Order ID: #{{ $order->id }}</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Pesanan</h1>
        </div>
        <div class="flex items-center gap-3">
            @php
                $statusColor = match($order->status) {
                    'delivered' => 'bg-green-100 text-green-700 border-green-200',
                    'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                    'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                    'processing' => 'bg-blue-100 text-blue-700 border-blue-200',
                    default => 'bg-gray-100 text-gray-700 border-gray-200'
                };
            @endphp
            <div class="{{ $statusColor }} border px-4 py-2 rounded-xl font-bold uppercase tracking-widest text-sm flex items-center shadow-sm">
                <span class="w-2 h-2 rounded-full bg-current mr-2 animate-pulse"></span>
                {{ $order->status }}
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Order Details -->
        <div class="lg:w-2/3 space-y-8">
            <!-- Items List -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="font-bold text-gray-800 flex items-center">
                        <span class="mr-2">🛍️</span> Barang yang Dibeli
                    </h2>
                    <span class="text-sm font-semibold bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full">{{ $details->count() }} Item</span>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($details as $item)
                    <div class="p-6 flex items-start sm:items-center gap-4 hover:bg-gray-50 transition duration-150">
                        <!-- Product Image -->
                        <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0 border border-gray-200">
                             @if($item->clothes)
                                <img src="{{ $item->clothes->image_src }}" alt="{{ $item->clothes->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-tshirt text-2xl"></i>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Product Details -->
                        <div class="flex-grow grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg leading-tight mb-1">{{ $item->clothes->name ?? 'Produk Dihapus' }}</h3>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide bg-gray-100 inline-block px-2 py-1 rounded">
                                    {{ $item->clothes->category->name ?? 'Umum' }}
                                </p>
                            </div>
                            <div class="sm:text-right">
                                <p class="text-sm text-gray-500 mb-1">Harga Satuan: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                <p class="text-sm font-semibold text-gray-700">Qty: {{ $item->quantity }}</p>
                            </div>
                        </div>

                        <!-- Subtotal -->
                        <div class="text-right pl-4 border-l border-gray-100 hidden sm:block">
                            <p class="text-xs text-gray-400 mb-1">Subtotal</p>
                            <p class="font-bold text-indigo-600 text-lg">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Total Section -->
                <div class="bg-gray-50 px-6 py-6 border-t border-gray-100">
                    <div class="flex flex-col sm:flex-row justify-end items-center gap-2 sm:gap-6">
                        <span class="text-gray-500 font-medium">Total Pembayaran</span>
                        <span class="font-extrabold text-3xl text-indigo-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Shipping Info -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-800 flex items-center">
                        <span class="mr-2">🚚</span> Informasi Pengiriman
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Penerima</p>
                            <p class="font-bold text-gray-800">{{ $order->user->name }}</p>
                            <p class="text-gray-600 text-sm mt-1">{{ $order->phone }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Alamat Tujuan</p>
                            <p class="text-gray-700 leading-relaxed">{{ $order->shipping_address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar: Payment Info & Actions -->
        <div class="lg:w-1/3 space-y-8">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden sticky top-24">
                <div class="bg-indigo-600 px-6 py-4 border-b border-indigo-700 text-white">
                    <h2 class="font-bold flex items-center">
                        <span class="mr-2">💳</span> Status Pembayaran
                    </h2>
                </div>
                <div class="p-6">
                    @if($order->payment)
                        <div class="mb-6 text-center">
                            @if($order->payment->status == 'confirmed')
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 text-green-600 text-2xl">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h3 class="text-xl font-bold text-green-700">Lunas</h3>
                                <p class="text-green-600 text-sm">Pembayaran Berhasil</p>
                            @else
                                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4 text-yellow-600 text-2xl animate-pulse">
                                    <i class="fas fa-hourglass-half"></i>
                                </div>
                                <h3 class="text-xl font-bold text-yellow-700">Menunggu Pembayaran</h3>
                                <p class="text-yellow-600 text-sm">Silakan selesaikan pembayaran</p>
                            @endif
                        </div>

                        <div class="space-y-3 border-t pt-4">
                            <div class="flex justify-between">
                                <span class="text-gray-500 text-sm">Metode</span>
                                <span class="font-bold text-gray-800 uppercase">{{ $order->payment->method }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 text-sm">Tanggal</span>
                                <span class="font-bold text-gray-800">{{ $order->created_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>

                        @if($order->payment->status == 'pending' && $order->payment->method != 'cod')
                            <div class="mt-6">
                                <form action="{{ route('payments.confirm', $order->payment->id) }}" method="POST">
                                    @csrf
                                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                                        Konfirmasi Pembayaran
                                    </button>
                                    <p class="text-xs text-center text-gray-400 mt-2">Klik untuk simulasi pelunasan transfer bank</p>
                                </form>
                            </div>
                        @elseif($order->payment->method == 'cod')
                             <div class="mt-6 bg-gray-50 p-4 rounded-xl text-center border border-gray-200">
                                <p class="text-sm text-gray-600">Siapkan uang tunai sebesar <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong> saat kurir tiba.</p>
                            </div>
                        @endif

                    @else
                        <!-- No Payment Record found fallback -->
                        <div class="text-center py-4">
                            <p class="text-gray-500 italic">Informasi pembayaran tidak tersedia.</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="bg-indigo-50 rounded-2xl p-6 border border-indigo-100">
                 <h3 class="font-bold text-indigo-900 mb-2">Butuh Bantuan?</h3>
                 <p class="text-indigo-700 text-sm mb-4">Jika ada masalah dengan pesanan ini, hubungi CS kami.</p>
                 <a href="https://wa.me/628123456789" target="_blank" class="block w-full text-center bg-white text-indigo-600 hover:bg-indigo-50 border border-indigo-200 font-bold py-2 rounded-lg transition">
                     <i class="fab fa-whatsapp mr-2"></i> Hubungi via WhatsApp
                 </a>
            </div>
        </div>
    </div>
</div>
@endsection

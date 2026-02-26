@extends('layouts.admin')

@section('content')
<!-- Welcome Section -->
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg shadow-lg p-8 mb-8">
    <h1 class="text-4xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 🎉</h1>
    <p class="text-indigo-100">Kelola toko thrift Anda dengan mudah melalui dashboard admin</p>
</div>

<!-- Statistics Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Produk -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold">Total Produk</p>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalClothes }}</p>
            </div>
            <div class="text-4xl">👕</div>
        </div>
    </div>

    <!-- Pesanan Hari Ini -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold">Pesanan Hari Ini</p>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $ordersToday }}</p>
            </div>
            <div class="text-4xl">📦</div>
        </div>
    </div>

    <!-- Pembayaran Tertunda -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold">Pembayaran Tertunda</p>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pendingPayments }}</p>
            </div>
            <div class="text-4xl">⏳</div>
        </div>
    </div>

    <!-- Total Pengguna -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold">Total Pengguna</p>
                <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalUsers }}</p>
            </div>
            <div class="text-4xl">👥</div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">📋 Pesanan Terbaru</h2>
        <div class="space-y-4">
            @forelse($recentOrders as $order)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                    <p class="font-semibold text-gray-800">Order #{{ $order->id }}</p>
                    <p class="text-sm text-gray-600">{{ $order->user->name ?? 'Guest' }}</p>
                </div>
                @php
                    $statusColor = match($order->status) {
                        'completed' => 'bg-green-100 text-green-800',
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'cancelled' => 'bg-red-100 text-red-800',
                        default => 'bg-gray-100 text-gray-800',
                    };
                @endphp
                <span class="{{ $statusColor }} px-3 py-1 rounded-full text-sm font-semibold">{{ ucfirst($order->status) }}</span>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">Belum ada pesanan terbaru.</p>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">⚡ Aksi Cepat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @if(Auth::user()->role == 'admin')
            <a href="{{ route('admin.clothes.create') }}" class="flex flex-col items-center justify-center bg-pink-600 text-white p-6 rounded-xl hover:bg-pink-700 font-semibold transition shadow-md hover:shadow-lg">
                <span class="text-2xl mb-2">👕</span>
                <span>Tambah Pakaian</span>
            </a>
            <a href="{{ route('admin.product.create') }}" class="flex flex-col items-center justify-center bg-indigo-600 text-white p-6 rounded-xl hover:bg-indigo-700 font-semibold transition shadow-md hover:shadow-lg">
                <span class="text-2xl mb-2">➕</span>
                <span>Tambah Produk</span>
            </a>
            @endif
            <!-- <a href="{{ route('admin.product.index') }}" class="flex flex-col items-center justify-center bg-purple-600 text-white p-6 rounded-xl hover:bg-purple-700 font-semibold transition shadow-md hover:shadow-lg">
                <span class="text-2xl mb-2">📝</span>
                <span>Lihat Produk</span>
            </a> -->
                <a href="{{ route('admin.clothes.index') }}" class="flex flex-col items-center justify-center bg-purple-600 text-white p-6 rounded-xl hover:bg-purple-700 font-semibold transition shadow-md hover:shadow-lg">
                <span class="text-2xl mb-2">👔</span>
                <span>Kelola Pakaian</span>
            </a>
            
            <a href="{{ route('admin.orders.index') }}" class="flex flex-col items-center justify-center bg-green-600 text-white p-6 rounded-xl hover:bg-green-700 font-semibold transition shadow-md hover:shadow-lg">
                <span class="text-2xl mb-2">📦</span>
                <span>Kelola Pesanan</span>
            </a>
            <a href="{{ route('admin.payments.index') }}" class="flex flex-col items-center justify-center bg-orange-500 text-white p-6 rounded-xl hover:bg-orange-600 font-semibold transition shadow-md hover:shadow-lg">
                <span class="text-2xl mb-2">💳</span>
                <span>Cek Pembayaran</span>
            </a>
        </div>
    </div>
</div>
@endsection

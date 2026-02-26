@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 m-4 max-w-5xl mx-auto">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
            <p class="font-bold">Gagal!</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Header -->
    <div class="flex justify-between items-center mb-8 border-b pb-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <span class="mr-3 text-indigo-600">📦</span> Detail Pesanan #{{ $order->id }}
            </h1>
            <p class="text-gray-500 mt-1">Dipesan oleh <span class="font-bold text-gray-700">{{ $order->user->name }}</span> pada {{ $order->created_at->format('d M Y H:i') }}</p>
        </div>
        <div class="flex flex-col items-end">
             <span class="px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wider
                {{ $order->status == 'delivered' ? 'bg-green-100 text-green-800' : 
                   ($order->status == 'cancelled' ? 'bg-red-100 text-red-800' : 
                   ($order->status == 'processing' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800')) }}">
                {{ $order->status }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <!-- Shipping Info -->
        <div class="md:col-span-2 bg-gray-50 rounded-xl p-6 border border-gray-200">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-truck mr-2 text-indigo-500"></i> Informasi Pengiriman
            </h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Penerima:</span>
                    <span class="font-bold text-gray-800">{{ $order->user->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">No. HP:</span>
                    <span class="font-bold text-gray-800">{{ $order->phone ?? $order->user->phone ?? '-' }}</span>
                </div>
                <div>
                     <span class="text-gray-500 block mb-1">Alamat:</span>
                     <p class="font-medium text-gray-800 bg-white p-3 rounded border border-gray-200">{{ $order->shipping_address ?? 'Alamat tidak tersedia' }}</p>
                </div>
            </div>
        </div>

        <!-- Payment Info -->
        <div class="bg-indigo-50 rounded-xl p-6 border border-indigo-100">
            <h3 class="font-bold text-indigo-900 mb-4 flex items-center">
                <i class="fas fa-credit-card mr-2 text-indigo-600"></i> Status Pembayaran
            </h3>
            
            @if($order->payment)
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-indigo-700 text-sm">Metode:</span>
                        <span class="font-bold text-indigo-900 uppercase bg-white px-2 py-1 rounded shadow-sm border border-indigo-100">{{ $order->payment->method }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-indigo-700 text-sm">Status:</span>
                        <span class="font-bold {{ $order->payment->status == 'confirmed' ? 'text-green-600' : 'text-yellow-600' }} uppercase bg-white px-2 py-1 rounded shadow-sm">
                            {{ $order->payment->status }}
                        </span>
                    </div>
                    
                    @if($order->payment->status == 'pending')
                    <div class="mt-4 pt-4 border-t border-indigo-200">
                        <form action="{{ route('admin.payments.confirm', $order->payment->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded flex items-center justify-center transition shadow-md" onclick="return confirm('Konfirmasi pembayaran ini?')">
                                <i class="fas fa-check mr-2"></i> Konfirmasi Bayar
                            </button>
                        </form>
                        <p class="text-xs text-indigo-500 mt-2 text-center">Konfirmasi jika dana sudah masuk.</p>
                    </div>
                    @else
                     <div class="mt-4 pt-4 border-t border-indigo-200 text-center">
                        <span class="text-green-600 font-bold flex items-center justify-center">
                            <i class="fas fa-check-circle mr-2"></i> Pembayaran Selesai
                        </span>
                        <p class="text-xs text-gray-500 mt-1">{{ $order->payment->updated_at->format('d M Y H:i') }}</p>
                    </div>
                    @endif
                </div>
            @else
                <div class="text-center py-4 bg-white rounded border border-indigo-200">
                    <p class="text-indigo-800 font-bold mb-1">Belum ada data pembayaran</p>
                    <span class="text-xs text-indigo-500">Mungkin COD atau belum dibuat.</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Order Items -->
    <div class="mb-8 bg-white rounded-xl border border-gray-200 overflow-hidden">
        <h3 class="bg-gray-50 px-6 py-4 font-bold text-gray-800 border-b flex items-center">
            <i class="fas fa-tshirt mr-2 text-indigo-500"></i> Daftar Barang
        </h3>
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-3">Produk</th>
                    <th class="px-6 py-3 text-center">Harga</th>
                    <th class="px-6 py-3 text-center">Jumlah</th>
                    <th class="px-6 py-3 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($order->orderDetails as $detail)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded bg-gray-100 flex-shrink-0 overflow-hidden border border-gray-200 mr-4">
                                @if($detail->clothes)
                                    <img src="{{ $detail->clothes->image_src }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400"><i class="fas fa-image"></i></div>
                                @endif
                            </div>
                            <div>
                                <div class="font-bold text-gray-800">{{ $detail->clothes->name ?? 'Produk Dihapus' }}</div>
                                <div class="text-xs text-gray-500">{{ $detail->clothes->category->name ?? '-' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center text-gray-600">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center font-bold text-gray-800">x{{ $detail->quantity }}</td>
                    <td class="px-6 py-4 text-right font-bold text-indigo-600">Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-50 border-t border-gray-200">
                <tr>
                    <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-600">Total Pesanan</td>
                    <td class="px-6 py-4 text-right font-bold text-xl text-indigo-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Admin Actions -->
    <div class="flex flex-col md:flex-row justify-between items-center bg-gray-50 p-6 rounded-xl border border-gray-200 gap-4">
        <div>
            <a href="{{ route('admin.orders.index') }}" class="text-gray-600 font-bold hover:text-indigo-600 flex items-center transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
            </a>
        </div>
        
        <!-- Status Update Form -->
        {{-- Nanti bisa ditambahkan form update status di sini kalau user minta --}}
        
        <div class="flex gap-3">
            @if($order->status != 'delivered')
                <form action="{{ route('admin.orders.complete', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-bold transition shadow-md flex items-center" onclick="return confirm('Tandai pesanan ini sebagai selesai?')">
                        <i class="fas fa-check-double mr-2"></i> Selesai
                    </button>
                </form>
            @else
                <span class="bg-green-100 text-green-700 px-6 py-2 rounded-lg font-bold border border-green-200 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i> Sudah Selesai
                </span>
            @endif
        </div>
    </div>
</div>
@endsection

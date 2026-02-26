@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 m-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
            <span class="mr-3">📦</span> Data Pesanan
        </h1>
    </div>

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                <tr>
                    <th class="p-4 border-b">ID</th>
                    <th class="p-4 border-b">Pembeli</th>
                    <th class="p-4 border-b">Total</th>
                    <th class="p-4 border-b">Metode Bayar</th>
                    <th class="p-4 border-b">Status Pesanan</th>
                    <th class="p-4 border-b">Tanggal</th>
                    <th class="p-4 border-b text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-mono text-xs text-gray-500">#{{ $order->id }}</td>
                    <td class="p-4 font-bold text-gray-800">
                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold mr-3 text-xs">
                                {{ substr($order->user->name, 0, 1) }}
                            </div>
                            {{ $order->user->name }}
                        </div>
                    </td>
                    <td class="p-4 font-bold text-gray-800">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>
                    <td class="p-4">
                        @if($order->payment)
                             <span class="px-2 py-1 rounded text-xs font-bold uppercase border bg-gray-50 text-gray-600 border-gray-200">
                                {{ $order->payment->method }}
                            </span>
                        @else
                            <span class="text-gray-400 text-xs italic">Belum ada</span>
                        @endif
                    </td>
                    <td class="p-4">
                        @php
                            $statusClass = match($order->status) {
                                'delivered' => 'bg-green-100 text-green-700',
                                'paid'      => 'bg-blue-100 text-blue-700',
                                'processing'=> 'bg-blue-100 text-blue-700',
                                'pending'   => 'bg-yellow-100 text-yellow-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                                default     => 'bg-gray-100 text-gray-700',
                            };
                            
                            $statusIcon = match($order->status) {
                                'delivered' => 'check-circle',
                                'paid'      => 'dollar-sign',
                                'processing'=> 'cog',
                                'pending'   => 'clock',
                                'cancelled' => 'times-circle',
                                default     => 'question-circle',
                            };
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                            <i class="fas fa-{{ $statusIcon }} mr-2"></i> {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="p-4 text-xs text-gray-500">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="p-4 text-right">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center justify-center bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-3 py-1 rounded-lg text-xs font-bold transition shadow-sm">
                            <i class="fas fa-eye mr-2 text-indigo-500"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-8 text-center text-gray-500 italic">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection

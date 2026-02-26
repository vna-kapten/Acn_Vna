@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 m-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
            <span class="mr-3">💳</span> Data Pembayaran
        </h1>
    </div>

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                <tr>
                    <th class="p-4 border-b">ID</th>
                    <th class="p-4 border-b">Order ID</th>
                    <th class="p-4 border-b">Metode</th>
                    <th class="p-4 border-b">Jumlah</th>
                    <th class="p-4 border-b">Status</th>
                    <th class="p-4 border-b">Tanggal</th>
                    <th class="p-4 border-b text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($payments as $payment)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-mono text-xs text-gray-500">#{{ $payment->id }}</td>
                    <td class="p-4 font-bold text-indigo-600">
                        <a href="{{ route('orders.show', $payment->order_id) }}" class="hover:underline">
                            #Order-{{ $payment->order_id }}
                        </a>
                    </td>
                    <td class="p-4">
                        @php
                            $methodClass = match($payment->method) {
                                'bca' => 'bg-blue-100 text-blue-800 border-blue-200',
                                'dana' => 'bg-blue-50 text-blue-600 border-blue-200',
                                'ovo' => 'bg-purple-100 text-purple-800 border-purple-200',
                                'cod' => 'bg-green-100 text-green-800 border-green-200',
                                default => 'bg-gray-100 text-gray-800 border-gray-200',
                            };
                            
                            $icon = match($payment->method) {
                                'bca' => 'university',
                                'dana' => 'wallet',
                                'ovo' => 'mobile-alt',
                                'cod' => 'hand-holding-usd',
                                default => 'credit-card',
                            };
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border {{ $methodClass }}">
                            <i class="fas fa-{{ $icon }} mr-2"></i> {{ strtoupper($payment->method) }}
                        </span>
                    </td>
                    <td class="p-4 font-bold text-gray-800">
                        Rp {{ number_format($payment->amount, 0, ',', '.') }}
                    </td>
                    <td class="p-4">
                        @php
                            $statusClass = match($payment->status) {
                                'confirmed' => 'bg-green-100 text-green-700',
                                'paid' => 'bg-green-100 text-green-700',
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'failed' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    <td class="p-4 text-sm text-gray-500">
                        {{ $payment->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="p-4 text-right">
                         @if($payment->status == 'pending')
                         <form action="{{ route('admin.payments.confirm', $payment->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Konfirmasi pembayaran ini?');">
                            @csrf
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-xs font-bold transition shadow">
                                <i class="fas fa-check"></i> Konfirmasi
                            </button>
                         </form>
                         @else
                         <span class="text-green-500 font-bold text-xs"><i class="fas fa-check-double"></i> Selesai</span>
                         @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-8 text-center text-gray-500 italic">Belum ada data pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $payments->links() }}
    </div>
</div>
@endsection

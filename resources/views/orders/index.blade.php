@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Riwayat Pembelian</h1>
    @foreach($orders as $order)
    <div class="border p-3 mb-2">
        <div>Order #{{ $order->id }} - {{ $order->status }}</div>
        <div>Total: Rp {{ number_format($order->total_price,0,',','.') }}</div>
        <a href="{{ route('orders.show', $order->id) }}">Detail</a>
    </div>
    @endforeach
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Pembayaran untuk Order #{{ $order->id }}</h1>
    <div>Total: Rp {{ number_format($order->total_price,0,',','.') }}</div>
    <div class="mt-4">Metode: {{ $order->payment->method ?? '-' }}</div>
    <div>Status: {{ $order->payment->status ?? 'pending' }}</div>
</div>
@endsection

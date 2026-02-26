@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Produk</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $p)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $p->nama }}</h2>
                <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full mb-4">{{ $p->kategori }}</span>
                <p class="text-gray-600 text-sm mb-4">{{ $p->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold text-indigo-600">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                    <span class="text-sm font-semibold {{ $p->stok > 0 ? 'text-green-600' : 'text-red-500' }}">
                        {{ $p->stok > 0 ? 'Stok: ' . $p->stok : 'Habis' }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
     @if($products->isEmpty())
    <div class="p-6 text-center text-gray-500">
        Belum ada produk tersedia.
    </div>
    @endif
</div>
@endsection

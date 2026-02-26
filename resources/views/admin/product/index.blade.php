@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen Produk</h1>
        @if(Auth::user()->role == 'admin')
        <a href="{{ route('admin.product.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
            + Tambah Produk
        </a>
        @endif
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse ($products as $p)
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition duration-300 border border-gray-100 overflow-hidden flex flex-col">
            <div class="p-6 flex-grow">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-xl font-bold text-gray-800 leading-tight">{{ $p->nama }}</h2>
                    <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2 py-1 rounded-lg">{{ $p->kategori }}</span>
                </div>
                <div class="space-y-2 mb-4 text-sm text-gray-600">
                    <p class="flex items-center"><span class="mr-2">💰</span> Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                    <p class="flex items-center"><span class="mr-2">📦</span> Stok: <span class="font-bold {{ $p->stok > 10 ? 'text-green-600' : 'text-orange-500' }}">{{ $p->stok }}</span></p>
                </div>
                <p class="text-gray-500 text-xs italic line-clamp-2 mb-4">{{ $p->deskripsi ?? 'Tidak ada deskripsi' }}</p>
            </div>
            
            @if(Auth::user()->role == 'admin')
            <div class="bg-gray-50 p-4 border-t border-gray-100 flex gap-2">
                <a href="{{ route('admin.product.edit', $p->id) }}" class="flex-1 bg-white border border-blue-500 text-blue-600 hover:bg-blue-50 text-center py-2 rounded-xl text-sm font-bold transition">
                    Edit
                </a>
                <form action="{{ route('admin.product.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-white border border-red-500 text-red-600 hover:bg-red-50 py-2 rounded-xl text-sm font-bold transition">
                        Hapus
                    </button>
                </form>
            </div>
            @endif
        </div>
        @empty
        <div class="col-span-full py-12 text-center bg-white rounded-2xl shadow-sm border border-dashed border-gray-300">
            <p class="text-gray-500">Belum ada data produk tersedia.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

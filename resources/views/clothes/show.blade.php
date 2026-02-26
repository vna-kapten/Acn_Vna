@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <div class="flex flex-col md:flex-row">
            <!-- Image Section -->
            <div class="md:w-1/2 bg-gray-100 relative h-96 md:h-auto min-h-[500px]">
                <img src="{{ $clothes->image_src }}" 
                     alt="{{ $clothes->name }}" 
                     class="absolute inset-0 w-full h-full object-cover">
                     
                <!-- Back Button Overlay -->
                <a href="{{ route('clothes.index') }}" class="absolute top-4 left-4 bg-white/80 backdrop-blur-md p-3 rounded-full shadow-lg hover:bg-white transition text-gray-700">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            <!-- Details Section -->
            <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                <div class="mb-6">
                    <p class="text-sm font-bold text-indigo-500 uppercase tracking-widest mb-2">{{ $clothes->category->name ?? 'Umum' }}</p>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">{{ $clothes->name }}</h1>
                    
                    <!-- PRICE IS HERE NOW (ABOVE DESCRIPTION) -->
                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-3xl font-bold text-indigo-600">Rp {{ number_format($clothes->price, 0, ',', '.') }}</span>
                        
                        @if($clothes->stock > 0)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold flex items-center">
                                <i class="fas fa-check-circle mr-1"></i> Stok: {{ $clothes->stock }}
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold flex items-center">
                                <i class="fas fa-times-circle mr-1"></i> Habis
                            </span>
                        @endif
                    </div>
                </div>

                <div class="prose prose-indigo text-gray-600 mb-8 leading-relaxed">
                    <h3 class="font-bold text-gray-800 mb-2">Deskripsi Produk</h3>
                    <p>{{ $clothes->description ?? 'Tidak ada deskripsi detail untuk produk ini.' }}</p>
                    
                     <div class="mt-4 flex gap-2">
                         <span class="px-3 py-1 bg-gray-50 border border-gray-200 rounded text-sm font-semibold text-gray-600">
                            Size: {{ $clothes->size ?? 'All Size' }}
                        </span>
                        <span class="px-3 py-1 bg-gray-50 border border-gray-200 rounded text-sm font-semibold text-gray-600">
                            Color: {{ $clothes->color ?? '-' }}
                        </span>
                         <span class="px-3 py-1 bg-gray-50 border border-gray-200 rounded text-sm font-semibold text-gray-600">
                            Kondisi: {{ $clothes->condition ?? 'Good' }}
                        </span>
                    </div>
                </div>

                <!-- Admin Actions -->
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <div class="flex gap-3 mb-8 p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest self-center mr-2">Admin:</span>
                        <a href="{{ route('admin.clothes.edit', $clothes->id) }}" class="flex-1 bg-white border border-yellow-400 text-yellow-600 hover:bg-yellow-50 px-4 py-2 rounded-lg font-bold shadow-sm transition text-center">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <form action="{{ route('admin.clothes.destroy', $clothes->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus pakaian ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-white border border-red-500 text-red-600 hover:bg-red-50 px-4 py-2 rounded-lg font-bold shadow-sm transition">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                @endif

                <!-- Purchase Form -->
                <div class="mt-auto pt-8 border-t border-gray-100">
                    @if($clothes->stock > 0)
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="clothes_id" value="{{ $clothes->id }}">
                        
                        <div class="flex items-center gap-6 mb-6">
                            <label class="font-bold text-gray-700">Jumlah:</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden w-32">
                                <button type="button" onclick="decrementQty()" class="px-3 py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 transition border-r border-gray-300">-</button>
                                <input type="number" id="qtyInput" name="quantity" value="1" min="1" max="{{ $clothes->stock }}" class="w-full text-center font-bold text-gray-800 border-none focus:ring-0 py-2">
                                <button type="button" onclick="incrementQty()" class="px-3 py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 transition border-l border-gray-300">+</button>
                            </div>
                        </div>

                        <div class="flex gap-4 flex-col sm:flex-row">
                            <button type="submit" class="flex-1 bg-white border-2 border-indigo-600 text-indigo-600 font-bold py-4 rounded-xl hover:bg-indigo-50 transition transform active:scale-95 flex items-center justify-center">
                                <i class="fas fa-cart-plus mr-2"></i> Tambah Keranjang
                            </button>
                            <button type="submit" name="buy_now" value="1" class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-4 rounded-xl hover:shadow-lg hover:from-indigo-700 hover:to-purple-700 transition transform active:scale-95 flex items-center justify-center">
                                <i class="fas fa-bolt mr-2"></i> Beli Sekarang
                            </button>
                        </div>
                    </form>
                    @else
                        <button disabled class="w-full bg-gray-200 text-gray-500 font-bold py-4 rounded-xl cursor-not-allowed">
                            Stok Habis
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function incrementQty() {
        var input = document.getElementById('qtyInput');
        var max = input.getAttribute('max');
        if (parseInt(input.value) < parseInt(max)) {
            input.value = parseInt(input.value) + 1;
        }
    }
    function decrementQty() {
        var input = document.getElementById('qtyInput');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>
@endsection

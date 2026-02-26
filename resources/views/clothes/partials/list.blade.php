@if($clothes->isEmpty())
    <div class="col-span-full text-center py-16 bg-white rounded-3xl shadow-sm border border-gray-100">
        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-search text-gray-300 text-4xl"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-700 mb-2">Tidak ada hasil ditemukan</h2>
        <p class="text-gray-500">Coba kata kunci lain atau lihat semua koleksi kami.</p>
        <a href="{{ route('clothes.index') }}" class="inline-block mt-4 text-indigo-600 font-bold hover:underline">Lihat Semua</a>
    </div>
@else
    @foreach($clothes as $c)
    <div class="bg-white border border-gray-100 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden flex flex-col h-full group">
        <!-- Image Container -->
        <div class="relative h-64 overflow-hidden bg-gray-100">
            <img src="{{ $c->image_src }}" 
                 alt="{{ $c->name }}" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            
            <!-- Overlay Badge -->
            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full shadow-sm text-xs font-bold text-gray-800 border border-gray-200">
                {{ $c->category->name ?? 'Umum' }}
            </div>
        </div>

        <!-- Content -->
        <div class="p-5 flex-grow flex flex-col">
            <h3 class="font-bold text-lg text-gray-900 mb-1 leading-tight group-hover:text-indigo-600 transition">{{ $c->name }}</h3>
            
            <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $c->description ?? 'Deskripsi tidak tersedia.' }}</p>

            <!-- Tag Row -->
            <div class="flex gap-2 mb-4">
                 <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded border border-gray-200">
                    Size: {{ $c->size ?? 'All Size' }}
                </span>
            </div>

            <!-- Price & Stock Row (Moved to Bottom) -->
            <div class="flex justify-between items-center mb-3 mt-auto pt-4 border-t border-gray-50">
                 <span class="text-xl font-extrabold text-indigo-600">Rp {{ number_format($c->price, 0, ',', '.') }}</span>
                 @if($c->stock > 0)
                    <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full">Stok: {{ $c->stock }}</span>
                @else
                    <span class="text-xs font-bold text-red-600 bg-red-50 px-2 py-1 rounded-full">Habis</span>
                @endif
            </div>

            <!-- Actions (Add to Cart & Buy Now) -->
            <div class="mt-4">
                @if($c->stock > 0)
                    <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col gap-2">
                        @csrf
                        <input type="hidden" name="clothes_id" value="{{ $c->id }}">
                        <input type="hidden" name="quantity" value="1">
                        
                        <div class="grid grid-cols-1 gap-2">
                            <button type="submit" class="w-full bg-indigo-50 text-indigo-700 hover:bg-indigo-100 font-bold py-2 px-4 rounded-xl flex items-center justify-center transition duration-200 text-sm">
                                <i class="fas fa-cart-plus mr-2"></i> Masuk Keranjang
                            </button>
                            
                            <button type="submit" name="buy_now" value="1" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-xl flex items-center justify-center transition duration-200 shadow-md hover:shadow-lg transform active:scale-95 text-sm">
                                <i class="fas fa-bolt mr-2"></i> Beli Sekarang
                            </button>
                        </div>
                    </form>
                @else
                    <button disabled class="w-full bg-gray-200 text-gray-500 font-bold py-3 px-4 rounded-xl cursor-not-allowed">
                        Stok Habis
                    </button>
                @endif
            </div>
        </div>
    </div>
    @endforeach
@endif

<!-- Add Pagination Links if needed -->
@if(method_exists($clothes, 'links'))
<div class="mt-12 w-full col-span-full">
    {{ $clothes->withQueryString()->links() }}
</div>
@endif

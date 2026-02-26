@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div class="flex items-center gap-3">
            <h1 class="text-3xl font-bold text-gray-800">Kelola Pakaian</h1>
            </span>
        </div>
        
        <div class="flex gap-3">
            </a>
            <a href="{{ route('admin.clothes.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow transition duration-200 flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Pakaian
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm" role="alert">
        <p class="font-bold">Berhasil!</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($clothes as $c)
        <div class="bg-white border border-gray-200 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col h-full relative group">
            
            <!-- Admin Floating Actions (Quick Access) -->
            <div class="absolute top-2 right-2 flex flex-col space-y-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-10">
                <a href="{{ route('admin.clothes.edit', $c->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white p-2 rounded-full shadow-md transition transform hover:scale-110" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.clothes.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pakaian ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full shadow-md transition transform hover:scale-110" title="Hapus">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>

            <div class="relative overflow-hidden">
                <img src="{{ Str::startsWith($c->image_url, 'http') ? $c->image_url : ($c->image_url ? asset('storage/'.$c->image_url) : asset('images/placeholder.png')) }}" alt="{{ $c->name }}" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4 opacity-70"></div>
                <div class="absolute bottom-4 left-4 text-white">
                    <p class="font-bold text-lg shadow-black drop-shadow-md">Rp {{ number_format($c->price, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="p-5 flex-grow flex flex-col">
                <div class="mb-2">
                    <h3 class="font-bold text-xl text-gray-900 mb-1 leading-tight">{{ $c->name }}</h3>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span class="inline-block bg-indigo-50 text-indigo-700 text-xs px-2 py-1 rounded-full uppercase font-bold tracking-wide border border-indigo-100">
                            {{ $c->category->name ?? 'Uncategorized' }}
                        </span>
                        <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full uppercase font-semibold">
                            Size: {{ $c->size ?? 'All Size' }}
                        </span>
                    </div>
                </div>
                
                <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $c->description ?? 'Tidak ada deskripsi.' }}</p>

                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                    <div>
                        <span class="text-xs text-gray-500 uppercase font-bold">Stok</span>
                         @if($c->stock > 0)
                            <div class="text-green-600 font-bold bg-green-50 px-2 py-1 rounded">
                                {{ $c->stock }} Available
                            </div>
                        @else
                            <div class="text-red-600 font-bold bg-red-50 px-2 py-1 rounded">
                                Habis
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex gap-2">
                         <a href="{{ route('admin.clothes.edit', $c->id) }}" class="text-gray-400 hover:text-yellow-500 transition" title="Edit Detail">
                            <i class="fas fa-cog text-xl"></i>
                        </a>
                         <a href="{{ route('clothes.show', $c->id) }}" target="_blank" class="text-gray-400 hover:text-indigo-600 transition" title="Lihat di Web">
                            <i class="fas fa-external-link-alt text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Explicit Actions for Mobile/Tablet where hover might be tricky -->
                <div class="mt-4 grid grid-cols-2 gap-2 md:hidden">
                    <a href="{{ route('admin.clothes.edit', $c->id) }}" class="bg-yellow-400 text-white text-center py-2 rounded-lg font-bold text-sm">Edit</a>
                     <form action="{{ route('admin.clothes.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Hapus?');">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white w-full py-2 rounded-lg font-bold text-sm">Hapus</button>
                    </form>
                </div>

            </div>
        </div>
        @foreach($clothes as $c)
        @endforeach <!-- Hack to close the loop correctly if strict matching fails, usually blade is smart -->
        @endforeach
    </div>
    <div class="mt-6">
        {{ $clothes->links() }}
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-7xl">
    <!-- Header & Search -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <span class="mr-2">👗</span> Koleksi Pakaian
        </h1>
        
        <!-- Live Search Input -->
        <div class="w-full md:w-1/3 relative z-50">
            <form action="{{ route('clothes.index') }}" method="GET">
                <div class="relative">
                    <input type="text" 
                           id="search-input"
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari baju impianmu..." 
                           autocomplete="off"
                           class="w-full pl-12 pr-4 py-3 bg-white border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    
                    <!-- Loading Indicator -->
                    <div id="loading-spinner" class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none hidden">
                        <svg class="animate-spin h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            </form>

            <!-- Search Dropdown Results -->
            <div id="search-dropdown" class="absolute top-full left-0 w-full bg-white shadow-xl rounded-2xl border border-gray-100 hidden overflow-hidden mt-2 divide-y divide-gray-50">
                <!-- Content injected via JS -->
            </div>
        </div>
    </div>

    <!-- Product Grid Container -->
    <div id="clothes-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @include('clothes.partials.list')
    </div>
    
    <div class="mt-8">
        {{ $clothes->links() }}
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let timer;
        const dropdown = $('#search-dropdown');
        const spinner = $('#loading-spinner');

        // Close dropdown when clicking outside
        $(document).click(function(e) {
            if (!$(e.target).closest('#search-input, #search-dropdown').length) {
                dropdown.addClass('hidden');
            }
        });

        $('#search-input').on('keyup focus', function() {
            clearTimeout(timer);
            let query = $(this).val();

            if (query.length < 2) {
                dropdown.addClass('hidden');
                return;
            }

            // Show spinner
            spinner.removeClass('hidden');

            timer = setTimeout(function() {
                $.ajax({
                    url: "{{ route('clothes.suggestions') }}",
                    type: "GET",
                    data: { query: query },
                    success: function(data) {
                        spinner.addClass('hidden');
                        let html = '';

                        if (data.length > 0) {
                            // Header Result
                            html += `<div class="px-4 py-2 bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider">Hasil Pencarian</div>`;
                            
                            data.forEach(item => {
                                let price = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(item.price);
                                
                                html += `
                                <a href="/clothes/${item.id}" class="flex items-center p-3 hover:bg-indigo-50 transition duration-150 group">
                                    <div class="w-10 h-10 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200">
                                        <img src="${item.image_url}" alt="${item.name}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="ml-3 flex-grow">
                                        <p class="text-sm font-bold text-gray-800 group-hover:text-indigo-700 leading-tight">${item.name}</p>
                                        <p class="text-xs font-bold text-indigo-600 mt-0.5">${price}</p>
                                    </div>
                                    <div class="text-gray-400">
                                        <i class="fas fa-chevron-right text-xs"></i>
                                    </div>
                                </a>
                                `;
                            });
                            
                            // 'See all' link at bottom
                            html += `
                            <a href="{{ route('clothes.index') }}?search=${query}" class="block text-center py-3 bg-gray-50 text-indigo-600 font-bold text-sm hover:bg-gray-100 transition border-t border-gray-100">
                                Lihat semua hasil untuk "${query}"
                            </a>
                            `;
                        } else {
                            html = `
                            <div class="p-6 text-center">
                                <div class="text-gray-400 mb-2 text-2xl">🤔</div>
                                <p class="text-gray-500 text-sm">Tidak ditemukan hasil untuk "<strong>${query}</strong>"</p>
                            </div>
                            `;
                        }

                        dropdown.html(html).removeClass('hidden');
                    },
                    error: function() {
                        spinner.addClass('hidden');
                    }
                });
            }, 300); // 300ms debounce
        });
    });
</script>
@endsection

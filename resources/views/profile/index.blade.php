@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 md:p-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="bg-indigo-600 rounded-3xl p-8 mb-8 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-10 rounded-full -ml-24 -mb-24"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center text-4xl shadow-inner text-indigo-600">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold mb-1">Halo, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-indigo-100 opacity-90">Kelola akun dan pesananmu di sini.</p>
                        <div class="mt-2 inline-block bg-indigo-500 bg-opacity-50 px-3 py-1 rounded-lg text-sm">
                            {{ Auth::user()->email }}
                        </div>
                    </div>
                </div>
                <div>
                     <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-white text-indigo-600 hover:bg-indigo-50 px-6 py-2 rounded-xl font-bold shadow-md transition transform hover:-translate-y-1">
                            LOGOUT
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Navigation -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-lg p-4 sticky top-24">
                    <nav class="flex flex-col gap-2" id="profileTabs">
                        <button onclick="switchTab('orders')" id="tab-orders" class="profile-tab active text-left px-4 py-3 rounded-xl font-bold text-gray-700 hover:bg-gray-50 flex items-center gap-3 transition">
                            <span class="text-xl">🛍️</span> Riwayat Pembelian
                        </button>
                        <button onclick="switchTab('payments')" id="tab-payments" class="profile-tab text-left px-4 py-3 rounded-xl font-bold text-gray-700 hover:bg-gray-50 flex items-center gap-3 transition">
                            <span class="text-xl">💳</span> Metode Pembayaran
                        </button>
                        <button onclick="switchTab('settings')" id="tab-settings" class="profile-tab text-left px-4 py-3 rounded-xl font-bold text-gray-700 hover:bg-gray-50 flex items-center gap-3 transition">
                            <span class="text-xl">⚙️</span> Setting Akun
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:w-3/4">
                
                <!-- Section: Riwayat Pembelian -->
                <div id="content-orders" class="profile-content bg-white rounded-2xl shadow-lg p-6 lg:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="mr-3 text-indigo-600">📜</span> Daftar Pesanan
                    </h2>
                    
                    @if($orders->count() > 0)
                        <div class="space-y-6">
                            @foreach($orders as $order)
                            <div class="border border-gray-100 rounded-xl hover:shadow-md transition duration-300 overflow-hidden bg-white">
                                <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                    <div>
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Order ID</p>
                                        <p class="font-mono text-gray-800 font-bold">#{{ $order->id }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Tanggal</p>
                                        <p class="text-gray-800">{{ $order->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Total</p>
                                        <p class="text-indigo-600 font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="mt-2 sm:mt-0">
                                        @php
                                            $statusColor = match($order->status) {
                                                'completed' => 'bg-green-100 text-green-700',
                                                'pending' => 'bg-yellow-100 text-yellow-700',
                                                'cancelled' => 'bg-red-100 text-red-700',
                                                'processing' => 'bg-blue-100 text-blue-700',
                                                default => 'bg-gray-100 text-gray-700'
                                            };
                                        @endphp
                                        <span class="{{ $statusColor }} px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                                            {{ $order->status }}
                                        </span>
                                    </div>
                                </div>
                                <div class="px-6 py-4 bg-white border-t border-gray-100">
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm text-gray-600">
                                            {{ $order->shipping_address }} (Telp: {{ $order->phone }})
                                        </p>
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-indigo-600 font-bold text-sm hover:underline">
                                            Lihat Detail <i class="fas fa-chevron-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-xl">
                            <span class="text-4xl block mb-3">🛍️</span>
                            <p class="text-gray-500">Kamu belum pernah berbelanja.</p>
                            <a href="{{ route('clothes.index') }}" class="mt-4 inline-block text-indigo-600 font-bold hover:underline">Mulai Belanja Sekarang</a>
                        </div>
                    @endif
                </div>

                <!-- Section: Metode Pembayaran -->
                <div id="content-payments" class="profile-content hidden bg-white rounded-2xl shadow-lg p-6 lg:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="mr-3 text-indigo-600">💳</span> Metode Pembayaran
                    </h2>
                    
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    Saat ini kami mendukung pembayaran via <strong>Transfer Bank</strong> (BCA, Mandiri, BNI) dan <strong>Cash On Delivery (COD)</strong>. 
                                    Anda dapat memilih metode pembayaran saat melakukan Checkout.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border rounded-xl p-6 bg-gray-50 bg-opacity-50">
                            <h3 class="font-bold text-gray-800 mb-2">Transfer Bank</h3>
                            <p class="text-gray-600 text-sm mb-4">Transfer manual ke rekening resmi kami.</p>
                            <div class="flex items-center gap-2">
                                <span class="bg-white border rounded px-2 py-1 text-xs font-bold text-blue-800">BCA</span>
                                <span class="bg-white border rounded px-2 py-1 text-xs font-bold text-blue-600">Mandiri</span>
                                <span class="bg-white border rounded px-2 py-1 text-xs font-bold text-orange-600">BNI</span>
                            </div>
                        </div>
                        <div class="border rounded-xl p-6 bg-gray-50 bg-opacity-50">
                            <h3 class="font-bold text-gray-800 mb-2">COD (Bayar Ditempat)</h3>
                            <p class="text-gray-600 text-sm mb-4">Bayar tunai kepada kurir saat barang sampai.</p>
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">Aktif</span>
                        </div>
                    </div>
                </div>

                <!-- Section: Setting Akun -->
                <div id="content-settings" class="profile-content hidden bg-white rounded-2xl shadow-lg p-6 lg:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="mr-3 text-indigo-600">⚙️</span> Pengaturan Akun
                    </h2>

                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 transition" required>
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Alamat Email</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 transition" required>
                                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="border-t pt-6 mt-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Ganti Password</h3>
                            <p class="text-sm text-gray-500 mb-4">Kosongkan jika tidak ingin mengubah password.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2">Password Baru</label>
                                    <input type="password" name="password" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 transition">
                                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 transition">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(tabName) {
        // Hide all contents
        document.querySelectorAll('.profile-content').forEach(el => el.classList.add('hidden'));
        // Show selected content
        document.getElementById('content-' + tabName).classList.remove('hidden');
        
        // Update tab styles
        document.querySelectorAll('.profile-tab').forEach(el => {
            el.classList.remove('bg-indigo-50', 'text-indigo-700', 'border-l-4', 'border-indigo-600');
            el.classList.add('text-gray-700');
        });
        
        const activeTab = document.getElementById('tab-' + tabName);
        activeTab.classList.remove('text-gray-700');
        activeTab.classList.add('bg-indigo-50', 'text-indigo-700', 'border-l-4', 'border-indigo-600');
    }

    // Initialize first tab
    switchTab('orders');
</script>
@endsection

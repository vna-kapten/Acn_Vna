<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Thrift</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-indigo-500 to-purple-600 min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-12 text-center">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl">🛍️</span>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Toko Thrift</h1>
                <p class="text-indigo-100">Belanja Pakaian Berkualitas</p>
            </div>

            <!-- Form -->
            <div class="px-8 py-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-8">Masuk Akun</h2>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-700 text-sm">⚠️ {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded">
                        <p class="text-green-700 text-sm">✓ {{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <input type="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   placeholder="user@gmail.com atau admin@gmail.com"
                                   class="w-full pl-12 pr-4 py-3 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                   required>
                        </div>
                        @error('email')
                            <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input type="password" 
                                   name="password" 
                                   placeholder="Masukkan password"
                                   class="w-full pl-12 pr-4 py-3 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                   required>
                        </div>
                        @error('password')
                            <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-3 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition transform hover:scale-105 active:scale-95 mt-8">
                        Masuk
                    </button>
                </form>

                <!-- Divider -->
                <div class="my-6 flex items-center">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <div class="px-3 text-gray-500 text-sm">atau</div>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>

                <!-- Register Link -->
                <p class="text-center text-gray-600 text-sm">
                    Belum punya akun? 
                    <a href="{{ url('/register') }}" class="text-indigo-600 font-semibold hover:text-indigo-700">Daftar di sini</a>
                </p>
            </div>

            <!-- Footer Info -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                <h3 class="text-sm font-bold text-gray-700 mb-3">🔐 Test Accounts:</h3>
                <div class="space-y-2 text-xs text-gray-600">
                    <p>👤 <strong>User:</strong> agustono@thrift.test / password</p>
                    <p>👨‍💼 <strong>Admin:</strong> admin@thrift.test / password</p>
                </div>
            </div>
        </div>

        <!-- Footer Text -->
        <p class="text-center text-white text-sm mt-6">
            © 2026 Toko Thrift. Semua hak dilindungi.
        </p>
    </div>

</body>
</html>
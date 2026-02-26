<nav class="bg-white border-b shadow px-6 py-4 flex items-center justify-between">
    <!-- Left: Logout -->
    <div>
        <a href="{{ url('/') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Logout</a>
    </div>

    <!-- Right: User Info -->
    <div class="flex items-center gap-3">
        <span class="text-gray-700 font-medium">AGUSTONO</span>
        <img src="https://i.pinimg.com/1200x/9a/7c/dc/9a7cdcec98093a4f89fa20e1dd5871d2.jpg" 
             alt="Profile" 
             class="w-10 h-10 rounded-full border">
    </div>
</nav>
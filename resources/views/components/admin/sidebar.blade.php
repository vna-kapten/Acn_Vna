<aside class="w-64 bg-white border-r p-4">
    <nav class="flex flex-col gap-2">
        @foreach($menus as $menu)
            <a href="{{ $menu['href'] }}" class="flex items-center gap-2 px-3 py-2 rounded text-black hover:bg-gray-100">
                {{ $menu['icon'] }} {{ $menu['label'] }}
            </a>
        @endforeach
    </nav>
</aside>

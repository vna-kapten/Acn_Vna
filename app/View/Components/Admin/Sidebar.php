<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public function render(): View|Closure|string
    {
        $menus = [
            ['label' => 'Home', 'href' => route('admin.home'), 'icon' => '🏠'],
            ['label' => 'Publishers', 'href' => route('admin.publishers.index'), 'icon' => '🏢'],
            ['label' => 'Shelves', 'href' => route('admin.shelves.index'), 'icon' => '📚'],
            ['label' => 'Categories', 'href' => route('admin.categories.index'), 'icon' => '📂'],
            ['label' => 'Books', 'href' => route('admin.books.index'), 'icon' => '📖'],
            ['label' => 'Borrowings', 'href' => route('admin.borrowings.index'), 'icon' => '📚'],
            ['label' => 'Settings', 'href' => route('admin.settings'), 'icon' => '⚙️'],
        ];

        return view('components.admin.sidebar', compact('menus'));
    }
}

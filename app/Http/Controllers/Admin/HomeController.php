<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use App\Models\Shelf;
use App\Models\Category;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil jumlah data dari tiap model
        $publisherCount = Publisher::count();
        $shelfCount     = Shelf::count();
        $categoryCount  = Category::count();
        $bookCount      = Book::count();

        // Data untuk navbar dan sidebar
        $navbarMenus = [
            ['label' => 'Dashboard', 'href' => route('admin.home')],
            ['label' => 'Users', 'href' => route('admin.users.index')],
            ['label' => 'Books', 'href' => route('admin.books.index')],
        ];

        $sidebarItems = [
            ['label' => 'Overview', 'href' => route('admin.home'), 'icon' => '📊', 'key' => 'overview'],
            ['label' => 'Users', 'href' => route('admin.users.index'), 'icon' => '👥', 'key' => 'users'],
            ['label' => 'Books', 'href' => route('admin.books.index'), 'icon' => '📚', 'key' => 'books'],
        ];

        // ✅ Tampilkan view halaman utama (bukan komponen)
        return view('admin.home', compact(
            'navbarMenus',
            'sidebarItems',
            'publisherCount',
            'shelfCount',
            'categoryCount',
            'bookCount'
        ));
    }
}

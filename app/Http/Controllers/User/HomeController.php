<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Clothes;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        // Ambil data pakaian untuk ditampilkan
        $clothes = Clothes::with('category')->limit(12)->get();
        $categories = Category::all();
        $totalClothes = Clothes::count();
        
        return view('user.home', [
            'clothes' => $clothes,
            'categories' => $categories,
            'totalClothes' => $totalClothes
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Clothes;
use Illuminate\Http\Request;

class ClothesController extends Controller
{
    public function index(Request $request)
    {
        $query = Clothes::where('stock', '>', 0);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $clothes = $query->latest()->paginate(12);

        if ($request->ajax()) {
            return view('clothes.partials.list', compact('clothes'))->render();
        }

        return view('clothes.index', compact('clothes'));
    }

    public function show(Clothes $clothes)
    {
        return view('clothes.show', compact('clothes'));
    }

    public function searchSuggestions(Request $request)
    {
        $query = $request->get('query');
        
        if(!$query) {
             return response()->json([]);
        }

        $clothes = Clothes::where('name', 'like', "%{$query}%")
                         ->where('stock', '>', 0)
                         ->limit(5)
                         ->get(['id', 'name', 'price', 'image_url', 'category_id']);
                         
        // Transform image url if needed
        $clothes->transform(function($item) {
            $item->image_url = \Str::startsWith($item->image_url, 'http') 
                ? $item->image_url 
                : ($item->image_url ? asset('storage/'.$item->image_url) : asset('images/placeholder.png'));
            return $item;
        });

        return response()->json($clothes);
    }
}

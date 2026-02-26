<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $cart = Session::get('cart', []);
        $clothesId = (int) $request->clothes_id;
        $quantity = (int) ($request->quantity ?? 1);

        // Get clothes data
        $clothes = \App\Models\Clothes::find($clothesId);
        
        if (!$clothes) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        // Check stock availability before adding to cart
        if ($clothes->stock < $quantity) {
             return redirect()->back()->with('error', 'Stok tidak mencukupi untuk jumlah yang diminta.');
        }

        // Check if item already in cart
        if (isset($cart[$clothesId])) {
            $newQty = $cart[$clothesId]['quantity'] + $quantity;
            if ($clothes->stock < $newQty) {
                 return redirect()->back()->with('error', 'Stok total tidak mencukupi.');
            }
            $cart[$clothesId]['quantity'] = $newQty;
        } else {
            $cart[$clothesId] = [
                'id' => $clothesId,
                'name' => $clothes->name,
                'price' => $clothes->price,
                'quantity' => $quantity,
                'image_url' => $clothes->image_src, // Use accessor
            ];
        }

        Session::put('cart', $cart);
        
        if ($request->has('buy_now')) {
            return redirect()->route('orders.checkout');
        }
        
        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function update(Request $request)
    {
        $cart = Session::get('cart', []);
        $clothesId = (int) $request->clothes_id;
        $quantity = (int) $request->quantity;

        if (isset($cart[$clothesId])) {
            if ($quantity > 0) {
                 // Check stock again
                $clothes = \App\Models\Clothes::find($clothesId);
                if ($clothes && $clothes->stock >= $quantity) {
                    $cart[$clothesId]['quantity'] = $quantity;
                } else {
                     return redirect()->back()->with('error', 'Stok tidak mencukupi.');
                }
            } else {
                unset($cart[$clothesId]);
            }
        }

        Session::put('cart', $cart);
        
        return redirect()->back()->with('success', 'Keranjang diperbarui');
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        Session::put('cart', $cart);
        
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Clothes;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect(route('clothes.index'))->with('error', 'Keranjang masih kosong');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('orders.checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect(route('clothes.index'))->with('error', 'Keranjang masih kosong');
        }

        // Validate
        $request->validate([
            'shipping_address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|in:bca,dana,ovo,cod',
        ]);

        try {
            DB::beginTransaction();

            $totalPrice = 0;
            $orderItems = [];

            // 1. Lock & Validate Stock for ALL items first
            foreach ($cart as $id => $item) {
                // Lock row
                $clothes = Clothes::lockForUpdate()->find($item['id']);
                
                if (!$clothes) {
                    DB::rollBack();
                    return redirect()->back()->with('error', "Produk '{$item['name']}' tidak ditemukan.");
                }

                if ($clothes->stock < $item['quantity']) {
                    DB::rollBack();
                    return redirect()->back()->with('error', "Stok '{$clothes->name}' tidak cukup. Sisa: {$clothes->stock}");
                }

                // Kalkulasi total real-time dari database (lebih aman dari session)
                $totalPrice += $clothes->price * $item['quantity'];
                
                // Simpan instance untuk update nanti
                $orderItems[] = [
                    'clothes' => $clothes, // instance model yang sudah di-lock
                    'quantity' => $item['quantity'],
                    'price' => $clothes->price
                ];
            }

            // 2. Create Order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $totalPrice,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'phone' => $request->phone,
            ]);

            // 3. Create Payment
            Payment::create([
                'order_id' => $order->id,
                'amount' => $totalPrice,
                'method' => $request->payment_method,
                'status' => 'pending',
            ]);

            // 4. Create Details & Deduct Stock using LOCKED instances
            foreach ($orderItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'clothes_id' => $item['clothes']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Update stock on the locked instance
                $item['clothes']->stock -= $item['quantity'];
                $item['clothes']->save();
            }

            DB::commit();
            Session::forget('cart');

            return redirect()->route('orders.show', $order->id)->with('success', 'Pesanan berhasil! Stok telah dikurangi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        // Check ownership
        if ($order->user_id !== auth()->id()) {
            return redirect(route('orders.index'))->with('error', 'Akses ditolak');
        }

        $details = OrderDetail::where('order_id', $order->id)->with('clothes')->get();
        return view('orders.show', compact('order', 'details'));
    }
}

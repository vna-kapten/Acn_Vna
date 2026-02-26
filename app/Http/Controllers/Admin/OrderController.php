<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Hanya tampilkan pesanan yang BELUM selesai (exclude 'delivered')
        $orders = Order::with(['user', 'payment'])
                ->where('status', '!=', 'delivered')
                ->latest()
                ->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('orderDetails.clothes', 'user', 'payment');
        return view('admin.orders.show', compact('order'));
    }

    public function complete($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'delivered'; // Match enum in database
        $order->save();

        return back()->with('success', 'Pesanan telah diselesaikan.');
    }
}

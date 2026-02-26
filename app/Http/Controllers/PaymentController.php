<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($orderId)
    {
        $order = Order::find($orderId);

        if (!$order || $order->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan');
        }

        $payment = Payment::where('order_id', $orderId)->first();

        return view('payments.show', compact('order', 'payment'));
    }

    public function confirm($paymentId)
    {
        $payment = Payment::find($paymentId);

        if (!$payment || $payment->order->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Pembayaran tidak ditemukan');
        }

        try {
            $payment->update(['status' => 'confirmed']);
            $payment->order->update(['status' => 'paid']);

            return redirect()->route('orders.show', $payment->order_id)->with('success', 'Pembayaran berhasil dikonfirmasi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

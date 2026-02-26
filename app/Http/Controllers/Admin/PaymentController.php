<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order.user')->latest()->paginate(10);
        return view('admin.payments.index', compact('payments'));
    }

    public function confirm($id)
    {
        $payment = Payment::findOrFail($id);
        
        $payment->update([
            'status' => 'confirmed'
        ]);
        
        // Update associated order status as well
        if($payment->order) {
             $payment->order->update([
                 'status' => 'processing' // Or 'paid', depending on workflow
             ]);
        }

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}

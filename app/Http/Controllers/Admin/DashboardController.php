<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Clothes;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index () {
        $totalClothes = Clothes::count();
        $ordersToday = Order::whereDate('created_at', now()->today())->count();
        $pendingPayments = Order::where('status', 'pending')->count(); // Assuming 'pending' status indicates pending payment/process
        $totalUsers = User::where('role', '!=', 'admin')->count();

        $recentOrders = Order::with('user')
            ->where('status', '!=', 'delivered')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('totalClothes', 'ordersToday', 'pendingPayments', 'totalUsers', 'recentOrders'));
    }
}

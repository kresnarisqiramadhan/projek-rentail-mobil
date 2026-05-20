<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalVehicles = Vehicle::count();
        $activeOrders   = Order::whereIn('status', ['PENDING', 'PENDING_VERIFICATION', 'PAID', 'ACTIVE'])->count();
        $pendingPayments = Order::where('status', 'PENDING_VERIFICATION')->count();
        $recentOrders   = Order::with('user', 'vehicle')->latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalVehicles',
            'activeOrders',
            'pendingPayments',
            'recentOrders'
        ));
    }
}

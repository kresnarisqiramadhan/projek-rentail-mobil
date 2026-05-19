<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $startDate = $request->input('start_date', now()->subMonth()->toDateString());
        $endDate   = $request->input('end_date', now()->toDateString());

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->with('vehicle')
            ->latest()
            ->get();

        $totalRevenue = $orders->whereIn('status', ['PAID', 'ACTIVE', 'COMPLETED', 'RATED'])->sum('total_price');

        return view('admin.reports.index', compact('orders', 'totalRevenue', 'startDate', 'endDate'));
    }

    public function export(Request $request)
    {
        // Placeholder for CSV/Excel export
        return back()->with('info', 'Fitur ekspor akan segera tersedia.');
    }
}

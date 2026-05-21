<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\BookingService;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(
        private readonly BookingService $bookingService,
        private readonly PaymentService $paymentService
    ) {}

    public function index(Request $request): View
    {
        $orders = Order::with(['user', 'vehicle'])
            ->latest()
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'vehicle', 'transactions', 'rating']);
        return view('admin.orders.show', compact('order'));
    }

    public function verifyPayment(Request $request, Order $order): RedirectResponse
    {
        $action = $request->input('action');

        try {
            if ($action === 'approve') {
                $this->paymentService->adminApprovePayment($order);
                return back()->with('success', 'Pembayaran berhasil diverifikasi.');
            } elseif ($action === 'reject') {
                $reason = $request->input('reason', 'Ditolak oleh admin.');
                $this->paymentService->adminRejectPayment($order, $reason);
                return back()->with('success', 'Pembayaran ditolak.');
            }
        } catch (\RuntimeException $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }

        return back();
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $newStatus = \App\Enums\OrderStatus::tryFrom($request->input('status'));
        if (!$newStatus) {
            return back()->withErrors(['error' => 'Status tidak valid.']);
        }

        try {
            $notes = $request->input('notes', 'Status diperbarui oleh admin.');
            $this->bookingService->transitionStatus($order, $newStatus, $notes);
            return back()->with('success', 'Status pesanan berhasil diperbarui.');
        } catch (\App\Exceptions\InvalidStatusTransitionException $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

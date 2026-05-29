<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\BookingService;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(
        private readonly PaymentService $paymentService,
        private readonly BookingService $bookingService
    ) {}

    public function show(Order $order): View|RedirectResponse
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if (!$order->isPaymentTimerActive()) {
            return redirect()->route('orders.show', $order)
                ->withErrors(['payment' => 'Batas waktu pembayaran telah habis.']);
        }

        return view('payment', compact('order'));
    }

    public function uploadProof(Request $request, Order $order): RedirectResponse
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        try {
            $this->bookingService->uploadPaymentProof(
                $order,
                auth()->user(),
                $request->file('payment_proof')
            );

            return back()->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.');
        } catch (\RuntimeException $e) {
            return back()->withErrors(['payment_proof' => $e->getMessage()]);
        }
    }

    public function requestRefund(Request $request, Order $order): RedirectResponse
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'bank_name'      => 'required|string|max:100',
            'account_name'   => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
        ]);

        try {
            $this->bookingService->requestRefund(
                $order,
                auth()->user(),
                $validated
            );

            return back()->with('success', 'Permintaan refund berhasil diajukan.');
        } catch (\RuntimeException $e) {
            return back()->withErrors(['refund' => $e->getMessage()]);
        }
    }

    public function callback(Request $request): JsonResponse
    {
        $payload = $request->all();

        Log::info('Payment gateway callback received', ['order_id' => $payload['order_id'] ?? null]);

        try {
            $this->paymentService->handleGatewayCallback($payload);
            return response()->json(['status' => 'ok'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Payment callback: order not found', ['payload' => $payload]);
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        } catch (\Exception $e) {
            Log::error('Payment callback processing error', [
                'error'   => $e->getMessage(),
                'payload' => $payload,
            ]);
            return response()->json(['status' => 'error', 'message' => 'Processing error'], 500);
        }
    }

    public function viewProof(Order $order): \Symfony\Component\HttpFoundation\BinaryFileResponse|RedirectResponse
    {
        if (!auth()->user()?->isAdmin()) {
            abort(403);
        }

        if (!$order->payment_proof || !Storage::disk('private')->exists($order->payment_proof)) {
            return back()->with('error', 'File bukti tidak ditemukan.');
        }

        return response()->file(
            Storage::disk('private')->path($order->payment_proof)
        );
    }
}

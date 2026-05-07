<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(
        private readonly PaymentService $paymentService
    ) {}

    // ──────────────────────────────────────────────────────────────────────────
    // FR-D01: Halaman pembayaran order
    // ──────────────────────────────────────────────────────────────────────────
    public function show(Request $request, Order $order): View|\Illuminate\Http\RedirectResponse
    {
        if ($order->user_id !== $request->user()->id) {
            abort(403);
        }

        // VR-04: Timer must be active
        if (!$order->isPaymentTimerActive()) {
            return redirect()->route('bookings.show', $order)
                ->withErrors(['payment' => 'Batas waktu pembayaran telah habis. Silakan buat pesanan baru.']);
        }

        return view('payment.show', compact('order'));
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-D01: Payment Gateway Callback (Webhook)
    // API-01, API-02: Signature already validated by VerifyPaymentSignature middleware
    // ──────────────────────────────────────────────────────────────────────────
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
}

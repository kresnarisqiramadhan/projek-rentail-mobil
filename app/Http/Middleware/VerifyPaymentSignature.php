<?php

namespace App\Http\Middleware;

use App\Services\PaymentService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * VerifyPaymentSignature
 * Validates HMAC-SHA256 from payment gateway webhook (API-01, API-02, SAD §8.1).
 */
class VerifyPaymentSignature
{
    public function __construct(private readonly PaymentService $paymentService) {}

    public function handle(Request $request, Closure $next): Response
    {
        $signature = $request->header('X-Signature');

        if (!$signature) {
            Log::warning('Payment callback without signature', ['ip' => $request->ip()]);
            return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 401);
        }

        $rawPayload = $request->getContent();

        if (!$this->paymentService->validateGatewaySignature($rawPayload, $signature)) {
            Log::warning('Payment callback with invalid HMAC signature', [
                'ip'        => $request->ip(),
                'signature' => $signature,
            ]);
            return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 401);
        }

        return $next($request);
    }
}

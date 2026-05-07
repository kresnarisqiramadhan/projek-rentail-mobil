<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Exceptions\InvalidStatusTransitionException;
use App\Exceptions\VehicleNotAvailableException;
use App\Http\Requests\Booking\CreateBookingRequest;
use App\Http\Requests\Booking\ModifyBookingDatesRequest;
use App\Http\Requests\Booking\SubmitRatingRequest;
use App\Http\Requests\Payment\RequestRefundRequest;
use App\Http\Requests\Payment\UploadPaymentProofRequest;
use App\Models\Order;
use App\Services\BookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function __construct(
        private readonly BookingService $bookingService
    ) {}

    // ──────────────────────────────────────────────────────────────────────────
    // FR-C04: Customer active orders
    // ──────────────────────────────────────────────────────────────────────────
    public function index(Request $request): View
    {
        $orders = Order::with(['vehicle', 'vehicle.photos'])
            ->forCustomer($request->user()->id)
            ->active()
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('orders'));
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-C05: Customer order history
    // ──────────────────────────────────────────────────────────────────────────
    public function history(Request $request): View
    {
        $orders = Order::with(['vehicle', 'rating'])
            ->forCustomer($request->user()->id)
            ->history()
            ->latest()
            ->paginate(10);

        return view('bookings.history', compact('orders'));
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-C04: Order detail
    // ──────────────────────────────────────────────────────────────────────────
    public function show(Request $request, Order $order): View
    {
        $this->authorizeOrderOwnership($order, $request->user()->id);

        $order->load(['vehicle', 'vehicle.photos', 'transactions', 'rating']);

        return view('bookings.show', compact('order'));
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-C01: Create booking
    // ──────────────────────────────────────────────────────────────────────────
    public function store(CreateBookingRequest $request): RedirectResponse
    {
        try {
            $order = $this->bookingService->createBooking(
                $request->user(),
                $request->validated()
            );

            return redirect()
                ->route('bookings.show', $order)
                ->with('success', 'Pesanan berhasil dibuat! Selesaikan pembayaran dalam 15 menit.');

        } catch (VehicleNotAvailableException $e) {
            return back()->withErrors(['vehicle_id' => $e->getMessage()]);
        } catch (\InvalidArgumentException $e) {
            return back()->withErrors(['start_date' => $e->getMessage()]);
        }
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-C02: Customer cancel booking
    // ──────────────────────────────────────────────────────────────────────────
    public function cancel(Request $request, Order $order): RedirectResponse
    {
        $this->authorizeOrderOwnership($order, $request->user()->id);

        try {
            $this->bookingService->cancelByCustomer($order, $request->user());
            return back()->with('success', 'Pesanan berhasil dibatalkan.');
        } catch (\RuntimeException $e) {
            return back()->withErrors(['cancel' => $e->getMessage()]);
        }
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-C03: Modify booking dates
    // ──────────────────────────────────────────────────────────────────────────
    public function modifyDates(ModifyBookingDatesRequest $request, Order $order): RedirectResponse
    {
        $this->authorizeOrderOwnership($order, $request->user()->id);

        try {
            $this->bookingService->modifyDates(
                $order,
                $request->user(),
                $request->validated('start_date'),
                $request->validated('end_date')
            );

            return back()->with('success', 'Tanggal pesanan berhasil diubah.');
        } catch (VehicleNotAvailableException $e) {
            return back()->withErrors(['start_date' => $e->getMessage()]);
        } catch (\RuntimeException|\InvalidArgumentException $e) {
            return back()->withErrors(['start_date' => $e->getMessage()]);
        }
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-D02: Upload payment proof (manual)
    // ──────────────────────────────────────────────────────────────────────────
    public function uploadPaymentProof(UploadPaymentProofRequest $request, Order $order): RedirectResponse
    {
        $this->authorizeOrderOwnership($order, $request->user()->id);

        try {
            $this->bookingService->uploadPaymentProof(
                $order,
                $request->user(),
                $request->file('payment_proof')
            );

            return back()->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi Admin.');
        } catch (\RuntimeException $e) {
            return back()->withErrors(['payment_proof' => $e->getMessage()]);
        }
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-D06: Request refund
    // ──────────────────────────────────────────────────────────────────────────
    public function requestRefund(RequestRefundRequest $request, Order $order): RedirectResponse
    {
        $this->authorizeOrderOwnership($order, $request->user()->id);

        try {
            $this->bookingService->requestRefund(
                $order,
                $request->user(),
                $request->validated()
            );

            return back()->with('success', 'Permintaan refund berhasil diajukan. Admin akan segera memproses.');
        } catch (\RuntimeException $e) {
            return back()->withErrors(['refund' => $e->getMessage()]);
        }
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-C08: Submit rating
    // ──────────────────────────────────────────────────────────────────────────
    public function submitRating(SubmitRatingRequest $request, Order $order): RedirectResponse
    {
        $this->authorizeOrderOwnership($order, $request->user()->id);

        try {
            $this->bookingService->submitRating(
                $order,
                $request->user(),
                $request->validated('score'),
                $request->validated('comment')
            );

            return back()->with('success', 'Terima kasih! Penilaian Anda berhasil disimpan.');
        } catch (\RuntimeException $e) {
            return back()->withErrors(['rating' => $e->getMessage()]);
        }
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Private Helpers
    // ──────────────────────────────────────────────────────────────────────────

    private function authorizeOrderOwnership(Order $order, int $userId): void
    {
        if ($order->user_id !== $userId) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
    }
}

<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\TransactionActor;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Exceptions\InvalidStatusTransitionException;
use App\Exceptions\VehicleNotAvailableException;
use App\Jobs\CancelExpiredOrderJob;
use App\Models\Order;
use App\Models\Rating;
use App\Models\User;
use App\Models\Vehicle;
use App\Notifications\OrderCancelledNotification;
use App\Notifications\OrderCreatedNotification;
use App\Notifications\OrderStatusChangedNotification;
use App\Notifications\RatingSubmittedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BookingService
{
    public function __construct(
        private readonly OrderStateMachine $stateMachine
    ) {}

    // ──────────────────────────────────────────────────────────────────────────
    // FR-C01: Create Booking
    // VR-01, VR-02, VR-03, VR-04 enforced here
    // Uses DB transaction + row-level locking (NFR-CON-02, ER-02)
    // ──────────────────────────────────────────────────────────────────────────
    public function createBooking(User $customer, array $data): Order
    {
        return DB::transaction(function () use ($customer, $data) {
            // Lock the vehicle row to prevent race conditions (VR-02, NFR-CON-02)
            $vehicle = Vehicle::lockForUpdate()->findOrFail($data['vehicle_id']);

            // VR-01: Start date must be >= today
            $startDate = Carbon::parse($data['start_date'])->startOfDay();
            $endDate   = Carbon::parse($data['end_date'])->startOfDay();

            if ($startDate->lt(today())) {
                throw new \InvalidArgumentException('Tanggal mulai harus >= hari ini.');
            }

            // VR-03: End date must be > start date (min 1 day)
            if (!$endDate->gt($startDate)) {
                throw new \InvalidArgumentException('Durasi sewa minimal 1 hari. Tanggal kembali harus setelah tanggal mulai.');
            }

            // VR-02: Vehicle must not have overlapping active booking (ER-02)
            if ($vehicle->hasActiveBookingInRange($startDate, $endDate)) {
                throw new VehicleNotAvailableException();
            }

            // Calculate total price
            $days       = $startDate->diffInDays($endDate);
            $totalPrice = $vehicle->price_per_day * $days;

            $timeoutAt = now()->addMinutes(15); // VR-04

            $order = Order::create([
                'order_code'         => Order::generateOrderCode(),
                'user_id'            => $customer->id,
                'vehicle_id'         => $vehicle->id,
                'start_date'         => $startDate->toDateString(),
                'end_date'           => $endDate->toDateString(),
                'total_price'        => $totalPrice,
                'status'             => OrderStatus::PENDING,
                'payment_method'     => $data['payment_method'],
                'payment_timeout_at' => $timeoutAt,
            ]);

            // Dispatch auto-cancel job (FR-C06, BRL-07) — delayed 15 minutes
            CancelExpiredOrderJob::dispatch($order->id)
                ->delay($timeoutAt);

            // Notify customer (FR-E01)
            $customer->notify(new OrderCreatedNotification($order));

            Log::info('Booking created', ['order_id' => $order->id, 'customer_id' => $customer->id]);

            return $order;
        });
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-C02: Cancel Booking by Customer
    // ──────────────────────────────────────────────────────────────────────────
    public function cancelByCustomer(Order $order, User $customer): void
    {
        // Ownership check
        if ($order->user_id !== $customer->id) {
            throw new \AuthorizationException('Anda tidak memiliki akses ke pesanan ini.');
        }

        if (!$order->canBeCancelledByCustomer()) {
            throw new \RuntimeException('Pembatalan tidak dapat dilakukan pada status atau waktu ini.');
        }

        DB::transaction(function () use ($order, $customer) {
            $this->stateMachine->assertCanTransition($order->status, OrderStatus::CANCELLED);

            $order->update(['status' => OrderStatus::CANCELLED]);

            $customer->notify(new OrderCancelledNotification($order));

            Log::info('Order cancelled by customer', ['order_id' => $order->id, 'customer_id' => $customer->id]);
        });
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-C03: Modify Booking Date
    // VR-01, VR-02, VR-03 enforced
    // ──────────────────────────────────────────────────────────────────────────
    public function modifyDates(Order $order, User $customer, string $newStartDate, string $newEndDate): Order
    {
        if ($order->user_id !== $customer->id) {
            throw new \AuthorizationException('Anda tidak memiliki akses ke pesanan ini.');
        }

        if (!$order->canModifyDates()) {
            throw new \RuntimeException('Tanggal tidak dapat diubah pada status atau waktu ini.');
        }

        return DB::transaction(function () use ($order, $newStartDate, $newEndDate) {
            $startDate = Carbon::parse($newStartDate)->startOfDay();
            $endDate   = Carbon::parse($newEndDate)->startOfDay();

            if ($startDate->lt(today())) {
                throw new \InvalidArgumentException('Tanggal mulai harus >= hari ini.');
            }

            if (!$endDate->gt($startDate)) {
                throw new \InvalidArgumentException('Durasi sewa minimal 1 hari.');
            }

            // Lock vehicle, check availability excluding current order (VR-02)
            $vehicle = Vehicle::lockForUpdate()->findOrFail($order->vehicle_id);

            if ($vehicle->hasActiveBookingInRange($startDate, $endDate, $order->id)) {
                throw new VehicleNotAvailableException();
            }

            $days       = $startDate->diffInDays($endDate);
            $totalPrice = $vehicle->price_per_day * $days;

            $order->update([
                'start_date'  => $startDate->toDateString(),
                'end_date'    => $endDate->toDateString(),
                'total_price' => $totalPrice,
            ]);

            $order->user->notify(new OrderStatusChangedNotification($order, 'Tanggal pesanan Anda telah diperbarui.'));

            return $order->fresh();
        });
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-C07: Admin Update Order Status (via state machine)
    // ──────────────────────────────────────────────────────────────────────────
    public function transitionStatus(Order $order, OrderStatus $newStatus, string $notes = ''): void
    {
        DB::transaction(function () use ($order, $newStatus, $notes) {
            $this->stateMachine->assertCanTransition($order->status, $newStatus);

            $order->update(['status' => $newStatus]);

            $order->user->notify(new OrderStatusChangedNotification($order, $notes));

            Log::info('Order status transitioned', [
                'order_id'   => $order->id,
                'from'       => $order->getOriginal('status'),
                'to'         => $newStatus->value,
            ]);
        });
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-C08: Customer Submit Rating
    // BRL-14: Only COMPLETED orders can be rated
    // ──────────────────────────────────────────────────────────────────────────
    public function submitRating(Order $order, User $customer, int $score, ?string $comment = null): Rating
    {
        if ($order->user_id !== $customer->id) {
            throw new \AuthorizationException('Anda tidak memiliki akses ke pesanan ini.');
        }

        if ($order->status !== OrderStatus::COMPLETED) {
            throw new \RuntimeException('Rating hanya dapat diberikan untuk pesanan yang telah selesai.');
        }

        if ($order->rating()->exists()) {
            throw new \RuntimeException('Rating untuk pesanan ini sudah pernah diberikan.');
        }

        return DB::transaction(function () use ($order, $customer, $score, $comment) {
            $rating = Rating::create([
                'order_id'   => $order->id,
                'user_id'    => $customer->id,
                'vehicle_id' => $order->vehicle_id,
                'score'      => $score,
                'comment'    => $comment,
            ]);

            // Update order to RATED
            $this->stateMachine->assertCanTransition($order->status, OrderStatus::RATED);
            $order->update(['status' => OrderStatus::RATED]);

            // Recalculate vehicle avg_rating
            $order->vehicle->recalculateAvgRating();

            return $rating;
        });
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-D06: Request Refund (VR-05)
    // ──────────────────────────────────────────────────────────────────────────
    public function requestRefund(Order $order, User $customer, array $bankData): void
    {
        if ($order->user_id !== $customer->id) {
            throw new \AuthorizationException('Anda tidak memiliki akses ke pesanan ini.');
        }

        if (!$order->canRequestRefund()) {
            throw new \RuntimeException('Refund tidak dapat diajukan. Pastikan pesanan berstatus Dibatalkan, pernah dibayar, dan tanggal pemakaian belum dimulai.');
        }

        DB::transaction(function () use ($order, $bankData) {
            $this->stateMachine->assertCanTransition($order->status, OrderStatus::REFUND_REQUESTED);

            $order->update([
                'status'                => OrderStatus::REFUND_REQUESTED,
                'refund_bank_name'      => $bankData['bank_name'],
                'refund_account_name'   => $bankData['account_name'],
                'refund_account_number' => $bankData['account_number'],
            ]);
        });
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-D02: Upload Payment Proof (Manual)
    // VR-06: JPG/JPEG/PNG/PDF, max 5MB enforced at Request level
    // ──────────────────────────────────────────────────────────────────────────
    public function uploadPaymentProof(Order $order, User $customer, \Illuminate\Http\UploadedFile $file): void
    {
        if ($order->user_id !== $customer->id) {
            throw new \AuthorizationException('Anda tidak memiliki akses ke pesanan ini.');
        }

        if ($order->status !== OrderStatus::PENDING) {
            throw new \RuntimeException('Bukti pembayaran hanya dapat diunggah untuk pesanan yang menunggu pembayaran.');
        }

        DB::transaction(function () use ($order, $file) {
            // Store with UUID filename (NFR-FILE-01, security: no original filename)
            $path = $file->storeAs(
                'payment_proofs',
                \Str::uuid() . '.' . $file->getClientOriginalExtension(),
                'private'
            );

            $this->stateMachine->assertCanTransition($order->status, OrderStatus::PENDING_VERIFICATION);

            $order->update([
                'status'        => OrderStatus::PENDING_VERIFICATION,
                'payment_proof' => $path,
            ]);

            // Record transaction (FR-D05)
            $order->transactions()->create([
                'amount'  => $order->total_price,
                'type'    => TransactionType::PAYMENT->value,
                'status'  => TransactionStatus::PENDING->value,
                'method'  => $order->payment_method->value,
                'actor'   => TransactionActor::CUSTOMER->value,
                'notes'   => 'Bukti pembayaran manual diunggah oleh customer.',
            ]);

            // Notify admin
            $admins = \App\Models\User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new \App\Notifications\ManualPaymentUploadedNotification($order));
            }
        });
    }
}

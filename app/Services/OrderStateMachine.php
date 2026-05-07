<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Exceptions\InvalidStatusTransitionException;

/**
 * OrderStateMachine
 *
 * Validates all order status transitions per BRL-12 & BRL-13 (SRS §3.9).
 * This class is the single source of truth for what transitions are legal.
 * Every status change MUST go through this machine.
 */
class OrderStateMachine
{
    /**
     * Valid transition map: FROM_STATUS => [ALLOWED_TO_STATUS, ...]
     * Derived directly from SRS §3.9 Booking Status Lifecycle table.
     */
    private const TRANSITIONS = [
        OrderStatus::PENDING->value => [
            OrderStatus::PENDING_VERIFICATION->value, // Customer uploads manual proof
            OrderStatus::PAID->value,                 // Payment gateway callback success
            OrderStatus::CANCELLED->value,            // Timer expired OR Customer cancels
        ],
        OrderStatus::PENDING_VERIFICATION->value => [
            OrderStatus::PAID->value,                 // Admin approves
            OrderStatus::PENDING->value,              // Admin rejects (customer can re-upload)
            OrderStatus::CANCELLED->value,            // Customer cancels
        ],
        OrderStatus::PAID->value => [
            OrderStatus::ACTIVE->value,               // Admin marks vehicle delivered
            OrderStatus::CANCELLED->value,            // Customer cancels before start
            OrderStatus::REFUND_REQUESTED->value,     // Customer requests refund after cancellation
        ],
        OrderStatus::ACTIVE->value => [
            OrderStatus::COMPLETED->value,            // Admin marks vehicle returned
        ],
        OrderStatus::COMPLETED->value => [
            OrderStatus::RATED->value,                // Customer submits rating
        ],
        OrderStatus::CANCELLED->value => [
            OrderStatus::REFUND_REQUESTED->value,     // Customer requests refund (if was PAID)
        ],
        OrderStatus::REFUND_REQUESTED->value => [
            OrderStatus::REFUNDED->value,             // Admin processes refund
        ],
        // Terminal states — no outgoing transitions
        OrderStatus::RATED->value    => [],
        OrderStatus::REFUNDED->value => [],
    ];

    /**
     * Check whether a status transition is valid.
     */
    public function canTransition(OrderStatus $from, OrderStatus $to): bool
    {
        $allowed = self::TRANSITIONS[$from->value] ?? [];
        return in_array($to->value, $allowed, true);
    }

    /**
     * Assert transition is valid, throw if not.
     *
     * @throws InvalidStatusTransitionException
     */
    public function assertCanTransition(OrderStatus $from, OrderStatus $to): void
    {
        if (!$this->canTransition($from, $to)) {
            throw new InvalidStatusTransitionException(
                "Invalid status transition from [{$from->value}] to [{$to->value}]."
            );
        }
    }

    /**
     * Get all allowed next statuses from a given status.
     *
     * @return OrderStatus[]
     */
    public function allowedTransitions(OrderStatus $from): array
    {
        $values = self::TRANSITIONS[$from->value] ?? [];
        return array_map(fn($v) => OrderStatus::from($v), $values);
    }
}

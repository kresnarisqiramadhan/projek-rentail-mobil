<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Exceptions\InvalidStatusTransitionException;

class OrderStateMachine
{
    private const TRANSITIONS = [
        OrderStatus::PENDING->value => [
            OrderStatus::PENDING_VERIFICATION->value,
            OrderStatus::PAID->value,
            OrderStatus::CANCELLED->value,
        ],
        OrderStatus::PENDING_VERIFICATION->value => [
            OrderStatus::PAID->value,
            OrderStatus::PENDING->value,
            OrderStatus::CANCELLED->value,
        ],
        OrderStatus::PAID->value => [
            OrderStatus::ACTIVE->value,
            OrderStatus::CANCELLED->value,
            OrderStatus::REFUND_REQUESTED->value,
        ],
        OrderStatus::ACTIVE->value => [
            OrderStatus::COMPLETED->value,
        ],
        OrderStatus::COMPLETED->value => [
            OrderStatus::RATED->value,
        ],
        OrderStatus::CANCELLED->value => [
            OrderStatus::REFUND_REQUESTED->value,
        ],
        OrderStatus::REFUND_REQUESTED->value => [
            OrderStatus::REFUNDED->value,
        ],
        OrderStatus::RATED->value    => [],
        OrderStatus::REFUNDED->value => [],
    ];

    public function canTransition(OrderStatus $from, OrderStatus $to): bool
    {
        $allowed = self::TRANSITIONS[$from->value] ?? [];
        return in_array($to->value, $allowed, true);
    }

    public function assertCanTransition(OrderStatus $from, OrderStatus $to): void
    {
        if (!$this->canTransition($from, $to)) {
            throw new InvalidStatusTransitionException(
                "Invalid status transition from [{$from->value}] to [{$to->value}]."
            );
        }
    }

    public function allowedTransitions(OrderStatus $from): array
    {
        $values = self::TRANSITIONS[$from->value] ?? [];
        return array_map(fn($v) => OrderStatus::from($v), $values);
    }
}

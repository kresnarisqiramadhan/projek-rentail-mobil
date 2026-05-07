<?php

namespace App\Enums;

enum TransactionType: string
{
    case PAYMENT        = 'PAYMENT';
    case REFUND         = 'REFUND';
    case PARTIAL_REFUND = 'PARTIAL_REFUND';
}
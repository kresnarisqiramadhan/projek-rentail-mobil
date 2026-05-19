<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case BANK = 'bank';
    case QRIS  = 'qris';
}

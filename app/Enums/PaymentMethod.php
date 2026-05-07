<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case GATEWAY = 'gateway';
    case MANUAL  = 'manual';
}
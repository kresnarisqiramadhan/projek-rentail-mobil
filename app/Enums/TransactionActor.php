<?php

namespace App\Enums;

enum TransactionActor: string
{
    case CUSTOMER = 'CUSTOMER';
    case ADMIN    = 'ADMIN';
    case SYSTEM   = 'SYSTEM';
    case GATEWAY  = 'GATEWAY';
}

<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case SUCCESS = 'SUCCESS';
    case FAILED  = 'FAILED';
    case PENDING = 'PENDING';
}
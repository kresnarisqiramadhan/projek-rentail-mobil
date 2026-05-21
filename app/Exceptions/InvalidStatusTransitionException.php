<?php

namespace App\Exceptions;

class InvalidStatusTransitionException extends \RuntimeException
{
    public function __construct(string $message = 'Invalid order status transition.', int $code = 422)
    {
        parent::__construct($message, $code);
    }
}

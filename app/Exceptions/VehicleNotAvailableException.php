<?php

namespace App\Exceptions;

class VehicleNotAvailableException extends \RuntimeException
{
    public function __construct(string $message = 'Kendaraan tidak tersedia pada tanggal yang dipilih.', int $code = 422)
    {
        parent::__construct($message, $code);
    }
}

<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING               = 'PENDING';
    case PENDING_VERIFICATION  = 'PENDING_VERIFICATION';
    case PAID                  = 'PAID';
    case ACTIVE                = 'ACTIVE';
    case COMPLETED             = 'COMPLETED';
    case RATED                 = 'RATED';
    case CANCELLED             = 'CANCELLED';
    case REFUND_REQUESTED      = 'REFUND_REQUESTED';
    case REFUNDED              = 'REFUNDED';

    public function label(): string
    {
        return match($this) {
            self::PENDING              => 'Menunggu Pembayaran',
            self::PENDING_VERIFICATION => 'Menunggu Verifikasi',
            self::PAID                 => 'Lunas',
            self::ACTIVE               => 'Sedang Berjalan',
            self::COMPLETED            => 'Selesai',
            self::RATED                => 'Sudah Dinilai',
            self::CANCELLED            => 'Dibatalkan',
            self::REFUND_REQUESTED     => 'Pengembalian Dana Diajukan',
            self::REFUNDED             => 'Refund Selesai',
        };
    }

    /**
     * Terminal states — no further transitions allowed
     */
    public function isTerminal(): bool
    {
        return in_array($this, [self::RATED, self::REFUNDED]);
    }

    /**
     * States considered "active" booking (vehicle locked)
     */
    public function isActiveBooking(): bool
    {
        return in_array($this, [
            self::PENDING,
            self::PENDING_VERIFICATION,
            self::PAID,
            self::ACTIVE,
        ]);
    }

    /**
     * States that block vehicle deletion (VR-08)
     */
    public static function blockingDeletion(): array
    {
        return [
            self::PENDING,
            self::PENDING_VERIFICATION,
            self::PAID,
            self::ACTIVE,
        ];
    }
}

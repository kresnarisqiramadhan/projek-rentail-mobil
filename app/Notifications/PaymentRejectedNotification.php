<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentRejectedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly Order $order,
        public readonly string $reason
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pembayaran Ditolak #' . $this->order->order_code)
            ->line('Bukti pembayaran Anda ditolak.')
            ->line('Alasan: ' . $this->reason)
            ->action('Unggah Ulang', route('payment', $this->order->id));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'order_id'   => $this->order->id,
            'order_code' => $this->order->order_code,
            'message'    => 'Pembayaran ditolak.',
            'reason'     => $this->reason,
            'action_url' => route('payment', $this->order->id),
        ];
    }
}

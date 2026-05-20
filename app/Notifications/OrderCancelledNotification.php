<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCancelledNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly Order $order,
        public readonly ?string $reason = null
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pesanan Dibatalkan #' . $this->order->order_code)
            ->line('Pesanan Anda telah dibatalkan.')
            ->when($this->reason, fn($msg) => $msg->line('Alasan: ' . $this->reason))
            ->action('Lihat Pesanan', route('orders.show', $this->order->id));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'order_id'   => $this->order->id,
            'order_code' => $this->order->order_code,
            'message'    => 'Pesanan Anda telah dibatalkan.',
            'reason'     => $this->reason,
            'action_url' => route('orders.show', $this->order->id),
        ];
    }
}

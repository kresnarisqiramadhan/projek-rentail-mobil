<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly Order $order,
        public readonly string $notes
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Status Pesanan Diperbarui #' . $this->order->order_code)
            ->line('Status pesanan Anda telah berubah menjadi: ' . $this->order->status->label())
            ->line('Catatan: ' . $this->notes)
            ->action('Lihat Pesanan', route('orders.show', $this->order->id));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'order_id'   => $this->order->id,
            'order_code' => $this->order->order_code,
            'message'    => 'Status pesanan diperbarui: ' . $this->order->status->label(),
            'notes'      => $this->notes,
            'action_url' => route('orders.show', $this->order->id),
        ];
    }
}

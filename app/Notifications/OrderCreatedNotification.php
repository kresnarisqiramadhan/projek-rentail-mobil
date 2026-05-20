<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public readonly Order $order) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pesanan Baru #' . $this->order->order_code)
            ->line('Pesanan Anda telah berhasil dibuat.')
            ->line('Kode Pesanan: ' . $this->order->order_code)
            ->line('Total: Rp ' . number_format($this->order->total_price, 0, ',', '.'))
            ->action('Lihat Pesanan', route('orders.show', $this->order->id))
            ->line('Selesaikan pembayaran dalam 15 menit.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'order_id'   => $this->order->id,
            'order_code' => $this->order->order_code,
            'message'    => 'Pesanan Anda berhasil dibuat.',
            'action_url' => route('orders.show', $this->order->id),
        ];
    }
}

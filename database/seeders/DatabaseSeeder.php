<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Rating;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = Vehicle::factory()->count(10)->create();

        $admin = User::factory()->admin()->create();

        $customer = User::factory()->customer()->create();

        User::factory()->inactive()->create();

        $this->createOrdersForCustomer($customer, $vehicles);

        $extraCustomers = User::factory()->count(5)->create();
        foreach ($extraCustomers as $extraCustomer) {
            $this->createOrdersForCustomer($extraCustomer, $vehicles->random(3));
        }
    }

    private function createOrdersForCustomer(User $customer, $vehicles): void
    {
        $vehicle = $vehicles->random();

        $pending = Order::factory()
            ->for($customer)
            ->for($vehicle, 'vehicle')
            ->pending()
            ->create([
                'total_price' => $vehicle->price_per_day * 2,
            ]);

        $pendingVerif = Order::factory()
            ->for($customer)
            ->for($vehicles->random(), 'vehicle')
            ->pendingVerification()
            ->create();

        Transaction::factory()->manualPaymentPending()->for($pendingVerif, 'order')->create([
            'amount' => $pendingVerif->total_price,
        ]);

        $paid = Order::factory()
            ->for($customer)
            ->for($vehicles->random(), 'vehicle')
            ->paid()
            ->create();

        Transaction::factory()->paymentSuccess()->for($paid, 'order')->create([
            'amount' => $paid->total_price,
        ]);

        $active = Order::factory()
            ->for($customer)
            ->for($vehicles->random(), 'vehicle')
            ->active()
            ->create();

        Transaction::factory()->paymentSuccess()->for($active, 'order')->create([
            'amount' => $active->total_price,
        ]);

        $completed = Order::factory()
            ->for($customer)
            ->for($vehicles->random(), 'vehicle')
            ->completed()
            ->create();

        Transaction::factory()->paymentSuccess()->for($completed, 'order')->create([
            'amount' => $completed->total_price,
        ]);

        Rating::factory()->forOrder($completed)->withScore(4)->create();

        $rated = Order::factory()
            ->for($customer)
            ->for($vehicles->random(), 'vehicle')
            ->rated()
            ->create();

        Transaction::factory()->paymentSuccess()->for($rated, 'order')->create([
            'amount' => $rated->total_price,
        ]);

        Rating::factory()->forOrder($rated)->withScore(5)->create();

        $cancelled = Order::factory()
            ->for($customer)
            ->for($vehicles->random(), 'vehicle')
            ->cancelled()
            ->create();

        $refundReq = Order::factory()
            ->for($customer)
            ->for($vehicles->random(), 'vehicle')
            ->refundRequested()
            ->create();

        Transaction::factory()->paymentSuccess()->for($refundReq, 'order')->create([
            'amount' => $refundReq->total_price,
        ]);

        $refunded = Order::factory()
            ->for($customer)
            ->for($vehicles->random(), 'vehicle')
            ->refunded()
            ->create();

        Transaction::factory()->paymentSuccess()->for($refunded, 'order')->create([
            'amount' => $refunded->total_price,
        ]);

        Transaction::factory()->refund()->for($refunded, 'order')->create([
            'amount' => $refunded->total_price,
        ]);

        $now = now();

        DatabaseNotification::insert([
            [
                'id'              => (string) Str::orderedUuid(),
                'type'            => 'App\Notifications\OrderCreatedNotification',
                'notifiable_type' => get_class($customer),
                'notifiable_id'   => $customer->id,
                'data'            => json_encode([
                    'order_id'   => $pending->id,
                    'order_code' => $pending->order_code,
                    'message'    => 'Pesanan Anda berhasil dibuat.',
                    'action_url' => route('orders.show', $pending->id),
                ]),
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'id'              => (string) Str::orderedUuid(),
                'type'            => 'App\Notifications\PaymentConfirmedNotification',
                'notifiable_type' => get_class($customer),
                'notifiable_id'   => $customer->id,
                'data'            => json_encode([
                    'order_id'   => $paid->id,
                    'order_code' => $paid->order_code,
                    'message'    => 'Pembayaran dikonfirmasi.',
                    'action_url' => route('orders.show', $paid->id),
                ]),
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'id'              => (string) Str::orderedUuid(),
                'type'            => 'App\Notifications\OrderStatusChangedNotification',
                'notifiable_type' => get_class($customer),
                'notifiable_id'   => $customer->id,
                'data'            => json_encode([
                    'order_id'   => $active->id,
                    'order_code' => $active->order_code,
                    'message'    => 'Status pesanan diperbarui: Sedang Berjalan',
                    'notes'      => 'Mobil telah diambil pelanggan.',
                    'action_url' => route('orders.show', $active->id),
                ]),
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        ]);
    }
}

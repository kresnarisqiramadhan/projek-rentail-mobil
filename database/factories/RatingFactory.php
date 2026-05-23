<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Rating;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition(): array
    {
        $order = Order::factory()->completed()->create();

        $comments = [
            'Mobilnya bersih dan nyaman, cocok untuk perjalanan keluarga.',
            'AC dingin, mesin halus. Sangat memuaskan!',
            'Pengambilan mudah, kondisi mobil prima.',
            'Kurang puas, ada bunyi aneh di roda depan.',
            'Sangat direkomendasikan! Harga terjangkau, pelayanan ramah.',
            'Mobil agak bau rokok, semoga lebih diperhatikan kebersihannya.',
            'Berkendara jadi menyenangkan, suspensi empuk.',
            'Kursi anak disediakan, sangat membantu.',
            'Tepat waktu, mobil sesuai foto.',
            'Ada baret di pintu, tapi tidak mengganggu.',
            'Perjalanan dinas lancar berkat mobil ini.',
            'Bensin penuh saat diantar, terima kasih!',
            'Tenaga mesin kurang untuk tanjakan, tapi overall oke.',
            'Warna mobil lebih bagus aslinya.',
            'Tidak ada masalah selama sewa 3 hari.',
        ];

        return [
            'order_id'   => $order->id,
            'user_id'    => $order->user_id,
            'vehicle_id' => $order->vehicle_id,
            'score'      => fake()->numberBetween(1, 5),
            'comment'    => Arr::random($comments),
        ];
    }

    public function forOrder(Order $order): static
    {
        return $this->state([
            'order_id'   => $order->id,
            'user_id'    => $order->user_id,
            'vehicle_id' => $order->vehicle_id,
        ]);
    }

    public function withScore(int $score): static
    {
        return $this->state(['score' => $score]);
    }

    public function withComment(string $comment): static
    {
        return $this->state(['comment' => $comment]);
    }
}

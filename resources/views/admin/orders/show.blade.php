<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Detail Pesanan</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-1">{{ $order->order_code }}</p>
        </div>
        <div class="flex gap-3">
            @if($order->status === \App\Enums\OrderStatus::PENDING_VERIFICATION)
                <form action="{{ route('admin.orders.verify-payment', $order) }}" method="POST" class="flex gap-3">
                    @csrf @method('PATCH')
                    <button type="submit" name="action" value="approve" class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-sm font-medium hover:bg-emerald-700 transition-colors">Verifikasi Pembayaran</button>
                    <button type="submit" name="action" value="reject" class="px-4 py-2 bg-red-600 text-white rounded-xl text-sm font-medium hover:bg-red-700 transition-colors">Tolak</button>
                </form>
            @endif
            @if($order->status === \App\Enums\OrderStatus::REFUND_REQUESTED)
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="REFUNDED">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 transition-colors">Proses Refund</button>
                </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="space-y-8">
            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
                <h3 class="font-semibold text-zinc-900 dark:text-zinc-50 mb-4">Informasi Pesanan</h3>
                <dl class="grid grid-cols-2 gap-4">
                    <div>
                        <dt class="text-xs text-zinc-500">Pelanggan</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">{{ $order->user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Email</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">{{ $order->user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Kendaraan</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">{{ $order->vehicle->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Plat</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">{{ $order->vehicle->plate_number }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Tanggal Sewa</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">{{ $order->start_date->format('d M Y') }} → {{ $order->end_date->format('d M Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Durasi</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">{{ $order->duration_days }} hari</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Metode Bayar</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50 uppercase">{{ $order->payment_method->value }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Total</dt>
                        <dd class="font-semibold text-zinc-900 dark:text-zinc-50">Rp{{ number_format($order->total_price, 0, ',', '.') }}</dd>
                    </div>
                    <div class="col-span-2">
                        <dt class="text-xs text-zinc-500">Status</dt>
                        <dd>
                            <span class="px-2 py-1 rounded-full text-xs font-medium 
                                @if($order->status->value === 'PENDING' || $order->status->value === 'PENDING_VERIFICATION') bg-yellow-50 text-yellow-700
                                @elseif(in_array($order->status->value, ['PAID', 'ACTIVE'])) bg-blue-50 text-blue-700
                                @elseif(in_array($order->status->value, ['COMPLETED', 'RATED'])) bg-emerald-50 text-emerald-700
                                @else bg-red-50 text-red-700
                                @endif">
                                {{ $order->status->label() }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>
            @if($order->payment_proof)
            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
                <h3 class="font-semibold text-zinc-900 dark:text-zinc-50 mb-4">Bukti Pembayaran</h3>
                <a href="{{ route('admin.orders.payment-proof', $order) }}" target="_blank" class="text-blue-600 underline text-sm">
                    Lihat Bukti
                </a>
            </div>
            @endif
        </div>
        <div class="space-y-8">
            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
                <h3 class="font-semibold text-zinc-900 dark:text-zinc-50 mb-4">Transaksi</h3>
                @if($order->transactions->isNotEmpty())
                <ul class="space-y-4">
                    @foreach($order->transactions as $transaction)
                    <li class="flex justify-between items-center p-3 bg-zinc-50 dark:bg-zinc-800 rounded-xl">
                        <div>
                            <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $transaction->type->value }}</p>
                            <p class="text-xs text-zinc-500">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-medium 
                            {{ $transaction->status->value === 'SUCCESS' ? 'bg-emerald-50 text-emerald-700' : ($transaction->status->value === 'FAILED' ? 'bg-red-50 text-red-700' : 'bg-yellow-50 text-yellow-700') }}">
                            {{ $transaction->status->value }}
                        </span>
                    </li>
                    @endforeach
                </ul>
                @else
                <p class="text-zinc-500 text-sm">Belum ada transaksi.</p>
                @endif
            </div>
            @if($order->rating)
            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
                <h3 class="font-semibold text-zinc-900 dark:text-zinc-50 mb-4">Rating</h3>
                <div class="flex items-center gap-2">
                    <span class="text-lg font-bold text-zinc-900 dark:text-zinc-50">{{ $order->rating->score }}/5</span>
                    <span class="text-sm text-zinc-500">{{ $order->rating->comment ?? 'Tanpa komentar' }}</span>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>

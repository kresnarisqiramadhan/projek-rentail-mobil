<x-layout>
    <div class="max-w-[1440px] mx-auto pt-8 pb-32 px-6 md:px-12 min-h-screen">
        <nav class="flex items-center gap-2 text-zinc-400 text-xs uppercase tracking-widest mb-8">
            <a href="{{ route('home') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Beranda</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <a href="{{ route('orders.index') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Pesanan Saya</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-zinc-900 dark:text-zinc-50 font-bold">{{ $order->order_code }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Detail Utama -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Info Kendaraan -->
                <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
                    <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-50 mb-6">Detail Pesanan</h2>
                    <div class="flex flex-col sm:flex-row gap-6">
                        <div class="w-full sm:w-48 h-32 rounded-xl overflow-hidden bg-zinc-100 dark:bg-zinc-800">
                            @if($order->vehicle && $order->vehicle->photos->isNotEmpty())
                                <img src="{{ asset('storage/' . $order->vehicle->photos->first()->path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-zinc-400">
                                    <span class="material-symbols-outlined text-4xl">directions_car</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 space-y-3">
                            <div>
                                <span class="text-xs text-zinc-500">Kendaraan</span>
                                <p class="font-semibold text-zinc-900 dark:text-zinc-50">{{ $order->vehicle->name ?? '-' }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <span class="text-xs text-zinc-500">Plat Nomor</span>
                                    <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $order->vehicle->plate_number ?? '-' }}</p>
                                </div>
                                <div>
                                    <span class="text-xs text-zinc-500">Tipe</span>
                                    <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $order->vehicle->type ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                        <div>
                            <span class="text-xs text-zinc-500">Tanggal Mulai</span>
                            <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $order->start_date->format('d M Y') }}</p>
                        </div>
                        <div>
                            <span class="text-xs text-zinc-500">Tanggal Kembali</span>
                            <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $order->end_date->format('d M Y') }}</p>
                        </div>
                        <div>
                            <span class="text-xs text-zinc-500">Durasi</span>
                            <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $order->duration_days }} hari</p>
                        </div>
                        <div>
                            <span class="text-xs text-zinc-500">Metode Bayar</span>
                            <p class="font-medium text-zinc-900 dark:text-zinc-50 uppercase">{{ $order->payment_method->value }}</p>
                        </div>
                    </div>
                </section>

                <!-- Transaksi -->
                @if($order->transactions->isNotEmpty())
                <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
                    <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-50 mb-6">Riwayat Transaksi</h2>
                    <div class="space-y-4">
                        @foreach($order->transactions as $transaction)
                        <div class="flex items-center justify-between p-4 bg-zinc-50 dark:bg-zinc-800 rounded-xl">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-zinc-400">
                                    {{ $transaction->type->value === 'PAYMENT' ? 'payments' : 'currency_exchange' }}
                                </span>
                                <div>
                                    <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $transaction->type->value }}</p>
                                    <p class="text-xs text-zinc-500">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-zinc-900 dark:text-zinc-50">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</p>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-medium 
                                    {{ $transaction->status->value === 'SUCCESS' ? 'bg-emerald-50 text-emerald-700' : ($transaction->status->value === 'FAILED' ? 'bg-red-50 text-red-700' : 'bg-yellow-50 text-yellow-700') }}">
                                    {{ $transaction->status->value }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- Rating -->
                @if($order->rating)
                <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
                    <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-50 mb-6">Penilaian Anda</h2>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center">
                            @for($i=1; $i<=5; $i++)
                                <span class="material-symbols-outlined text-sm {{ $i <= $order->rating->score ? 'text-yellow-500' : 'text-zinc-300' }}">star</span>
                            @endfor
                        </div>
                        <span class="text-sm text-zinc-500">{{ $order->rating->comment ?? 'Tanpa komentar' }}</span>
                    </div>
                </section>
                @endif
            </div>

            <!-- Sidebar Ringkasan -->
            <div class="space-y-8">
                <div class="bg-zinc-900 text-white rounded-2xl p-6 sticky top-24">
                    <h2 class="text-lg font-bold mb-6">Ringkasan Pembayaran</h2>
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-zinc-400 text-sm">
                            <span>Total Harga</span>
                            <span>Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-zinc-800">
                        <div class="flex justify-between items-center">
                            <span class="text-sm">Status</span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium 
                                @if($order->status->value === 'PENDING' || $order->status->value === 'PENDING_VERIFICATION') bg-yellow-500/20 text-yellow-200
                                @elseif($order->status->value === 'PAID' || $order->status->value === 'ACTIVE') bg-blue-500/20 text-blue-200
                                @elseif($order->status->value === 'COMPLETED' || $order->status->value === 'RATED') bg-emerald-500/20 text-emerald-200
                                @else bg-red-500/20 text-red-200
                                @endif
                            ">
                                {{ $order->status->label() }}
                            </span>
                        </div>
                    </div>
                    @if($order->status === \App\Enums\OrderStatus::PENDING || $order->status === \App\Enums\OrderStatus::PENDING_VERIFICATION)
                        <a href="{{ route('payment', $order) }}" class="block mt-6 w-full h-12 bg-white text-zinc-900 rounded-full flex items-center justify-center font-medium hover:bg-zinc-100 transition-colors">
                            Lanjutkan Pembayaran
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>

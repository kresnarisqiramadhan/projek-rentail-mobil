<x-profile-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Riwayat Sewa</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Lihat dan kelola penyewaan Anda yang akan datang dan yang lalu.</p>
    </div>

    <div class="space-y-6">
        @forelse($orders as $order)
        @php
            $statusColor = match($order->status) {
                \App\Enums\OrderStatus::PENDING => 'bg-amber-100 text-amber-800 dark:bg-amber-950/30 dark:text-amber-400',
                \App\Enums\OrderStatus::PENDING_VERIFICATION => 'bg-blue-100 text-blue-800 dark:bg-blue-950/30 dark:text-blue-400',
                \App\Enums\OrderStatus::PAID => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-400',
                \App\Enums\OrderStatus::ACTIVE => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-950/30 dark:text-indigo-400',
                \App\Enums\OrderStatus::COMPLETED, \App\Enums\OrderStatus::RATED => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-800 dark:text-zinc-300',
                \App\Enums\OrderStatus::CANCELLED => 'bg-rose-100 text-rose-800 dark:bg-rose-950/30 dark:text-rose-400',
                default => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-800 dark:text-zinc-300',
            };
        @endphp
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden hover:shadow-md transition-shadow">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="w-full lg:w-64 h-40 flex-shrink-0 relative bg-zinc-100 dark:bg-zinc-800 rounded-xl overflow-hidden">
                        @if($order->vehicle->photos->first())
                            <img src="{{ asset('storage/' . $order->vehicle->photos->first()->path) }}" 
                                 class="w-full h-full object-cover" alt="{{ $order->vehicle->name }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-zinc-400 text-4xl">directions_car</span>
                            </div>
                        @endif
                        <div class="absolute top-2 left-2 px-3 py-1 text-[10px] font-black uppercase rounded-lg shadow-lg {{ $statusColor }}">
                            {{ $order->status->label() }}
                        </div>
                    </div>
                    
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-50">{{ $order->vehicle->name }}</h3>
                                    <p class="text-xs text-zinc-500 font-bold uppercase tracking-widest mt-1">Order #{{ $order->order_code }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-black text-zinc-900 dark:text-zinc-50 italic">Rp{{ number_format($order->total_price) }}</div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase">Total Pembayaran</div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-6">
                                <div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase mb-1">Tanggal Ambil</div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50">{{ $order->start_date->format('d M Y') }}</div>
                                </div>
                                <div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase mb-1">Tanggal Kembali</div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50">{{ $order->end_date->format('d M Y') }}</div>
                                </div>
                                <div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase mb-1">Metode</div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50 uppercase">{{ $order->payment_method?->value ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-wrap items-center gap-3">
                            <a href="{{ route('orders.show', $order) }}" class="px-6 py-2.5 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 rounded-xl text-xs font-bold hover:opacity-90 transition-opacity">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="p-12 text-center bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl">
            <div class="w-16 h-16 bg-zinc-50 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-zinc-300">history</span>
            </div>
            <h3 class="text-zinc-900 dark:text-zinc-50 font-medium mb-1">Belum ada riwayat sewa</h3>
            <p class="text-zinc-500 text-sm font-light mb-6">Perjalanan sewa Anda belum dimulai.</p>
            <a href="{{ route('vehicles') }}" class="inline-flex px-6 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">
                Mulai Sewa
            </a>
        </div>
        @endforelse

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>
</x-profile-layout>

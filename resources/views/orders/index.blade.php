<x-layout>
    <div class="max-w-[1440px] mx-auto pt-8 pb-16 px-6 md:px-12 min-h-screen">
        <div class="mb-12">
            <h1 class="text-4xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Pesanan Saya</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">Daftar semua pesanan Anda.</p>
        </div>

        @if($orders->isEmpty())
            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-12 text-center">
                <div class="w-16 h-16 bg-zinc-50 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-zinc-300">receipt_long</span>
                </div>
                <h3 class="text-zinc-900 dark:text-zinc-50 font-medium mb-1">Belum ada pesanan</h3>
                <p class="text-zinc-500 text-sm font-light mb-6">Anda belum membuat pesanan sewa.</p>
                <a href="{{ route('vehicles') }}" class="inline-flex px-6 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">
                    Jelajahi Armada
                </a>
            </div>
        @else
            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-zinc-500 dark:text-zinc-400">
                        <thead class="text-xs uppercase bg-zinc-50 dark:bg-zinc-800 text-zinc-400">
                            <tr>
                                <th class="px-6 py-4">Kode Pesanan</th>
                                <th class="px-6 py-4">Kendaraan</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Total</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                            @foreach($orders as $order)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                                <td class="px-6 py-4 font-medium text-zinc-900 dark:text-zinc-50">{{ $order->order_code }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($order->vehicle && $order->vehicle->photos->isNotEmpty())
                                            <img src="{{ asset('storage/' . $order->vehicle->photos->first()->path) }}" class="w-10 h-10 rounded-lg object-cover bg-zinc-100 dark:bg-zinc-700">
                                        @else
                                            <div class="w-10 h-10 rounded-lg bg-zinc-100 dark:bg-zinc-700 flex items-center justify-center">
                                                <span class="material-symbols-outlined text-zinc-400 text-lg">directions_car</span>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $order->vehicle->name ?? 'Kendaraan' }}</p>
                                            <p class="text-xs text-zinc-400">{{ $order->vehicle->plate_number ?? '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p>{{ $order->start_date->format('d M') }} → {{ $order->end_date->format('d M Y') }}</p>
                                    <p class="text-xs text-zinc-400">{{ $order->duration_days }} hari</p>
                                </td>
                                <td class="px-6 py-4 font-semibold text-zinc-900 dark:text-zinc-50">
                                    Rp{{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium 
                                        @if($order->status->value === 'PENDING' || $order->status->value === 'PENDING_VERIFICATION') bg-yellow-50 text-yellow-700
                                        @elseif($order->status->value === 'PAID' || $order->status->value === 'ACTIVE') bg-blue-50 text-blue-700
                                        @elseif($order->status->value === 'COMPLETED' || $order->status->value === 'RATED') bg-emerald-50 text-emerald-700
                                        @else bg-red-50 text-red-700
                                        @endif
                                    ">
                                        {{ $order->status->label() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('orders.show', $order) }}" class="text-zinc-900 dark:text-zinc-50 underline text-xs font-bold hover:no-underline">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6">
                    {{ $orders->links() }}
                </div>
            </div>
        @endif
    </div>
</x-layout>

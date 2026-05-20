<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Dashboard Admin</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Ringkasan operasional rental mobil hari ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">directions_car</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">{{ $totalVehicles }}</p>
                    <p class="text-sm text-zinc-500">Total Kendaraan</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center">
                    <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400">receipt_long</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">{{ $activeOrders }}</p>
                    <p class="text-sm text-zinc-500">Pesanan Aktif</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-yellow-50 dark:bg-yellow-900/30 flex items-center justify-center">
                    <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-400">pending</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">{{ $pendingPayments }}</p>
                    <p class="text-sm text-zinc-500">Menunggu Verifikasi</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-purple-50 dark:bg-purple-900/30 flex items-center justify-center">
                    <span class="material-symbols-outlined text-purple-600 dark:text-purple-400">payments</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">
                        Rp{{ number_format($recentOrders->sum('total_price'), 0, ',', '.') }}
                    </p>
                    <p class="text-sm text-zinc-500">Pendapatan (5 terakhir)</p>
                </div>
            </div>
        </div>
    </div>

    <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800">
            <h2 class="font-semibold text-zinc-900 dark:text-zinc-50">Pesanan Terbaru</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-zinc-500 dark:text-zinc-400">
                <thead class="text-xs uppercase bg-zinc-50 dark:bg-zinc-800 text-zinc-400">
                    <tr>
                        <th class="px-6 py-4">Kode</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Kendaraan</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                        <td class="px-6 py-4 font-medium text-zinc-900 dark:text-zinc-50">{{ $order->order_code }}</td>
                        <td class="px-6 py-4">{{ $order->user->name }}</td>
                        <td class="px-6 py-4">{{ $order->vehicle->name }}</td>
                        <td class="px-6 py-4 font-semibold">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium 
                                @if($order->status->value === 'PENDING' || $order->status->value === 'PENDING_VERIFICATION') bg-yellow-50 text-yellow-700
                                @elseif(in_array($order->status->value, ['PAID', 'ACTIVE'])) bg-blue-50 text-blue-700
                                @elseif(in_array($order->status->value, ['COMPLETED', 'RATED'])) bg-emerald-50 text-emerald-700
                                @else bg-red-50 text-red-700
                                @endif">
                                {{ $order->status->label() }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $order->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-zinc-500">Belum ada pesanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-admin-layout>

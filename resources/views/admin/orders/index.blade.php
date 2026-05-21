<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Kelola Pesanan</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Semua pesanan dari pelanggan.</p>
    </div>

    <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-zinc-500 dark:text-zinc-400">
                <thead class="text-xs uppercase bg-zinc-50 dark:bg-zinc-800 text-zinc-400">
                    <tr>
                        <th class="px-6 py-4">Kode</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Kendaraan</th>
                        <th class="px-6 py-4">Tanggal Sewa</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                    @forelse($orders as $order)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                        <td class="px-6 py-4 font-medium text-zinc-900 dark:text-zinc-50">{{ $order->order_code }}</td>
                        <td class="px-6 py-4">{{ $order->user->name }}</td>
                        <td class="px-6 py-4">{{ $order->vehicle->name }}</td>
                        <td class="px-6 py-4">{{ $order->start_date->format('d M') }} → {{ $order->end_date->format('d M Y') }}</td>
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
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors material-symbols-outlined text-lg">visibility</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-zinc-500">Belum ada pesanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6">
            {{ $orders->links() }}
        </div>
    </section>
</x-admin-layout>

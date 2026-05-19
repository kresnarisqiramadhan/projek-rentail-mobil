<x-profile-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Riwayat Sewa</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Lihat dan kelola penyewaan Anda yang akan datang dan yang lalu.</p>
    </div>

    <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden">
        @if($orders->isEmpty())
        <div class="p-12 text-center">
            <div class="w-16 h-16 bg-zinc-50 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-zinc-300">history</span>
            </div>
            <h3 class="text-zinc-900 dark:text-zinc-50 font-medium mb-1">Belum ada riwayat sewa</h3>
            <p class="text-zinc-500 text-sm font-light mb-6">Perjalanan sewa Anda belum dimulai.</p>
            <a href="{{ route('vehicles') }}" class="inline-flex px-6 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">
                Mulai Sewa
            </a>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-zinc-500 dark:text-zinc-400">
                <thead class="text-xs uppercase bg-zinc-50 dark:bg-zinc-800 text-zinc-400">
                    <tr>
                        <th class="px-6 py-4">Kode</th>
                        <th class="px-6 py-4">Kendaraan</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                    @foreach($orders as $order)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                        <td class="px-6 py-4 font-medium text-zinc-900 dark:text-zinc-50">{{ $order->order_code }}</td>
                        <td class="px-6 py-4">{{ $order->vehicle->name }}</td>
                        <td class="px-6 py-4">{{ $order->start_date->format('d M') }} → {{ $order->end_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 font-semibold">Rp{{ number_format($order->total_price) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-zinc-100 dark:bg-zinc-700 text-zinc-600 dark:text-zinc-300">
                                {{ $order->status->label() }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
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
        @endif
    </section>
</x-profile-layout>

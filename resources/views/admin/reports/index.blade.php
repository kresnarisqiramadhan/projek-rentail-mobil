<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Laporan</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Ringkasan pemesanan dan pendapatan.</p>
    </div>

    <form method="GET" class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6 mb-8 flex flex-wrap gap-4 items-end">
        <div>
            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ request('start_date', now()->subMonth()->toDateString()) }}" class="bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-2 text-sm outline-none">
        </div>
        <div>
            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ request('end_date', now()->toDateString()) }}" class="bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-2 text-sm outline-none">
        </div>
        <button type="submit" class="px-6 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">Filter</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
            <p class="text-sm text-zinc-500">Total Pesanan</p>
            <p class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">{{ $orders->count() }}</p>
        </div>
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
            <p class="text-sm text-zinc-500">Total Pendapatan</p>
            <p class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
            <p class="text-sm text-zinc-500">Pesanan Aktif</p>
            <p class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">{{ $orders->whereIn('status', ['PENDING', 'PENDING_VERIFICATION', 'PAID', 'ACTIVE'])->count() }}</p>
        </div>
    </div>

    <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden">
        <table class="w-full text-sm text-left text-zinc-500 dark:text-zinc-400">
            <thead class="text-xs uppercase bg-zinc-50 dark:bg-zinc-800 text-zinc-400">
                <tr>
                    <th class="px-6 py-4">Kode</th>
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4">Kendaraan</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Total</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                @forelse($orders as $order)
                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                    <td class="px-6 py-4 font-medium text-zinc-900 dark:text-zinc-50">{{ $order->order_code }}</td>
                    <td class="px-6 py-4">{{ $order->user->name }}</td>
                    <td class="px-6 py-4">{{ $order->vehicle->name }}</td>
                    <td class="px-6 py-4">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ $order->status->label() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-zinc-500">Belum ada data pesanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>

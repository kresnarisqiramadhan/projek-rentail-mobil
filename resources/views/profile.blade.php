<x-profile-layout>
    @php
        $activeOrder = $user->orders()->with(['vehicle', 'vehicle.photos'])->where('status', \App\Enums\OrderStatus::ACTIVE)->first();
        $pendingPaymentOrder = $user->orders()->with('vehicle')->where('status', \App\Enums\OrderStatus::PENDING)->first();
        $recentHistory = $user->orders()->with(['vehicle', 'vehicle.photos'])->latest()->take(3)->get();
    @endphp
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Dasbor Profil</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Selamat datang kembali, {{ $user->name }}. Kelola perjalanan dan akun Anda.</p>
    </div>

    <!-- Urgent Action: Payment Countdown (Visible when status is PENDING) -->
    @if($pendingPaymentOrder)
    <div class="mb-8 p-6 bg-amber-50 dark:bg-amber-950/20 border border-amber-100 dark:border-amber-900/30 rounded-2xl flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-amber-100 dark:bg-amber-900/50 flex items-center justify-center text-amber-600 dark:text-amber-400 animate-pulse">
                <span class="material-symbols-outlined">payments</span>
            </div>
            <div>
                <h4 class="font-bold text-amber-900 dark:text-amber-200">Pembayaran Tertunda</h4>
                <p class="text-sm text-amber-700 dark:text-amber-300">
                    {{ $pendingPaymentOrder->order_code }} - Silakan selesaikan pembayaran Anda.
                </p>
            </div>
        </div>
        <a href="{{ route('payment', $pendingPaymentOrder) }}" class="w-full md:w-auto px-6 py-2.5 bg-amber-600 text-white rounded-xl text-sm font-bold hover:bg-amber-700 transition-colors text-center">
            Selesaikan Pembayaran
        </a>
    </div>
    @endif

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-6 rounded-2xl">
            <div class="text-zinc-500 text-xs font-bold uppercase tracking-wider mb-2">Total Sewa</div>
            <div class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">{{ $user->orders_count }}</div>
        </div>
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-6 rounded-2xl">
            <div class="text-zinc-500 text-xs font-bold uppercase tracking-wider mb-2">Status Anggota</div>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full {{ $user->orders_count >= 10 ? 'bg-emerald-500' : 'bg-zinc-400' }}"></span>
                <span class="text-lg font-bold text-zinc-900 dark:text-zinc-50">
                    {{ $user->orders_count >= 10 ? 'VIP Elite' : 'Regular' }}
                </span>
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-6 rounded-2xl">
            <div class="text-zinc-500 text-xs font-bold uppercase tracking-wider mb-2">Status Akun</div>
            <div class="text-lg font-bold {{ $user->isActive() ? 'text-emerald-600' : 'text-rose-600' }} flex items-center gap-1">
                @if($user->isActive())
                    <span class="material-symbols-outlined text-sm">verified</span> Aktif
                @else
                    <span class="material-symbols-outlined text-sm">error</span> Nonaktif
                @endif
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-6 rounded-2xl">
            <div class="text-zinc-500 text-xs font-bold uppercase tracking-wider mb-2">Sewa Berjalan</div>
            <div class="text-lg font-bold text-zinc-900 dark:text-zinc-50">
                {{ $user->orders()->where('status', \App\Enums\OrderStatus::ACTIVE)->count() }} Mobil
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main: Active Rental -->
        <div class="lg:col-span-2 space-y-8">
            @if($activeOrder)
            <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex justify-between items-center">
                    <h2 class="font-bold text-zinc-900 dark:text-zinc-50">Sewa Aktif</h2>
                    <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 text-[10px] font-black uppercase rounded-full">Dalam Perjalanan</span>
                </div>
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        @if($activeOrder->vehicle->photos->first())
                            <img src="{{ asset('storage/' . $activeOrder->vehicle->photos->first()->path) }}" 
                                 class="w-full md:w-48 h-32 object-cover rounded-xl" alt="{{ $activeOrder->vehicle->name }}">
                        @else
                            <div class="w-full md:w-48 h-32 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-zinc-400 text-4xl">directions_car</span>
                            </div>
                        @endif
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-50">{{ $activeOrder->vehicle->name }}</h3>
                                    <p class="text-sm text-zinc-500">{{ $activeOrder->vehicle->brand }} • {{ $activeOrder->vehicle->model }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase mb-1">Ambil</div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50">{{ $activeOrder->start_date->format('d M Y') }}</div>
                                </div>
                                <div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase mb-1">Kembali</div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50">{{ $activeOrder->end_date->format('d M Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800 flex flex-wrap gap-3">
                        <a href="{{ route('orders.show', $activeOrder) }}" class="px-4 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 rounded-xl text-xs font-bold hover:opacity-90 transition-opacity">Lihat Detail</a>
                    </div>
                </div>
            </section>
            @else
            <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden shadow-sm p-6 text-center">
                <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-zinc-400">directions_car</span>
                </div>
                <h3 class="font-bold text-zinc-900 dark:text-zinc-50 text-sm">Tidak Ada Sewa Aktif</h3>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1 max-w-sm mx-auto">Anda tidak memiliki penyewaan yang sedang berjalan saat ini.</p>
                <a href="{{ route('vehicles') }}" class="mt-4 inline-block px-4 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-xs font-bold rounded-xl hover:opacity-90 transition-opacity">Mulai Sewa</a>
            </section>
            @endif

            <!-- Secondary: Recent History Preview -->
            <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex justify-between items-center">
                    <h2 class="font-bold text-zinc-900 dark:text-zinc-50">Riwayat Transaksi</h2>
                    <a href="{{ route('profile.rentals') }}" class="text-xs font-bold text-zinc-500 hover:text-zinc-900 transition-colors">Lihat Semua</a>
                </div>
                <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    @forelse($recentHistory as $history)
                    <div class="p-4 flex items-center justify-between hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center overflow-hidden">
                                @if($history->vehicle->photos->first())
                                    <img src="{{ asset('storage/' . $history->vehicle->photos->first()->path) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-zinc-400 group-hover:scale-110 transition-transform">directions_car</span>
                                @endif
                            </div>
                            <div>
                                <div class="text-sm font-bold text-zinc-900 dark:text-zinc-50">{{ $history->vehicle->name }}</div>
                                <div class="text-xs text-zinc-500">{{ $history->start_date->format('d M') }} - {{ $history->end_date->format('d M Y') }} • Rp{{ number_format($history->total_price) }}</div>
                            </div>
                        </div>
                        <span class="px-2 py-1 bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 text-[9px] font-bold uppercase rounded-md">{{ $history->status->label() }}</span>
                    </div>
                    @empty
                    <div class="p-8 text-center text-sm text-zinc-500">Belum ada riwayat transaksi.</div>
                    @endforelse
                </div>
            </section>
        </div>

        <!-- Sidebar: Account Verification Status & Loyalty -->
        <div class="space-y-6">
            <div class="bg-zinc-900 text-white rounded-3xl p-6 relative overflow-hidden group">
                <div class="absolute -top-12 -right-12 w-32 h-32 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                <h4 class="text-sm font-bold uppercase tracking-widest text-zinc-400 mb-6">Loyalty Program</h4>
                <div class="flex items-end justify-between mb-4">
                    <div>
                        <div class="text-3xl font-black italic tracking-tighter">
                            {{ $user->orders_count >= 10 ? 'ELITE' : 'MEMBER' }}
                        </div>
                        <div class="text-[10px] font-bold text-zinc-500">{{ $user->orders_count * 150 }} POINTS</div>
                    </div>
                    @if($user->orders_count < 10)
                    <div class="text-[10px] font-bold text-right text-zinc-500">
                        {{ 10 - $user->orders_count }} RENTAL(S) UNTIL<br>ELITE STATUS
                    </div>
                    @endif
                </div>
                <div class="w-full h-1 bg-zinc-800 rounded-full overflow-hidden">
                    <div class="h-full bg-white rounded-full" style="width: {{ min(100, $user->orders_count * 10) }}%"></div>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
                <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-400 mb-4">Verifikasi Dokumen</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-emerald-500 text-sm">check_circle</span>
                            <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Identitas (KTP)</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-emerald-500 text-sm">check_circle</span>
                            <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">SIM A</span>
                        </div>
                    </div>
                </div>
                <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                    <a href="{{ route('profile.settings') }}" class="text-xs font-bold text-zinc-900 dark:text-zinc-50 underline underline-offset-4">Kelola Dokumen</a>
                </div>
            </div>
        </div>
    </div>
</x-profile-layout>

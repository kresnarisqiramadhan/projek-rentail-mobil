<x-profile-layout>
    @php $user = auth()->user()->loadCount(['orders', 'ratings']); @endphp
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Dasbor Profil</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Selamat datang kembali, {{ $user->name }}. Berikut ringkasan akun Anda.</p>
    </div>

    <!-- Sewa Terbaru -->
    <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex justify-between items-center">
            <h2 class="font-semibold text-zinc-900 dark:text-zinc-50">Sewa Terbaru</h2>
            <a href="{{ route('profile.rentals') }}" class="text-sm text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Lihat semua</a>
        </div>
        @php $recentOrders = $user->orders()->with('vehicle')->latest()->take(3)->get(); @endphp
        @if($recentOrders->isNotEmpty())
        <ul class="divide-y divide-zinc-100 dark:divide-zinc-800">
            @foreach($recentOrders as $order)
            <li class="p-4 flex justify-between items-center hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-zinc-100 dark:bg-zinc-700 flex items-center justify-center overflow-hidden">
                        @if($order->vehicle->photos->first())
                            <img src="{{ asset('storage/' . $order->vehicle->photos->first()->path) }}" class="w-full h-full object-cover">
                        @else
                            <span class="material-symbols-outlined text-zinc-400">directions_car</span>
                        @endif
                    </div>
                    <div>
                        <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $order->vehicle->name }}</p>
                        <p class="text-sm text-zinc-500">{{ $order->start_date->format('d M') }} - {{ $order->end_date->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-zinc-900 dark:text-zinc-50">Rp{{ number_format($order->total_price) }}</p>
                    <p class="text-xs text-zinc-400">{{ $order->status->label() }}</p>
                </div>
            </li>
            @endforeach
        </ul>
        @else
        <div class="p-12 text-center">
            <div class="w-16 h-16 bg-zinc-50 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-zinc-300">history</span>
            </div>
            <h3 class="text-zinc-900 dark:text-zinc-50 font-medium mb-1">Belum ada sewa</h3>
            <p class="text-zinc-500 text-sm font-light mb-6">Anda belum melakukan penyewaan dengan kami.</p>
            <a href="{{ route('vehicles') }}" class="inline-flex px-6 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">
                Jelajahi Armada
            </a>
        </div>
        @endif
    </section>

    <!-- Info Akun -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Personal Info (sama seperti sebelumnya) -->
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
            <h3 class="font-semibold text-zinc-900 dark:text-zinc-50 mb-6 pb-2 border-b border-zinc-100 dark:border-zinc-800">Info Pribadi</h3>
            <div class="space-y-4">
                <div>
                    <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Nama Lengkap</label>
                    <p class="text-zinc-900 dark:text-zinc-50 font-medium">{{ $user->name }}</p>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Alamat Email</label>
                    <p class="text-zinc-500 font-medium">{{ $user->email }}</p>
                </div>
            </div>
        </div>
        <!-- Statistik -->
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
            <h3 class="font-semibold text-zinc-900 dark:text-zinc-50 mb-6 pb-2 border-b border-zinc-100 dark:border-zinc-800">Statistik</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-center p-4 bg-zinc-50 dark:bg-zinc-800 rounded-xl">
                    <p class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">{{ $user->orders_count }}</p>
                    <p class="text-xs text-zinc-400 uppercase tracking-widest">Total Sewa</p>
                </div>
                <div class="text-center p-4 bg-zinc-50 dark:bg-zinc-800 rounded-xl">
                    <p class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">{{ $user->ratings_count }}</p>
                    <p class="text-xs text-zinc-400 uppercase tracking-widest">Ulasan</p>
                </div>
            </div>
        </div>
    </div>
</x-profile-layout>

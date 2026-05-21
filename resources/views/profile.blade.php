<x-profile-layout>
    @php $user = auth()->user()->loadCount(['orders', 'ratings']); @endphp
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">{{ __('Profile Dashboard') }}</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">{{ __('Welcome back, :name. Here\'s an overview of your account.', ['name' => $user->name]) }}</p>
    </div>

    <!-- Sewa Terbaru -->
    <section class="bg-white dark:bg-zinc-950 border border-zinc-200/80 dark:border-zinc-800 rounded-3xl overflow-hidden mb-8 shadow-sm">
        <div class="px-6 py-5 border-b border-zinc-100 dark:border-zinc-900 flex justify-between items-center bg-zinc-50/50 dark:bg-zinc-900/10">
            <h2 class="font-bold text-zinc-900 dark:text-zinc-50">{{ __('Recent Rentals') }}</h2>
            <a href="{{ route('profile.rentals') }}" class="text-xs font-semibold text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">{{ __('View all') }}</a>
        </div>
        @php $recentOrders = $user->orders()->with('vehicle')->latest()->take(3)->get(); @endphp
        @if($recentOrders->isNotEmpty())
        <ul class="divide-y divide-zinc-100 dark:divide-zinc-900">
            @foreach($recentOrders as $order)
            <li class="p-5 flex justify-between items-center hover:bg-zinc-50 dark:hover:bg-zinc-900/30 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-zinc-100 dark:bg-zinc-850 flex items-center justify-center overflow-hidden border border-zinc-200/50 dark:border-zinc-800">
                        @if($order->vehicle && $order->vehicle->photos->isNotEmpty())
                            <img src="{{ asset('storage/' . $order->vehicle->photos->first()->path) }}" class="w-full h-full object-cover">
                        @else
                            <span class="material-symbols-outlined text-zinc-400">directions_car</span>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold text-zinc-900 dark:text-zinc-50">{{ $order->vehicle->name ?? 'Kendaraan' }}</p>
                        <p class="text-xs text-zinc-500">{{ $order->start_date->format('d M') }} - {{ $order->end_date->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-zinc-900 dark:text-zinc-50">Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                    <p class="text-xs font-medium text-zinc-400 mt-0.5">{{ $order->status->label() }}</p>
                </div>
            </li>
            @endforeach
        </ul>
        @else
        <div class="p-12 text-center">
            <div class="w-16 h-16 bg-zinc-50 dark:bg-zinc-900 rounded-full flex items-center justify-center mx-auto mb-4 border border-zinc-100 dark:border-zinc-800">
                <span class="material-symbols-outlined text-zinc-400">history</span>
            </div>
            <h3 class="text-zinc-900 dark:text-zinc-50 font-semibold mb-1">{{ __('No rentals yet') }}</h3>
            <p class="text-zinc-500 text-sm font-light mb-6">{{ __('You haven\'t made any rentals with us yet.') }}</p>
            <a href="{{ route('vehicles') }}" class="inline-flex px-6 py-2.5 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-xs font-semibold rounded-xl hover:opacity-90 transition-opacity">
                {{ __('Browse Fleet') }}
            </a>
        </div>
        @endif
    </section>

    <!-- Info Akun -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Personal Info -->
        <div class="bg-white dark:bg-zinc-950 border border-zinc-200/80 dark:border-zinc-800 rounded-3xl p-8 shadow-sm">
            <h3 class="font-bold text-zinc-900 dark:text-zinc-50 mb-6 pb-4 border-b border-zinc-100 dark:border-zinc-900 text-xs uppercase tracking-[0.2em]">{{ __('Personal Info') }}</h3>
            <div class="space-y-6">
                <div>
                    <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1.5 block">{{ __('Full Name') }}</label>
                    <p class="text-zinc-900 dark:text-zinc-50 font-semibold text-lg">{{ $user->name }}</p>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1.5 block">{{ __('Email Address') }}</label>
                    <p class="text-zinc-600 dark:text-zinc-400 font-medium">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="bg-white dark:bg-zinc-950 border border-zinc-200/80 dark:border-zinc-800 rounded-3xl p-8 shadow-sm">
            <h3 class="font-bold text-zinc-900 dark:text-zinc-50 mb-6 pb-4 border-b border-zinc-100 dark:border-zinc-900 text-xs uppercase tracking-[0.2em]">{{ __('Statistics') }}</h3>
            <div class="grid grid-cols-2 gap-6">
                <div class="text-center p-6 bg-zinc-50 dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-850 rounded-2xl">
                    <p class="text-3xl font-black text-zinc-900 dark:text-zinc-50">{{ $user->orders_count }}</p>
                    <p class="text-[10px] text-zinc-400 uppercase tracking-wider font-bold mt-2">{{ __('Total Rentals') }}</p>
                </div>
                <div class="text-center p-6 bg-zinc-50 dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-850 rounded-2xl">
                    <p class="text-3xl font-black text-zinc-900 dark:text-zinc-50">{{ $user->ratings_count }}</p>
                    <p class="text-[10px] text-zinc-400 uppercase tracking-wider font-bold mt-2">{{ __('Reviews') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-profile-layout>

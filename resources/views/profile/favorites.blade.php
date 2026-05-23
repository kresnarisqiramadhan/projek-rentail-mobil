<x-profile-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Kendaraan Favorit</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Kendaraan yang Anda simpan untuk dilihat nanti.</p>
    </div>

    @php
        $favorites = auth()->user()->favorites()->with('vehicle.photos')->latest()->get();
    @endphp

    @if($favorites->isEmpty())
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-12 text-center">
            <div class="w-16 h-16 bg-zinc-50 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-zinc-300">favorite_border</span>
            </div>
            <h3 class="text-zinc-900 dark:text-zinc-50 font-medium mb-1">Belum ada favorit</h3>
            <p class="text-zinc-500 text-sm font-light mb-6">Anda belum menambahkan kendaraan ke favorit.</p>
            <a href="{{ route('vehicles') }}" class="inline-flex px-6 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">
                Jelajahi Armada
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($favorites as $favorite)
                @php $v = $favorite->vehicle; @endphp
                <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden group shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="relative h-48 overflow-hidden bg-zinc-100 dark:bg-zinc-800">
                        @if($v->photos->isNotEmpty())
                            <img src="{{ asset('storage/' . $v->photos->first()->path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $v->name }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-zinc-400">
                                <span class="material-symbols-outlined text-5xl">directions_car</span>
                            </div>
                        @endif
                        <form action="{{ route('vehicle.favorite', $v) }}" method="POST" class="absolute top-4 right-4">
                            @csrf
                            <button type="submit" class="w-10 h-10 bg-white/90 dark:bg-zinc-900/90 rounded-full flex items-center justify-center text-red-500 shadow-lg backdrop-blur-sm hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined">favorite</span>
                            </button>
                        </form>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-1">
                            <div>
                                <h3 class="font-bold text-zinc-900 dark:text-zinc-50">{{ $v->name }}</h3>
                                <p class="text-xs text-zinc-500 mt-0.5">{{ $v->type }} • {{ $v->seats }} Kursi</p>
                            </div>
                            @if($v->avg_rating > 0)
                                <div class="flex items-center gap-1 text-xs font-medium text-zinc-900 dark:text-zinc-50">
                                    <span class="material-symbols-outlined text-yellow-500 text-sm">star</span>
                                    {{ number_format($v->avg_rating, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                            <div>
                                <span class="text-sm font-bold text-zinc-900 dark:text-zinc-50">Rp{{ number_format($v->price_per_day, 0, ',', '.') }}</span>
                                <span class="text-xs text-zinc-400"> /hari</span>
                            </div>
                            <a href="{{ route('vehicle.details', $v) }}" class="px-4 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-xs font-medium rounded-lg hover:opacity-90 transition-opacity">
                                Lihat
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-profile-layout>

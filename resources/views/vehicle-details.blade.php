<x-layout>
    <main class="pt-8 pb-32 px-6 md:px-12 max-w-[1440px] mx-auto min-h-screen">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-zinc-400 text-xs uppercase tracking-widest mb-8">
            <a href="{{ route('home') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Beranda</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <a href="{{ route('vehicles') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Armada</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-zinc-900 dark:text-zinc-50 font-bold">{{ $vehicle->brand }} {{ $vehicle->model }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <!-- Galeri Gambar -->
            <div class="space-y-6">
                <div class="aspect-[4/3] bg-zinc-100 dark:bg-zinc-800 rounded-3xl overflow-hidden shadow-sm">
                    @if ($vehicle->photos->isNotEmpty())
                        <img src="{{ asset('storage/' . $vehicle->photos->first()->path) }}"
                             alt="{{ $vehicle->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-zinc-400">
                            <span class="material-symbols-outlined text-6xl">directions_car</span>
                        </div>
                    @endif
                </div>
                @if ($vehicle->photos->count() > 1)
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($vehicle->photos->take(4) as $photo)
                    <div class="aspect-square bg-zinc-100 dark:bg-zinc-800 rounded-xl overflow-hidden cursor-pointer border-2 {{ $loop->first ? 'border-zinc-900 dark:border-zinc-50' : 'border-transparent' }}">
                        <img src="{{ asset('storage/' . $photo->path) }}" class="w-full h-full object-cover">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Detail -->
            <div class="space-y-8">
                <!-- Nama, Brand, Harga -->
                <div>
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-zinc-500 uppercase tracking-widest mb-1">{{ $vehicle->brand }}</p>
                            <h1 class="text-4xl md:text-5xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight mb-2">
                                {{ $vehicle->model }}
                            </h1>
                            <p class="text-lg text-zinc-500 font-light">{{ $vehicle->type }} • {{ $vehicle->seats }} Kursi</p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-zinc-900 dark:text-zinc-50">
                                Rp{{ number_format($vehicle->price_per_day, 0, ',', '.') }}
                            </div>
                            <p class="text-xs text-zinc-400 uppercase tracking-widest mt-1">Per Hari</p>
                        </div>
                    </div>

                    <!-- Status & Rating -->
                    <div class="flex items-center gap-6 mt-4">
                        @if($isAvailable)
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-medium">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Tersedia
                            </span>
                        @elseif(!$vehicle->is_active)
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-50 text-red-700 rounded-full text-xs font-medium">
                                <span class="w-2 h-2 bg-red-500 rounded-full"></span> Tidak Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-50 text-yellow-700 rounded-full text-xs font-medium">
                                <span class="w-2 h-2 bg-yellow-500 rounded-full"></span> Sedang Disewa
                            </span>
                        @endif

                        @if($vehicle->ratings_count > 0)
                            <div class="flex items-center gap-1 text-sm text-zinc-500">
                                <span class="material-symbols-outlined text-yellow-500 text-base">star</span>
                                <span class="font-medium text-zinc-900 dark:text-zinc-50">{{ number_format($vehicle->avg_rating, 1) }}</span>
                                <span>({{ $vehicle->ratings_count }} ulasan)</span>
                            </div>
                        @else
                            <span class="text-sm text-zinc-400">Belum ada rating</span>
                        @endif
                    </div>
                </div>

                <!-- Spesifikasi -->
                <div class="border-t border-zinc-100 dark:border-zinc-800 pt-8">
                    <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-[0.2em] mb-6">Spesifikasi</h3>
                    <div class="grid grid-cols-2 gap-y-4 gap-x-8">
                        <div>
                            <span class="text-sm text-zinc-500">Merk</span>
                            <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->brand }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-zinc-500">Model</span>
                            <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->model }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-zinc-500">Tipe</span>
                            <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->type }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-zinc-500">Tahun</span>
                            <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->year ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-zinc-500">Plat Nomor</span>
                            <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->plate_number }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-zinc-500">Jumlah Kursi</span>
                            <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->seats }}</p>
                        </div>
                        <div class="col-span-2">
                            <span class="text-sm text-zinc-500">Kondisi</span>
                            <p class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->condition }}</p>
                        </div>
                    </div>
                </div>

                <!-- Ulasan -->
                @if($vehicle->ratings->isNotEmpty())
                <div class="border-t border-zinc-100 dark:border-zinc-800 pt-8">
                    <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-[0.2em] mb-6">Ulasan Terbaru</h3>
                    <div class="space-y-6 max-h-80 overflow-y-auto pr-2">
                        @foreach($vehicle->ratings as $rating)
                        <div class="flex gap-4">
                            <div class="w-8 h-8 rounded-full bg-zinc-100 dark:bg-zinc-700 flex items-center justify-center text-xs font-bold text-zinc-500 flex-shrink-0">
                                {{ substr($rating->user->name ?? 'U', 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-sm font-medium text-zinc-900 dark:text-zinc-50">{{ $rating->user->name ?? 'Anonim' }}</span>
                                    <div class="flex items-center">
                                        @for($i=1; $i<=5; $i++)
                                            <span class="material-symbols-outlined text-sm {{ $i <= $rating->score ? 'text-yellow-500' : 'text-zinc-300' }}">star</span>
                                        @endfor
                                    </div>
                                    <span class="text-xs text-zinc-400">{{ $rating->created_at->diffForHumans() }}</span>
                                </div>
                                @if($rating->comment)
                                <p class="text-sm text-zinc-600 dark:text-zinc-400 font-light">{{ $rating->comment }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Tombol Pesan -->
                <div class="pt-6">
                    @auth
                        @if($isAvailable)
                            <a href="{{ route('checkout') . '?vehicle_id=' . $vehicle->id }}"
                               class="w-full h-16 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-lg font-bold rounded-2xl hover:opacity-90 transition-opacity shadow-lg flex items-center justify-center">
                                Pesan Kendaraan Ini
                            </a>
                        @else
                            <button disabled
                                    class="w-full h-16 bg-zinc-200 dark:bg-zinc-700 text-zinc-400 dark:text-zinc-500 text-lg font-bold rounded-2xl cursor-not-allowed flex items-center justify-center">
                                Tidak Tersedia untuk Disewa
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="w-full h-16 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-lg font-bold rounded-2xl hover:opacity-90 transition-opacity shadow-lg flex items-center justify-center">
                            Login untuk Memesan
                        </a>
                    @endauth
                    <p class="text-center text-[10px] text-zinc-400 uppercase tracking-widest mt-4">
                        Belum ada pembayaran dikenakan
                    </p>
                </div>
            </div>
        </div>
    </main>
</x-layout>

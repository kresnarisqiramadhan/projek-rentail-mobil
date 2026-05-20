<x-layout>
    <div class="max-w-[1440px] mx-auto pt-8 pb-16 px-6 md:px-12 min-h-screen"
         x-data="{ sort: '{{ request('sort', 'terbaru') }}' }">
        <div class="mb-12">
            <h1 class="text-4xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Armada Kami</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2 max-w-2xl text-lg font-light">Jelajahi koleksi mobil pilihan untuk segala kebutuhan perjalanan Anda.</p>
        </div>

        <form method="GET" action="{{ route('vehicles') }}" id="filter-form">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Sidebar Filters -->
                <aside class="w-full lg:w-72 flex-shrink-0 space-y-10">
                    <!-- Merk -->
                    <div>
                        <h3 class="text-xs font-bold text-zinc-900 dark:text-zinc-50 uppercase tracking-[0.2em] mb-6">Merk</h3>
                        <div class="space-y-4">
                            @foreach($brands as $brand)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="brand[]" value="{{ $brand }}"
                                       class="w-4 h-4 rounded border-zinc-200 dark:border-zinc-800 text-zinc-900 focus:ring-0"
                                       @if(in_array($brand, request('brand', []))) checked @endif>
                                <span class="text-sm text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50 transition-colors">{{ $brand }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Jumlah Kursi -->
                    <div>
                        <h3 class="text-xs font-bold text-zinc-900 dark:text-zinc-50 uppercase tracking-[0.2em] mb-6">Jumlah Kursi</h3>
                        <div class="space-y-4">
                            @foreach($seats as $seat)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="seats[]" value="{{ $seat }}"
                                       class="w-4 h-4 rounded border-zinc-200 dark:border-zinc-800 text-zinc-900 focus:ring-0"
                                       @if(in_array($seat, request('seats', []))) checked @endif>
                                <span class="text-sm text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50 transition-colors">{{ $seat }} Kursi</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Ketersediaan -->
                    <div>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="available" value="1"
                                   class="w-4 h-4 rounded border-zinc-200 dark:border-zinc-800 text-zinc-900 focus:ring-0"
                                   @if(request('available')) checked @endif>
                            <span class="text-sm text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50 transition-colors">Tersedia (belum dibooking)</span>
                        </label>
                    </div>

                    <!-- Tarif Harian -->
                    <div>
                        <h3 class="text-xs font-bold text-zinc-900 dark:text-zinc-50 uppercase tracking-[0.2em] mb-6">Tarif Harian</h3>
                        <div class="flex items-center gap-4">
                            <div class="flex-1">
                                <span class="text-[10px] text-zinc-400 block mb-1">Min (Rp)</span>
                                <input type="number" name="min_price" value="{{ request('min_price') }}"
                                       placeholder="200000" min="0"
                                       class="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-xl px-4 py-2 text-sm outline-none">
                            </div>
                            <div class="flex-1">
                                <span class="text-[10px] text-zinc-400 block mb-1">Maks (Rp)</span>
                                <input type="number" name="max_price" value="{{ request('max_price') }}"
                                       placeholder="500000" min="0"
                                       class="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-xl px-4 py-2 text-sm outline-none">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">
                        Terapkan Filter
                    </button>
                </aside>

                <!-- Konten Utama -->
                <div class="flex-1">
                    <!-- Toolbar -->
                    <div class="flex justify-between items-center mb-10 pb-6 border-b border-zinc-100 dark:border-zinc-800">
                        <p class="text-sm text-zinc-500 font-light">Menampilkan {{ $vehicles->total() }} kendaraan</p>
                        <div class="flex items-center gap-3">
                            <span class="text-xs text-zinc-400">Urutkan:</span>
                            <select name="sort" class="bg-transparent text-sm font-medium text-zinc-900 dark:text-zinc-50 outline-none cursor-pointer"
                                    x-model="sort" @change="document.getElementById('filter-form').submit()">
                                <option value="terbaru">Terbaru</option>
                                <option value="harga_rendah">Harga: Rendah ke Tinggi</option>
                                <option value="harga_tinggi">Harga: Tinggi ke Rendah</option>
                                <option value="populer">Populer</option>
                            </select>
                        </div>
                    </div>

                    <!-- Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                        @forelse($vehicles as $vehicle)
                            <x-vehicle-card :vehicle="$vehicle" />
                        @empty
                            <div class="col-span-full text-center py-12 text-zinc-500">
                                Tidak ada kendaraan yang sesuai dengan filter.
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-20 flex justify-center">
                        {{ $vehicles->links() }}
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout>

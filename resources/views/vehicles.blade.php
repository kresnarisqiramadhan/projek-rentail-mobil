<x-layout>
    <div class="max-w-[1440px] mx-auto pt-8 pb-16 px-6 md:px-12 min-h-screen"
         x-data="{ sort: '{{ request('sort', 'terbaru') }}' }">
        <div class="mb-12">
            <h1 class="text-4xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">{{ __('Our Fleet') }}</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2 max-w-2xl text-lg font-light">{{ __('Explore our curated selection of vehicles for all your travel needs.') }}</p>
        </div>

        <form method="GET" action="{{ route('vehicles') }}" id="filter-form">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Sidebar Filters -->
                <aside class="w-full lg:w-72 flex-shrink-0 bg-white dark:bg-zinc-950 border border-zinc-200/80 dark:border-zinc-800 rounded-3xl p-8 space-y-8 shadow-sm h-fit">
                    <!-- Merk -->
                    <div class="border-b border-zinc-100 dark:border-zinc-900 pb-6">
                        <h3 class="text-xs font-bold text-zinc-900 dark:text-zinc-50 uppercase tracking-[0.2em] mb-4">{{ __('Brand') }}</h3>
                        <div class="space-y-2.5 max-h-56 overflow-y-auto pr-2 custom-scrollbar">
                            @foreach($brands as $brand)
                            <label class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-950 hover:bg-zinc-50 dark:hover:bg-zinc-900/50 cursor-pointer transition-all duration-200 select-none group has-[:checked]:border-zinc-900 dark:has-[:checked]:border-zinc-50 has-[:checked]:bg-zinc-50/50 dark:has-[:checked]:bg-zinc-900/30">
                                <input type="checkbox" name="brand[]" value="{{ $brand }}"
                                       class="w-4 h-4 rounded border-zinc-300 dark:border-zinc-700 text-zinc-900 focus:ring-0 focus:ring-offset-0 cursor-pointer"
                                       @if(in_array($brand, request('brand', []))) checked @endif>
                                <span class="text-sm font-medium text-zinc-600 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-200 group-has-[:checked]:text-zinc-900 dark:group-has-[:checked]:text-zinc-50 transition-colors">{{ $brand }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Jumlah Kursi -->
                    <div class="border-b border-zinc-100 dark:border-zinc-900 pb-6">
                        <h3 class="text-xs font-bold text-zinc-900 dark:text-zinc-50 uppercase tracking-[0.2em] mb-4">{{ __('Seats') }}</h3>
                        <div class="space-y-2.5">
                            @foreach($seats as $seat)
                            <label class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-950 hover:bg-zinc-50 dark:hover:bg-zinc-900/50 cursor-pointer transition-all duration-200 select-none group has-[:checked]:border-zinc-900 dark:has-[:checked]:border-zinc-50 has-[:checked]:bg-zinc-50/50 dark:has-[:checked]:bg-zinc-900/30">
                                <input type="checkbox" name="seats[]" value="{{ $seat }}"
                                       class="w-4 h-4 rounded border-zinc-300 dark:border-zinc-700 text-zinc-900 focus:ring-0 focus:ring-offset-0 cursor-pointer"
                                       @if(in_array($seat, request('seats', []))) checked @endif>
                                <span class="text-sm font-medium text-zinc-600 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-200 group-has-[:checked]:text-zinc-900 dark:group-has-[:checked]:text-zinc-50 transition-colors">{{ $seat }} {{ __('Seats') }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Ketersediaan -->
                    <div class="border-b border-zinc-100 dark:border-zinc-900 pb-6">
                        <label class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-950 hover:bg-zinc-50 dark:hover:bg-zinc-900/50 cursor-pointer transition-all duration-200 select-none group has-[:checked]:border-zinc-900 dark:has-[:checked]:border-zinc-50 has-[:checked]:bg-zinc-50/50 dark:has-[:checked]:bg-zinc-900/30">
                            <input type="checkbox" name="available" value="1"
                                   class="w-4 h-4 rounded border-zinc-300 dark:border-zinc-700 text-zinc-900 focus:ring-0 focus:ring-offset-0 cursor-pointer"
                                   @if(request('available')) checked @endif>
                            <span class="text-sm font-medium text-zinc-600 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-200 group-has-[:checked]:text-zinc-900 dark:group-has-[:checked]:text-zinc-50 transition-colors">{{ __('Available (Not Booked)') }}</span>
                        </label>
                    </div>

                    <!-- Tarif Harian -->
                    <div class="pb-2">
                        <h3 class="text-xs font-bold text-zinc-900 dark:text-zinc-50 uppercase tracking-[0.2em] mb-4">{{ __('Daily Rate') }}</h3>
                        <div class="flex items-center gap-4">
                            <div class="flex-1">
                                <span class="text-[10px] text-zinc-400 uppercase tracking-wider block mb-1.5">{{ __('Min') }}</span>
                                <input type="number" name="min_price" value="{{ request('min_price') }}" min="0" placeholder="Rp"
                                       class="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-zinc-400 dark:focus:border-zinc-700 transition-colors">
                            </div>
                            <div class="flex-1">
                                <span class="text-[10px] text-zinc-400 uppercase tracking-wider block mb-1.5">{{ __('Max') }}</span>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" min="0" placeholder="Rp"
                                       class="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-zinc-400 dark:focus:border-zinc-700 transition-colors">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-semibold rounded-2xl hover:opacity-90 transition-all duration-300 shadow-sm active:scale-[0.98]">
                        {{ __('Apply Filters') }}
                    </button>
                </aside>

                <!-- Konten Utama -->
                <div class="flex-1">
                    <!-- Toolbar -->
                    <div class="flex justify-between items-center mb-10 pb-6 border-b border-zinc-100 dark:border-zinc-800">
                        <p class="text-sm text-zinc-500 font-light">{{ __('Showing') }} {{ $vehicles->total() }} {{ __('vehicles') }}</p>
                        <div class="flex items-center gap-3">
                            <span class="text-xs text-zinc-400">{{ __('Sort By:') }}</span>
                            <select name="sort" class="bg-transparent text-sm font-medium text-zinc-900 dark:text-zinc-50 outline-none cursor-pointer"
                                    x-model="sort" @change="document.getElementById('filter-form').submit()">
                                <option value="terbaru">{{ __('Latest') }}</option>
                                <option value="harga_rendah">{{ __('Price: Low to High') }}</option>
                                <option value="harga_tinggi">{{ __('Price: High to Low') }}</option>
                                <option value="populer">{{ __('Popularity') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                        @forelse($vehicles as $vehicle)
                            <x-vehicle-card :vehicle="$vehicle" />
                        @empty
                            <div class="col-span-full text-center py-12 text-zinc-500">
                                {{ __('No vehicles match the selected filters.') }}
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

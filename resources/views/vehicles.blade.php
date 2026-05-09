<x-layout>
    <div class="max-w-[1440px] mx-auto pt-8 pb-16 px-6 md:px-12 min-h-screen">
        <div class="mb-12">
            <h1 class="text-4xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">The Fleet</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2 max-w-2xl text-lg font-light">Explore our curated collection of the world's most prestigious automobiles.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-72 flex-shrink-0 space-y-10">
                <!-- Categories -->
                <div>
                    <h3 class="text-xs font-bold text-zinc-900 dark:text-zinc-50 uppercase tracking-[0.2em] mb-6">Categories</h3>
                    <div class="space-y-4">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" checked class="w-4 h-4 rounded border-zinc-200 dark:border-zinc-800 text-zinc-900 focus:ring-0">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50 transition-colors">Exotics</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-4 h-4 rounded border-zinc-200 dark:border-zinc-800 text-zinc-900 focus:ring-0">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50 transition-colors">Grand Tourers</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-4 h-4 rounded border-zinc-200 dark:border-zinc-800 text-zinc-900 focus:ring-0">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50 transition-colors">Luxury SUVs</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-4 h-4 rounded border-zinc-200 dark:border-zinc-800 text-zinc-900 focus:ring-0">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50 transition-colors">Vintage Classics</span>
                        </label>
                    </div>
                </div>

                <!-- Price Range -->
                <div>
                    <h3 class="text-xs font-bold text-zinc-900 dark:text-zinc-50 uppercase tracking-[0.2em] mb-6">Daily Rate</h3>
                    <div class="flex items-center gap-4">
                        <div class="flex-1">
                            <span class="text-[10px] text-zinc-400 block mb-1">Min</span>
                            <input type="number" placeholder="$500" class="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-xl px-4 py-2 text-sm outline-none">
                        </div>
                        <div class="flex-1">
                            <span class="text-[10px] text-zinc-400 block mb-1">Max</span>
                            <input type="number" placeholder="$5000" class="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-xl px-4 py-2 text-sm outline-none">
                        </div>
                    </div>
                </div>

                <button class="w-full py-4 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">Apply Filters</button>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1">
                <!-- Utility Bar -->
                <div class="flex justify-between items-center mb-10 pb-6 border-b border-zinc-100 dark:border-zinc-800">
                    <p class="text-sm text-zinc-500 font-light">Showing 24 results</p>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-zinc-400">Sort by:</span>
                        <select class="bg-transparent text-sm font-medium text-zinc-900 dark:text-zinc-50 outline-none cursor-pointer">
                            <option>Latest</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Popularity</option>
                        </select>
                    </div>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @php
                        $mockVehicles = [
                            (object)[
                                'id' => 1,
                                'name' => 'Ferrari F8 Tributo',
                                'class' => 'Sports',
                                'price_per_day' => 2200,
                                'image_url' => 'https://images.unsplash.com/photo-1592198084033-aade902d1aae?auto=format&fit=crop&q=80&w=800',
                                'image_alt' => 'Ferrari F8',
                                'seats' => 2,
                                'acceleration' => '2.9s'
                            ],
                            (object)[
                                'id' => 2,
                                'name' => 'Porsche 911 GT3',
                                'class' => 'Sports',
                                'price_per_day' => 1800,
                                'image_url' => 'https://images.unsplash.com/photo-1614165933388-9b552e8b0b14?auto=format&fit=crop&q=80&w=800',
                                'image_alt' => 'Porsche 911',
                                'seats' => 2,
                                'acceleration' => '3.2s'
                            ],
                            (object)[
                                'id' => 3,
                                'name' => 'Range Rover Autobiography',
                                'class' => 'Luxury SUV',
                                'price_per_day' => 890,
                                'image_url' => 'https://images.unsplash.com/photo-1541899481282-d53bffe3c15d?auto=format&fit=crop&q=80&w=800',
                                'image_alt' => 'Range Rover',
                                'seats' => 5,
                                'acceleration' => '5.4s',
                                'luggage' => 4
                            ],
                            (object)[
                                'id' => 4,
                                'name' => 'Lamborghini Huracán',
                                'class' => 'Exotic',
                                'price_per_day' => 2500,
                                'image_url' => 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&q=80&w=800',
                                'image_alt' => 'Lamborghini',
                                'seats' => 2,
                                'acceleration' => '3.0s'
                            ],
                            (object)[
                                'id' => 5,
                                'name' => 'Mercedes-Benz S-Class',
                                'class' => 'Executive',
                                'price_per_day' => 650,
                                'image_url' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&q=80&w=800',
                                'image_alt' => 'Mercedes S-Class',
                                'seats' => 5,
                                'acceleration' => '4.8s'
                            ],
                            (object)[
                                'id' => 6,
                                'name' => 'Bentley Continental GT',
                                'class' => 'Grand Tourer',
                                'price_per_day' => 1500,
                                'image_url' => 'https://images.unsplash.com/photo-1621135802920-133df287f89c?auto=format&fit=crop&q=80&w=800',
                                'image_alt' => 'Bentley',
                                'seats' => 4,
                                'acceleration' => '3.6s'
                            ]
                        ];
                    @endphp

                    @foreach($mockVehicles as $vehicle)
                        <x-vehicle-card :vehicle="$vehicle" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-20 flex justify-center">
                    <div class="flex items-center gap-2">
                        <button class="w-10 h-10 flex items-center justify-center rounded-full border border-zinc-100 dark:border-zinc-800 text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                        <button class="w-10 h-10 flex items-center justify-center rounded-full bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium">1</button>
                        <button class="w-10 h-10 flex items-center justify-center rounded-full border border-zinc-100 dark:border-zinc-800 text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors text-sm font-medium">2</button>
                        <button class="w-10 h-10 flex items-center justify-center rounded-full border border-zinc-100 dark:border-zinc-800 text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors text-sm font-medium">3</button>
                        <button class="w-10 h-10 flex items-center justify-center rounded-full border border-zinc-100 dark:border-zinc-800 text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

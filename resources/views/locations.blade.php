<x-layout>
    <div class="max-w-[1440px] mx-auto pt-16 pb-32 px-6 md:px-12 min-h-screen">
        <div class="mb-20">
            <h1 class="text-5xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight mb-4">{{ __('Our Locations') }}</h1>
            <p class="text-zinc-500 dark:text-zinc-400 text-xl font-light max-w-2xl">{{ __('LuxeDrive operates in major global hubs, providing seamless luxury transportation wherever you land.') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            <div class="group cursor-pointer">
                <div class="aspect-[16/10] bg-zinc-100 dark:bg-zinc-800 rounded-3xl overflow-hidden mb-6 relative">
                    <img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&q=80&w=800" alt="Dubai" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <h3 class="text-2xl font-bold text-white">Dubai</h3>
                        <p class="text-white/80 text-sm font-light">Downtown & International Airport</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-zinc-500 dark:text-zinc-400">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        <span class="text-sm font-light">Sheikh Zayed Road, Dubai, UAE</span>
                    </div>
                    <div class="flex items-center gap-3 text-zinc-500 dark:text-zinc-400">
                        <span class="material-symbols-outlined text-sm">schedule</span>
                        <span class="text-sm font-light">Open 24/7</span>
                    </div>
                </div>
            </div>

            <div class="group cursor-pointer">
                <div class="aspect-[16/10] bg-zinc-100 dark:bg-zinc-800 rounded-3xl overflow-hidden mb-6 relative">
                    <img src="https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&q=80&w=800" alt="Paris" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <h3 class="text-2xl font-bold text-white">Paris</h3>
                        <p class="text-white/80 text-sm font-light">Champs-Élysées & Charles de Gaulle</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-zinc-500 dark:text-zinc-400">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        <span class="text-sm font-light">Avenue Montaigne, Paris, France</span>
                    </div>
                    <div class="flex items-center gap-3 text-zinc-500 dark:text-zinc-400">
                        <span class="material-symbols-outlined text-sm">schedule</span>
                        <span class="text-sm font-light">08:00 - 22:00</span>
                    </div>
                </div>
            </div>

            <div class="group cursor-pointer">
                <div class="aspect-[16/10] bg-zinc-100 dark:bg-zinc-800 rounded-3xl overflow-hidden mb-6 relative">
                    <img src="https://images.unsplash.com/photo-1534430480872-3498386e7a56?auto=format&fit=crop&q=80&w=800" alt="New York" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <h3 class="text-2xl font-bold text-white">New York</h3>
                        <p class="text-white/80 text-sm font-light">Manhattan & JFK International</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-zinc-500 dark:text-zinc-400">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        <span class="text-sm font-light">5th Avenue, Manhattan, NY, USA</span>
                    </div>
                    <div class="flex items-center gap-3 text-zinc-500 dark:text-zinc-400">
                        <span class="material-symbols-outlined text-sm">schedule</span>
                        <span class="text-sm font-light">Open 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

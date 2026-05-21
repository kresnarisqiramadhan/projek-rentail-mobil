<x-profile-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">{{ __('Favorite Vehicles') }}</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">{{ __("Vehicles you've saved for later.") }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Car Card 1 -->
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden group shadow-sm hover:shadow-xl transition-all duration-500">
            <div class="relative h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?q=80&w=2000&auto=format&fit=crop" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Car">
                <button class="absolute top-4 right-4 w-10 h-10 bg-white/90 dark:bg-zinc-900/90 rounded-full flex items-center justify-center text-rose-500 shadow-lg backdrop-blur-sm">
                    <span class="material-symbols-outlined">favorite</span>
                </button>
            </div>
            <div class="p-6">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-zinc-900 dark:text-zinc-50">BMW M4 Competition</h3>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[10px] text-amber-400">star</span>
                        <span class="text-[10px] font-bold text-zinc-900 dark:text-zinc-50">4.9</span>
                    </div>
                </div>
                <div class="text-xs text-zinc-500 mb-6 italic uppercase tracking-wider">Coupe • Alpine White</div>
                <div class="flex items-center justify-between mt-auto pt-4 border-t border-zinc-50 dark:border-zinc-800">
                    <div>
                        <div class="text-sm font-black text-zinc-900 dark:text-zinc-50 italic">Rp8.500.000</div>
                        <div class="text-[8px] font-bold text-zinc-400 uppercase tracking-tighter">Per Hari</div>
                    </div>
                    <a href="{{ route('vehicles') }}" class="px-4 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-[10px] font-black uppercase rounded-lg hover:opacity-90 transition-opacity">Sewa Sekarang</a>
                </div>
            </div>
        </div>

        <!-- Car Card 2 -->
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden group shadow-sm hover:shadow-xl transition-all duration-500">
            <div class="relative h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?q=80&w=2000&auto=format&fit=crop" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Car">
                <button class="absolute top-4 right-4 w-10 h-10 bg-white/90 dark:bg-zinc-900/90 rounded-full flex items-center justify-center text-rose-500 shadow-lg backdrop-blur-sm">
                    <span class="material-symbols-outlined">favorite</span>
                </button>
            </div>
            <div class="p-6">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-zinc-900 dark:text-zinc-50">Audi RS7 Sportback</h3>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[10px] text-amber-400">star</span>
                        <span class="text-[10px] font-bold text-zinc-900 dark:text-zinc-50">5.0</span>
                    </div>
                </div>
                <div class="text-xs text-zinc-500 mb-6 italic uppercase tracking-wider">Sedan • Nardo Grey</div>
                <div class="flex items-center justify-between mt-auto pt-4 border-t border-zinc-50 dark:border-zinc-800">
                    <div>
                        <div class="text-sm font-black text-zinc-900 dark:text-zinc-50 italic">Rp9.200.000</div>
                        <div class="text-[8px] font-bold text-zinc-400 uppercase tracking-tighter">Per Hari</div>
                    </div>
                    <a href="{{ route('vehicles') }}" class="px-4 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-[10px] font-black uppercase rounded-lg hover:opacity-90 transition-opacity">Sewa Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</x-profile-layout>

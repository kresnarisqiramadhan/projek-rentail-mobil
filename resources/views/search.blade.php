<x-layout>
    <div class="max-w-[1440px] mx-auto pt-16 pb-32 px-6 md:px-12 min-h-screen">
        <div class="max-w-3xl mx-auto mb-20 text-center">
            <h1 class="text-4xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight mb-8">{{ __('Search the Fleet') }}</h1>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-6 top-1/2 -translate-y-1/2 text-zinc-400 group-focus-within:text-zinc-900 dark:group-focus-within:text-zinc-50 transition-colors">search</span>
                <input type="text" autofocus placeholder="Search by model, brand, or category..." class="w-full h-16 bg-zinc-50 dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-3xl pl-16 pr-6 text-lg outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all shadow-sm">
            </div>
        </div>

        <div>
            <div class="flex justify-between items-center mb-10 pb-4 border-b border-zinc-100 dark:border-zinc-800">
                <h2 class="text-xl font-medium text-zinc-900 dark:text-zinc-50">{{ __('Popular Searches') }}</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="#" class="p-4 bg-zinc-50 dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 text-center hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                    <span class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Lamborghini</span>
                </a>
                <a href="#" class="p-4 bg-zinc-50 dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 text-center hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                    <span class="text-sm font-medium text-zinc-900 dark:text-zinc-50">{{ __('Convertible') }}</span>
                </a>
                <a href="#" class="p-4 bg-zinc-50 dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 text-center hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                    <span class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Ferrari</span>
                </a>
                <a href="#" class="p-4 bg-zinc-50 dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 text-center hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                    <span class="text-sm font-medium text-zinc-900 dark:text-zinc-50">{{ __('SUV') }}</span>
                </a>
            </div>
        </div>
    </div>
</x-layout>

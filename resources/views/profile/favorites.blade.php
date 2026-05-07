<x-profile-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Favorite Vehicles</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Vehicles you've saved for later.</p>
    </div>

    <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden">
        <div class="p-12 text-center">
            <div class="w-16 h-16 bg-zinc-50 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-zinc-300">favorite</span>
            </div>
            <h3 class="text-zinc-900 dark:text-zinc-50 font-medium mb-1">No favorites yet</h3>
            <p class="text-zinc-500 text-sm font-light mb-6">Tap the heart icon on any vehicle to save it here.</p>
            <a href="{{ route('vehicles') }}" class="inline-flex px-6 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">
                Browse Fleet
            </a>
        </div>
    </section>
</x-profile-layout>

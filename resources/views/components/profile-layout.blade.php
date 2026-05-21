<x-layout>
    <div class="max-w-[1440px] mx-auto pt-8 min-h-screen">
        <div class="flex flex-col md:flex-row gap-8 px-6 md:px-12">
            <!-- Sidebar -->
            <aside class="w-full md:w-64 flex-shrink-0">
                <div class="bg-zinc-900 rounded-2xl p-6 mb-6">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-full bg-zinc-800 flex items-center justify-center overflow-hidden border border-zinc-700">
                            <span class="material-symbols-outlined text-zinc-400 text-2xl">person</span>
                        </div>
                        <div>
                            <div class="text-white font-semibold">{{ auth()->user()->name }}</div>
                            <div class="text-zinc-500 text-xs">{{ auth()->user()->isAdmin() ? 'Administrator' : 'Pelanggan' }}</div>
                        </div>
                    </div>
                    <nav class="space-y-1">
                        <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('profile') ? 'bg-zinc-800 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }} rounded-xl transition-colors">
                            <span class="material-symbols-outlined text-sm">dashboard</span>
                            <span class="text-sm font-medium">Dasbor</span>
                        </a>
                        <a href="{{ route('profile.rentals') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('profile.rentals') ? 'bg-zinc-800 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }} rounded-xl transition-colors">
                            <span class="material-symbols-outlined text-sm">history</span>
                            <span class="text-sm font-medium">Riwayat Sewa</span>
                        </a>
                        <a href="{{ route('profile.favorites') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('profile.favorites') ? 'bg-zinc-800 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }} rounded-xl transition-colors">
                            <span class="material-symbols-outlined text-sm">favorite</span>
                            <span class="text-sm font-medium">Favorit</span>
                        </a>
                        <a href="{{ route('profile.settings') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('profile.settings') ? 'bg-zinc-800 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }} rounded-xl transition-colors">
                            <span class="material-symbols-outlined text-sm">settings</span>
                            <span class="text-sm font-medium">Pengaturan</span>
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-layout>

<x-layout>
    <div class="max-w-[1440px] mx-auto pt-8 min-h-screen">
        <div class="flex flex-col md:flex-row gap-8 px-6 md:px-12">
            <aside class="w-full md:w-64 flex-shrink-0">
                <div class="bg-zinc-900 rounded-2xl p-6 mb-6">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-full bg-zinc-800 flex items-center justify-center overflow-hidden border border-zinc-700">
                            <span class="material-symbols-outlined text-zinc-400 text-2xl">admin_panel_settings</span>
                        </div>
                        <div>
                            <div class="text-white font-semibold">{{ auth()->user()->name }}</div>
                            <div class="text-zinc-500 text-xs">Administrator</div>
                        </div>
                    </div>
                    <nav class="space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-zinc-800 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }} rounded-xl transition-colors">
                            <span class="material-symbols-outlined text-sm">dashboard</span>
                            <span class="text-sm font-medium">Dashboard</span>
                        </a>
                        <a href="{{ route('admin.vehicles.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.vehicles.*') ? 'bg-zinc-800 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }} rounded-xl transition-colors">
                            <span class="material-symbols-outlined text-sm">directions_car</span>
                            <span class="text-sm font-medium">Kendaraan</span>
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.orders.*') ? 'bg-zinc-800 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }} rounded-xl transition-colors">
                            <span class="material-symbols-outlined text-sm">receipt_long</span>
                            <span class="text-sm font-medium">Pesanan</span>
                        </a>
                        <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.reports.*') ? 'bg-zinc-800 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }} rounded-xl transition-colors">
                            <span class="material-symbols-outlined text-sm">monitoring</span>
                            <span class="text-sm font-medium">Laporan</span>
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.settings.*') ? 'bg-zinc-800 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-800' }} rounded-xl transition-colors">
                            <span class="material-symbols-outlined text-sm">settings</span>
                            <span class="text-sm font-medium">Pengaturan</span>
                        </a>
                    </nav>
                </div>
            </aside>

            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-layout>

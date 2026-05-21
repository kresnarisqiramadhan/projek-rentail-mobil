<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Pengaturan</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Konfigurasi sistem.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-8 max-w-xl space-y-6">
        @csrf
        <p class="text-zinc-500 text-sm">Pengaturan umum akan tersedia di sini. Untuk saat ini, silakan konfigurasi melalui file <code>.env</code>.</p>
        <button type="submit" class="px-8 py-3 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">Simpan</button>
    </form>
</x-admin-layout>

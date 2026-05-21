<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Kelola Kendaraan</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-1">Daftar semua kendaraan yang tersedia dalam armada.</p>
        </div>
        <a href="{{ route('admin.vehicles.create') }}" class="px-6 py-3 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">
            + Tambah Kendaraan
        </a>
    </div>

    <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-zinc-500 dark:text-zinc-400">
                <thead class="text-xs uppercase bg-zinc-50 dark:bg-zinc-800 text-zinc-400">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Merk</th>
                        <th class="px-6 py-4">Model</th>
                        <th class="px-6 py-4">Tahun</th>
                        <th class="px-6 py-4">Plat</th>
                        <th class="px-6 py-4">Harga/hari</th>
                        <th class="px-6 py-4">Kursi</th>
                        <th class="px-6 py-4">Aktif</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                    @forelse($vehicles as $vehicle)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                        <td class="px-6 py-4 font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->name }}</td>
                        <td class="px-6 py-4">{{ $vehicle->brand }}</td>
                        <td class="px-6 py-4">{{ $vehicle->model }}</td>
                        <td class="px-6 py-4">{{ $vehicle->year ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $vehicle->plate_number }}</td>
                        <td class="px-6 py-4">Rp{{ number_format($vehicle->price_per_day, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $vehicle->seats }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $vehicle->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                                {{ $vehicle->is_active ? 'Ya' : 'Tidak' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('admin.vehicles.show', $vehicle) }}" class="text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors material-symbols-outlined text-lg">visibility</a>
                            <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors material-symbols-outlined text-lg">edit</a>
                            <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transition-colors material-symbols-outlined text-lg">delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-12 text-center text-zinc-500">Belum ada kendaraan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6">
            {{ $vehicles->links() }}
        </div>
    </section>
</x-admin-layout>

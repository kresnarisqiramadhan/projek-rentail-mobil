<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">{{ $vehicle->name }}</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-1">{{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->year ?? '-' }})</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="px-4 py-2 border border-zinc-200 dark:border-zinc-700 rounded-xl text-sm font-medium hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">Edit</a>
            <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                @csrf @method('DELETE')
                <button type="submit" class="px-4 py-2 border border-red-200 text-red-600 rounded-xl text-sm font-medium hover:bg-red-50 transition-colors">Hapus</button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="space-y-8">
            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
                <h3 class="font-semibold text-zinc-900 dark:text-zinc-50 mb-4">Informasi Kendaraan</h3>
                <dl class="grid grid-cols-2 gap-4">
                    <div>
                        <dt class="text-xs text-zinc-500">Merk</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->brand }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Model</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->model }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Tahun</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->year ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Tipe</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->type }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Plat Nomor</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->plate_number }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Jumlah Kursi</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->seats }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Harga per Hari</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">Rp{{ number_format($vehicle->price_per_day, 0, ',', '.') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-zinc-500">Status</dt>
                        <dd>
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $vehicle->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                                {{ $vehicle->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </dd>
                    </div>
                    <div class="col-span-2">
                        <dt class="text-xs text-zinc-500">Kondisi</dt>
                        <dd class="font-medium text-zinc-900 dark:text-zinc-50">{{ $vehicle->condition ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        <div class="space-y-8">
            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
                <h3 class="font-semibold text-zinc-900 dark:text-zinc-50 mb-4">Foto</h3>
                @if($vehicle->photos->isNotEmpty())
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($vehicle->photos as $photo)
                            <img src="{{ asset('storage/' . $photo->path) }}" class="rounded-xl object-cover h-32 w-full bg-zinc-100">
                        @endforeach
                    </div>
                @else
                    <p class="text-zinc-500 text-sm">Belum ada foto.</p>
                @endif
            </div>
            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
                <h3 class="font-semibold text-zinc-900 dark:text-zinc-50 mb-4">Rating & Ulasan</h3>
                <p class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">{{ number_format($vehicle->avg_rating, 1) }} <span class="text-sm font-normal text-zinc-500">/ 5</span></p>
                <p class="text-sm text-zinc-500">Dari {{ $vehicle->ratings->count() }} ulasan</p>
            </div>
        </div>
    </div>
</x-admin-layout>

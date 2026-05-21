<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Tambah Kendaraan</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Masukkan data kendaraan baru.</p>
    </div>

    <form action="{{ route('admin.vehicles.store') }}" method="POST" class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-8 max-w-2xl space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Merk</label>
                <input type="text" name="brand" value="{{ old('brand') }}" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50">
            </div>
            <div>
                <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Model</label>
                <input type="text" name="model" value="{{ old('model') }}" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50">
            </div>
            <div>
                <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Tahun</label>
                <input type="number" name="year" value="{{ old('year') }}" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50">
            </div>
            <div>
                <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Tipe</label>
                <select name="type" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50">
                    <option value="">Pilih Tipe</option>
                    @foreach(['MPV', 'SUV', 'Sedan', 'Hatchback', 'Pickup'] as $type)
                        <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Plat Nomor</label>
                <input type="text" name="plate_number" value="{{ old('plate_number') }}" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50">
                @error('plate_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Harga per Hari (Rp)</label>
                <input type="number" name="price_per_day" value="{{ old('price_per_day') }}" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50">
                @error('price_per_day') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Jumlah Kursi</label>
                <input type="number" name="seats" value="{{ old('seats', 5) }}" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50">
                @error('seats') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Kondisi</label>
                <textarea name="condition" rows="2" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50">{{ old('condition') }}</textarea>
            </div>
            <div class="md:col-span-2 flex items-center gap-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }} class="rounded border-zinc-300 text-zinc-900 focus:ring-0">
                    <span class="text-sm text-zinc-700 dark:text-zinc-300">Aktif</span>
                </label>
            </div>
        </div>
        <div class="pt-4">
            <button type="submit" class="px-8 py-3 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">Simpan</button>
            <a href="{{ route('admin.vehicles.index') }}" class="px-4 py-2 text-sm text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors ml-4">Batal</a>
        </div>
    </form>
</x-admin-layout>

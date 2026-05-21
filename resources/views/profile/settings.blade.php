<x-profile-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Pengaturan Akun</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Kelola preferensi akun dan keamanan Anda.</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <div class="xl:col-span-2 space-y-8">
            <!-- Profile Information -->
            <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-zinc-900 dark:text-zinc-50 uppercase tracking-widest mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-zinc-900 dark:bg-zinc-50"></span>
                    Informasi Profil
                </h3>
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                            <input type="text" value="{{ $user->name }}" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm text-zinc-900 dark:text-zinc-50 outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-1">Alamat Email</label>
                            <input type="email" value="{{ $user->email }}" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm text-zinc-400 outline-none cursor-not-allowed" readonly>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-zinc-50 dark:border-zinc-800">
                        <button type="button" class="px-8 py-3 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-xs font-bold rounded-xl hover:opacity-90 transition-opacity">Perbarui Profil</button>
                    </div>
                </form>
            </section>

            <!-- Verification / KYC -->
            <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-zinc-900 dark:text-zinc-50 uppercase tracking-widest mb-2 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Dokumen Verifikasi
                </h3>
                <p class="text-xs text-zinc-500 mb-6 font-light italic">Diperlukan untuk memesan kendaraan premium.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 border-2 border-dashed border-zinc-100 dark:border-zinc-800 rounded-2xl bg-zinc-50/50 dark:bg-zinc-800/20 text-center group cursor-pointer hover:border-zinc-900 dark:hover:border-zinc-50 transition-colors">
                        <span class="material-symbols-outlined text-3xl text-zinc-300 dark:text-zinc-600 mb-3 group-hover:scale-110 transition-transform">badge</span>
                        <div class="text-xs font-bold text-zinc-900 dark:text-zinc-50 mb-1 italic">Kartu Identitas (KTP)</div>
                        <div class="mt-4 text-[10px] font-black uppercase text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-400 px-3 py-1 rounded-full w-fit mx-auto">Terverifikasi</div>
                    </div>
                    
                    <div class="p-6 border-2 border-dashed border-zinc-100 dark:border-zinc-800 rounded-2xl bg-zinc-50/50 dark:bg-zinc-800/20 text-center group cursor-pointer hover:border-zinc-900 dark:hover:border-zinc-50 transition-colors">
                        <span class="material-symbols-outlined text-3xl text-zinc-300 dark:text-zinc-600 mb-3 group-hover:scale-110 transition-transform">license</span>
                        <div class="text-xs font-bold text-zinc-900 dark:text-zinc-50 mb-1 italic">Surat Izin Mengemudi (SIM A)</div>
                        <div class="mt-4 text-[10px] font-black uppercase text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-400 px-3 py-1 rounded-full w-fit mx-auto">Terverifikasi</div>
                    </div>
                </div>
            </section>
        </div>

        <div class="space-y-8">
            <!-- Security Section -->
            <section class="bg-zinc-900 dark:bg-zinc-850 rounded-3xl p-8 text-white shadow-xl">
                <h3 class="text-xs font-bold uppercase tracking-widest mb-8 opacity-50 italic">Keamanan</h3>
                <div class="space-y-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-bold italic mb-1 uppercase">Otentikasi Dua Faktor</div>
                            <div class="text-[10px] opacity-60">Sangat Direkomendasikan</div>
                        </div>
                        <button class="w-10 h-5 bg-zinc-700 dark:bg-zinc-650 rounded-full relative transition-colors">
                            <span class="absolute right-1 top-1 w-3 h-3 bg-white rounded-full"></span>
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-bold italic mb-1 uppercase">Kata Sandi</div>
                            <div class="text-[10px] opacity-60 italic">Diperbarui baru-baru ini</div>
                        </div>
                        <button class="text-[10px] font-black uppercase underline underline-offset-4">Ubah</button>
                    </div>
                </div>
                
                <div class="mt-12 pt-12 border-t border-white/10">
                    <button class="w-full py-4 border border-white/20 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-white/5 transition-colors">Putuskan Semua Sesi</button>
                </div>
            </section>
            
            <!-- Danger Zone -->
            <section class="bg-rose-50 dark:bg-rose-950/10 border border-rose-100 dark:border-rose-900/30 rounded-2xl p-6">
                <h3 class="text-xs font-bold text-rose-900 dark:text-rose-400 uppercase tracking-widest mb-4 italic">Zona Bahaya</h3>
                <p class="text-[10px] text-rose-700 dark:text-rose-300 mb-6 font-medium leading-relaxed">Menghapus akun Anda bersifat permanen. Semua poin dan riwayat sewa Anda akan dihapus secara permanen.</p>
                <button class="w-full py-3 bg-white dark:bg-zinc-900 border border-rose-200 dark:border-rose-800 text-rose-600 dark:text-rose-400 text-[10px] font-black uppercase rounded-xl hover:bg-rose-600 dark:hover:bg-rose-500 hover:text-white dark:hover:text-white transition-all">Hapus Akun</button>
            </section>
        </div>
    </div>
</x-profile-layout>

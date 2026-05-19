<footer class="bg-zinc-50 dark:bg-zinc-950 full-width py-16 border-t border-zinc-100 dark:border-zinc-900">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 px-6 md:px-12 max-w-[1440px] mx-auto text-xs font-light tracking-wide text-zinc-500 dark:text-zinc-400">
        
        <!-- Brand & Kontak -->
        <div class="col-span-1 sm:col-span-2 lg:col-span-1 space-y-4">
            <a href="{{ route('home') }}" class="text-xl font-bold tracking-tighter text-zinc-900 dark:text-zinc-50">LuxeDrive</a>
            <p class="max-w-xs leading-relaxed">
                Solusi sewa mobil terpercaya di Indonesia. Armada lengkap, harga transparan, pelayanan profesional.
            </p>
            <div class="space-y-2 pt-2">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">location_on</span>
                    <span>Jl. Raya Bogor No. 88, Jakarta Timur</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">call</span>
                    <span>+62 21 1234 5678</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">mail</span>
                    <span>halo@rentalmobil.id</span>
                </div>
            </div>
        </div>

        <!-- Layanan -->
        <div>
            <h4 class="text-zinc-900 dark:text-zinc-50 font-medium mb-4 uppercase tracking-widest text-[10px]">Layanan</h4>
            <ul class="space-y-3">
                <li><a href="{{ route('vehicles') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Armada Kami</a></li>
                <li><a href="{{ route('experience') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Pengalaman</a></li>
                <li><a href="{{ route('locations') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Lokasi</a></li>
                <li><a href="{{ route('terms') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Syarat & Ketentuan</a></li>
            </ul>
        </div>

        <!-- Bantuan -->
        <div>
            <h4 class="text-zinc-900 dark:text-zinc-50 font-medium mb-4 uppercase tracking-widest text-[10px]">Bantuan</h4>
            <ul class="space-y-3">
                <li><a href="{{ route('support') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Pusat Bantuan</a></li>
                <li><a href="{{ route('faq') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">FAQ</a></li>
                <li><a href="{{ route('privacy') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Kebijakan Privasi</a></li>
                <li><a href="{{ route('terms') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Syarat Layanan</a></li>
            </ul>
        </div>

        <!-- Ikuti Kami -->
        <div>
            <h4 class="text-zinc-900 dark:text-zinc-50 font-medium mb-4 uppercase tracking-widest text-[10px]">Ikuti Kami</h4>
            <ul class="space-y-3">
                <li><a href="#" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Instagram</a></li>
                <li><a href="#" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Facebook</a></li>
                <li><a href="#" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">TikTok</a></li>
                <li><a href="https://wa.me/6281281120360" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">WhatsApp</a></li>
            </ul>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="max-w-[1440px] mx-auto px-6 md:px-12 mt-12 pt-6 border-t border-zinc-100 dark:border-zinc-800 text-center text-[10px] text-zinc-400 dark:text-zinc-500 uppercase tracking-widest">
        © {{ date('Y') }} Rental Mobil Indonesia. Seluruh hak cipta dilindungi.
    </div>
</footer>

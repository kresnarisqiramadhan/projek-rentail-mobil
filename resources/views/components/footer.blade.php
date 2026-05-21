<footer class="bg-zinc-950 full-width pt-28 pb-16 border-t border-zinc-900 text-zinc-400 mt-20">
    <div class="relative max-w-[1440px] mx-auto px-6 md:px-12">
        <!-- Overlapping Car Image (Aligned to Right, above Hubungi) -->
        <div class="absolute -top-60 right-6 md:right-12 w-full max-w-[360px] z-10 pointer-events-none hidden md:block">
            <img src="{{ asset('car_footer.png') }}" alt="Luxury Car"
                class="w-full h-auto object-contain drop-shadow-[0_20px_35px_rgba(0,0,0,0.7)]">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 text-xs font-light tracking-wide">

            <!-- Brand & Kontak -->
            <div class="col-span-1 sm:col-span-2 lg:col-span-1 space-y-4">
                <a href="{{ route('home') }}" class="text-xl font-bold tracking-tighter text-white">LuxeDrive</a>
                <p class="max-w-xs leading-relaxed text-zinc-400">
                    Solusi sewa mobil terpercaya di Indonesia. Armada lengkap, harga transparan, pelayanan profesional.
                </p>
                <div class="space-y-2 pt-2 text-zinc-400">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-base text-zinc-300">location_on</span>
                        <span>Jl. Raya Bogor No. 88, Jakarta Timur</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-base text-zinc-300">call</span>
                        <span>+62 21 1234 5678</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-base text-zinc-300">mail</span>
                        <span>halo@rentalmobil.id</span>
                    </div>
                </div>
            </div>

            <!-- Layanan -->
            <div>
                <h4 class="text-white font-medium mb-4 uppercase tracking-widest text-[10px]">Layanan</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('vehicles') }}" class="hover:text-white transition-colors">Armada Kami</a>
                    </li>
                    <li><a href="{{ route('experience') }}" class="hover:text-white transition-colors">Pengalaman</a>
                    </li>
                    <li><a href="{{ route('locations') }}" class="hover:text-white transition-colors">Lokasi</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                    </li>
                </ul>
            </div>

            <!-- Bantuan -->
            <div>
                <h4 class="text-white font-medium mb-4 uppercase tracking-widest text-[10px]">Bantuan</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('support') }}" class="hover:text-white transition-colors">Pusat Bantuan</a>
                    </li>
                    <li><a href="{{ route('faq') }}" class="hover:text-white transition-colors">FAQ</a></li>
                    <li><a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Kebijakan
                            Privasi</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-white transition-colors">Syarat Layanan</a>
                    </li>
                </ul>
            </div>

            <!-- Hubungi & Follow -->
            <div class="space-y-6">
                <div>
                    <h4 class="text-white font-medium mb-2 uppercase tracking-widest text-[10px]">Hubungi:</h4>
                    <p class="text-zinc-550 text-xs mb-1">Let's Booking</p>
                    <a href="https://wa.me/628111279897" target="_blank"
                        class="text-lg font-bold text-white hover:text-green-400 transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5 fill-current text-green-500" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.966a9.9 9.9 0 0 0-6.98-2.879C5.836 2.16 1.41 6.53 1.406 11.96c-.002 1.674.437 3.313 1.272 4.727L1.625 21.6l5.022-1.446zm12.515-5.551c-.328-.164-1.94-.959-2.241-1.07-.301-.11-.521-.164-.74.164-.219.329-.849 1.07-1.041 1.29-.192.219-.384.246-.712.082-1.321-.661-2.247-1.161-3.155-2.721-.24-.413.24-.383.687-1.278.075-.15.038-.282-.019-.397-.058-.114-.521-1.255-.713-1.72-.188-.454-.379-.393-.521-.4h-.445c-.15 0-.397.056-.604.282-.206.227-.788.771-.788 1.88 0 1.11.808 2.18.92 2.333.111.152 1.588 2.426 3.848 3.399.537.23 1.01.382 1.356.491.54.172 1.03.148 1.418.09.432-.064 1.94-.793 2.214-1.56.274-.767.274-1.422.192-1.56-.082-.138-.301-.219-.63-.383z" />
                        </svg>
                        0811-1279-897
                    </a>
                </div>

                <div class="space-y-2">
                    <h4 class="text-white font-medium uppercase tracking-widest text-[10px]">Follow:</h4>
                    <p class="text-zinc-500 text-[11px]">Ikuti sosial media kami</p>
                    <div class="flex items-center gap-3 pt-1 text-zinc-400">
                        <a href="#" class="hover:text-white transition-colors">Instagram</a>
                        <span>•</span>
                        <a href="#" class="hover:text-white transition-colors">Facebook</a>
                        <span>•</span>
                        <a href="#" class="hover:text-white transition-colors">TikTok</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div
        class="max-w-[1440px] mx-auto px-6 md:px-12 mt-12 pt-6 border-t border-zinc-900 text-center text-[10px] text-zinc-300 uppercase tracking-widest">
        © {{ date('Y') }} Rental Mobil Indonesia. Seluruh hak cipta dilindungi.
    </div>
</footer>
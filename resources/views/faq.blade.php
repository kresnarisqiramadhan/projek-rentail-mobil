<x-layout>
    <div class="max-w-4xl mx-auto py-16 px-6 md:px-12 min-h-screen">
        <h1 class="text-4xl font-display font-bold text-zinc-900 dark:text-zinc-50 mb-8">Pertanyaan Umum (FAQ)</h1>
        <div class="space-y-8 text-zinc-600 dark:text-zinc-400">

            <div x-data="{ open: false }" class="border-b border-zinc-100 dark:border-zinc-800 pb-6">
                <button @click="open = !open" class="flex justify-between items-center w-full text-left">
                    <span class="text-xl font-medium text-zinc-900 dark:text-zinc-50">Apa syarat untuk menyewa mobil?</span>
                    <span class="material-symbols-outlined" x-text="open ? 'expand_less' : 'expand_more'"></span>
                </button>
                <p x-show="open" x-collapse class="mt-4">Penyewa minimal berusia 21 tahun, memiliki SIM A aktif, serta menyerahkan fotokopi KTP/SIM saat pengambilan mobil.</p>
            </div>

            <div x-data="{ open: false }" class="border-b border-zinc-100 dark:border-zinc-800 pb-6">
                <button @click="open = !open" class="flex justify-between items-center w-full text-left">
                    <span class="text-xl font-medium text-zinc-900 dark:text-zinc-50">Bagaimana cara melakukan pemesanan?</span>
                    <span class="material-symbols-outlined" x-text="open ? 'expand_less' : 'expand_more'"></span>
                </button>
                <p x-show="open" x-collapse class="mt-4">Pilih kendaraan dari Armada kami, tentukan tanggal sewa, lengkapi data diri, pilih metode pembayaran, dan selesaikan pembayaran. Anda akan menerima konfirmasi melalui email dan dashboard.</p>
            </div>

            <div x-data="{ open: false }" class="border-b border-zinc-100 dark:border-zinc-800 pb-6">
                <button @click="open = !open" class="flex justify-between items-center w-full text-left">
                    <span class="text-xl font-medium text-zinc-900 dark:text-zinc-50">Metode pembayaran apa saja yang tersedia?</span>
                    <span class="material-symbols-outlined" x-text="open ? 'expand_less' : 'expand_more'"></span>
                </button>
                <p x-show="open" x-collapse class="mt-4">Kami menerima transfer bank (BCA, Mandiri, BRI) dan pembayaran QRIS (GoPay, OVO, ShopeePay, DANA).</p>
            </div>

            <div x-data="{ open: false }" class="border-b border-zinc-100 dark:border-zinc-800 pb-6">
                <button @click="open = !open" class="flex justify-between items-center w-full text-left">
                    <span class="text-xl font-medium text-zinc-900 dark:text-zinc-50">Apakah bisa membatalkan pesanan?</span>
                    <span class="material-symbols-outlined" x-text="open ? 'expand_less' : 'expand_more'"></span>
                </button>
                <p x-show="open" x-collapse class="mt-4">Pesanan dapat dibatalkan sebelum 24 jam dari waktu mulai sewa. Pembatalan kurang dari 24 jam tidak dapat dikembalikan. Proses refund memakan waktu 3-7 hari kerja.</p>
            </div>

            <div x-data="{ open: false }" class="border-b border-zinc-100 dark:border-zinc-800 pb-6">
                <button @click="open = !open" class="flex justify-between items-center w-full text-left">
                    <span class="text-xl font-medium text-zinc-900 dark:text-zinc-50">Bagaimana jika mobil mengalami kerusakan di jalan?</span>
                    <span class="material-symbols-outlined" x-text="open ? 'expand_less' : 'expand_more'"></span>
                </button>
                <p x-show="open" x-collapse class="mt-4">Segera hubungi tim darurat kami di <strong>+62 812-8112-0360</strong>. Kami menyediakan layanan bantuan 24/7 dan kendaraan pengganti jika diperlukan.</p>
            </div>

            <div x-data="{ open: false }" class="border-b border-zinc-100 dark:border-zinc-800 pb-6">
                <button @click="open = !open" class="flex justify-between items-center w-full text-left">
                    <span class="text-xl font-medium text-zinc-900 dark:text-zinc-50">Apakah ada biaya tambahan selain tarif sewa?</span>
                    <span class="material-symbols-outlined" x-text="open ? 'expand_less' : 'expand_more'"></span>
                </button>
                <p x-show="open" x-collapse class="mt-4">Tarif sewa sudah termasuk perawatan berkala. Biaya tambahan hanya berlaku jika memilih asuransi (All Risk / TLO) dan biaya layanan satu kali. Detail tercantum saat checkout.</p>
            </div>

        </div>
    </div>
</x-layout>

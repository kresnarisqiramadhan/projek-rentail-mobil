<x-layout>
    <div class="max-w-[800px] mx-auto pt-16 pb-32 px-6 min-h-screen bg-white">
        <!-- Header Pesanan -->
        <div class="mb-12 space-y-6">
            <div class="flex items-center gap-2 text-zinc-400 text-sm font-medium">
                <span>Pesanan Saya</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-display font-bold text-zinc-900 tracking-tight">ID #{{ $order->order_code }}</h1>
                    <span class="material-symbols-outlined text-zinc-300 cursor-pointer hover:text-zinc-900 transition-colors">content_copy</span>
                </div>
                <div class="text-right">
                    <p class="text-[10px] text-zinc-400 uppercase tracking-widest font-bold mb-1">Status</p>
                    <p class="text-xl font-bold text-zinc-900">{{ $order->status->label() }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-zinc-50">
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold text-zinc-900">Tanggal Pesan</span>
                        <span class="text-sm text-zinc-500 font-light">{{ $order->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold text-zinc-900">Total Pembayaran</span>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-zinc-900 font-bold">Rp{{ number_format($order->total_price) }}</span>
                        </div>
                    </div>
                </div>
                <div class="space-y-4 md:text-right">
                    <div class="flex md:flex-col justify-between">
                        <span class="text-sm font-bold text-zinc-900 mb-1">Batas Waktu</span>
                        <div>
                            <span class="text-sm text-zinc-900 font-bold" id="timer">15:00</span>
                            <p class="text-[10px] text-zinc-400 uppercase tracking-widest mt-1">Berakhir {{ $order->payment_timeout_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Instruksi berdasarkan metode --}}
        @if($order->payment_method->value === 'bank')
            <div class="space-y-10">
                <div class="bg-white rounded-3xl p-8 border border-zinc-100 shadow-sm space-y-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xs">BCA</div>
                        <div>
                            <p class="text-xs text-zinc-400 font-bold uppercase tracking-widest">Ke: BCA</p>
                            <p class="text-sm font-bold text-zinc-900">Virtual Account</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 bg-zinc-50 p-6 rounded-2xl border border-zinc-100">
                        <span class="text-2xl font-bold text-zinc-900 tracking-widest">889084763090076</span>
                        <span class="material-symbols-outlined text-zinc-300 cursor-pointer hover:text-zinc-900 transition-colors">content_copy</span>
                    </div>
                    <p class="text-xs text-zinc-400 font-medium">a.n. Rental Mobil Indonesia • Nomor Virtual Account</p>
                </div>
            </div>
        @elseif($order->payment_method->value === 'qris')
            <div class="space-y-10 text-center">
                <div class="bg-white rounded-3xl p-10 border border-zinc-100 shadow-sm inline-block mx-auto">
                    <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-[0.3em] mb-6">QRIS</p>
                    <div class="w-64 h-64 bg-zinc-50 p-4 rounded-2xl mx-auto border border-zinc-100 flex items-center justify-center">
                         <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=RentalMobil_{{ $order->order_code }}" class="w-full h-full">
                    </div>
                    <p class="text-sm font-bold text-zinc-900 mt-6">Kode QR akan kedaluwarsa dalam</p>
                    <p class="text-lg font-bold text-zinc-900">15 Menit 0 Detik</p>
                </div>
                <div class="text-left space-y-6">
                    <h3 class="text-lg font-bold text-zinc-900">Cara Membayar</h3>
                    <div class="space-y-4 text-sm text-zinc-500 font-light leading-relaxed">
                        <p>1. Buka <span class="font-bold">aplikasi pembayaran</span> pilihan Anda (GoPay, OVO, ShopeePay, DANA, dll).</p>
                        <p>2. Pilih <span class="font-bold">bayar dengan QR</span>.</p>
                        <p>3. <span class="font-bold">Pindai Kode QR</span> dari detail pesanan.</p>
                        <p>4. Ikuti instruksi dan konfirmasi pembayaran Anda dari aplikasi.</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form unggah bukti (wajib untuk kedua metode) --}}
        <div class="border-t border-zinc-100 pt-8 mt-10">
            <h3 class="text-lg font-bold mb-2">Unggah Bukti Pembayaran</h3>
            <p class="text-sm text-zinc-500 mb-4">
                Silakan unggah bukti transfer atau tangkapan layar pembayaran Anda.
            </p>
            <form action="{{ route('payment.upload', $order) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf"
                       class="block w-full text-sm text-zinc-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-zinc-100 file:text-zinc-900
                              hover:file:bg-zinc-200">
                @error('payment_proof')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <button type="submit" class="mt-4 w-full h-12 bg-zinc-900 text-white rounded-full font-medium hover:opacity-90">
                    Kirim Bukti
                </button>
            </form>
        </div>

        <div class="mt-16 pt-8 border-t border-zinc-100 text-center">
            <a href="{{ route('payment', $order) }}" class="text-xs font-bold text-zinc-400 hover:text-zinc-900 uppercase tracking-widest transition-colors underline decoration-zinc-200 underline-offset-4">Ganti Metode Pembayaran</a>
        </div>
    </div>
</x-layout>

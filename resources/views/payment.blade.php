<x-layout>
    <div class="max-w-[800px] mx-auto pt-16 pb-32 px-6 min-h-screen bg-white" x-data="{ method: new URLSearchParams(window.location.search).get('method') || 'bank' }">
        <!-- Order Header Info -->
        <div class="mb-12 space-y-6">
            <div class="flex items-center gap-2 text-zinc-400 text-sm font-medium">
                <span>My Order</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-display font-bold text-zinc-900 tracking-tight">ID #TEONLH002</h1>
                    <span class="material-symbols-outlined text-zinc-300 cursor-pointer hover:text-zinc-900 transition-colors">content_copy</span>
                </div>
                <div class="text-right">
                    <p class="text-[10px] text-zinc-400 uppercase tracking-widest font-bold mb-1">Status</p>
                    <p class="text-xl font-bold text-zinc-900">Unpaid</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-zinc-50">
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold text-zinc-900">Order Date</span>
                        <span class="text-sm text-zinc-500 font-light">08 May 2026</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold text-zinc-900">Total Payment</span>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-zinc-900 font-bold">$3,315.00</span>
                            <span class="material-symbols-outlined text-zinc-300 text-[16px]">info</span>
                        </div>
                    </div>
                </div>
                <div class="space-y-4 md:text-right">
                    <div class="flex md:flex-col justify-between">
                        <span class="text-sm font-bold text-zinc-900 mb-1">Remaining Time</span>
                        <div>
                            <span class="text-sm text-zinc-900 font-bold">14m 45s</span>
                            <p class="text-[10px] text-zinc-400 uppercase tracking-widest mt-1">Ends on May 08, 2026, 03:15</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Method Sections -->
        <div class="space-y-10">
            <!-- Bank Transfer Section -->
            <div x-show="method === 'bank'" x-transition class="space-y-10">
                <div class="bg-white rounded-3xl p-8 border border-zinc-100 shadow-sm space-y-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-zinc-900 rounded-lg flex items-center justify-center text-white font-bold text-xs">MANDIRI</div>
                        <div>
                            <p class="text-xs text-zinc-400 font-bold uppercase tracking-widest">To: Mandiri</p>
                            <p class="text-sm font-bold text-zinc-900">Virtual Account</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 bg-zinc-50 p-6 rounded-2xl border border-zinc-100">
                        <span class="text-2xl font-bold text-zinc-900 tracking-widest">889084763090076</span>
                        <span class="material-symbols-outlined text-zinc-300 cursor-pointer hover:text-zinc-900 transition-colors">content_copy</span>
                    </div>
                    <p class="text-xs text-zinc-400 font-medium">To: LuxeDrive International LLC • Virtual Account Number</p>
                    
                    <div class="bg-zinc-50/50 p-4 rounded-xl border border-zinc-100 flex gap-3">
                        <span class="material-symbols-outlined text-zinc-400 text-[20px]">info</span>
                        <p class="text-[11px] text-zinc-500 leading-relaxed font-light">Follow payment instructions on our website and avoid sharing personal info elsewhere.</p>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="space-y-4">
                    <div class="border-b border-zinc-100 pb-4">
                        <button class="flex justify-between items-center w-full text-left font-bold text-zinc-900">
                            <span>ATM Instruction</span>
                            <span class="material-symbols-outlined text-zinc-400">expand_less</span>
                        </button>
                        <div class="mt-4 space-y-4 text-sm text-zinc-500 font-light leading-relaxed">
                            <p>1. Insert your ATM card and select <span class="font-bold">English</span></p>
                            <p>2. Enter PIN, then select <span class="font-bold">ENTER</span></p>
                            <p>3. Select <span class="font-bold">PAYMENT</span>, then select <span class="font-bold">MULTI PAYMENT</span></p>
                            <p>4. Enter company code <span class="font-bold">'88908'</span> then press <span class="font-bold">CORRECT</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- QRIS Section -->
            <div x-show="method === 'qris'" x-transition class="space-y-10 text-center">
                <div class="bg-white rounded-3xl p-10 border border-zinc-100 shadow-sm inline-block mx-auto">
                    <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-[0.3em] mb-6">QRIS</p>
                    <div class="w-64 h-64 bg-zinc-50 p-4 rounded-2xl mx-auto border border-zinc-100 flex items-center justify-center">
                         <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=LuxeDrive_Order_TEONLH002" class="w-full h-full grayscale opacity-90">
                    </div>
                    <p class="text-sm font-bold text-zinc-900 mt-6">QR Code will be expired in</p>
                    <p class="text-lg font-bold text-zinc-900">12 Minutes 0 Seconds</p>
                </div>

                <div class="text-left space-y-6">
                    <h3 class="text-lg font-bold text-zinc-900">How to pay</h3>
                    <div class="space-y-4 text-sm text-zinc-500 font-light leading-relaxed">
                        <p>1. Open your <span class="font-bold">chosen app</span> to make the payment, such as Go-Pay, OVO, ShopeePay, etc.</p>
                        <p>2. Choose <span class="font-bold">pay with QR method</span>.</p>
                        <p>3. <span class="font-bold">Scan QR Code</span> from the order detail.</p>
                        <p>4. Follow the instruction and confirm your payment from the app.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 pt-8 border-t border-zinc-100 text-center">
            <a href="{{ route('checkout') }}" class="text-xs font-bold text-zinc-400 hover:text-zinc-900 uppercase tracking-widest transition-colors underline decoration-zinc-200 underline-offset-4">Change Payment Method</a>
        </div>
    </div>
</x-layout>

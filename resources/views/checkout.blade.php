<x-layout>
    <div class="max-w-[1440px] mx-auto pt-8 pb-32 px-6 md:px-12 min-h-screen" x-data="{ paymentMethod: 'bank' }">
        <div class="mb-12">
            <h1 class="text-4xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Checkout</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">Complete your reservation for the ultimate driving experience.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            <!-- Left: Checkout Forms -->
            <div class="lg:col-span-8 space-y-12">
                <!-- Step 1: Personal Details -->
                <section class="space-y-6">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 rounded-full bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 flex items-center justify-center font-bold">1</div>
                        <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">Personal Details</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-4 block">First Name</label>
                            <input type="text" value="Alex" class="w-full h-14 bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-full px-6 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-4 block">Last Name</label>
                            <input type="text" value="Rivers" class="w-full h-14 bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-full px-6 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-4 block">Email Address</label>
                            <input type="email" value="alex.rivers@luxedrive.com" class="w-full h-14 bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-full px-6 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
                        </div>
                    </div>
                </section>

                <!-- Step 2: Rental Options -->
                <section class="space-y-6">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 rounded-full bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 flex items-center justify-center font-bold">2</div>
                        <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">Rental Options</h2>
                    </div>
                    <div class="space-y-4">
                        <label class="flex items-center justify-between p-6 bg-zinc-50 dark:bg-zinc-800 rounded-3xl border border-zinc-100 dark:border-zinc-700 cursor-pointer group hover:border-zinc-900 dark:hover:border-zinc-50 transition-all">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="insurance" checked class="w-5 h-5 text-zinc-900 focus:ring-0">
                                <div>
                                    <p class="font-bold text-zinc-900 dark:text-zinc-50">Premium Coverage</p>
                                    <p class="text-xs text-zinc-500">$0 deductible, full peace of mind.</p>
                                </div>
                            </div>
                            <span class="font-bold text-zinc-900 dark:text-zinc-50">$85.00/day</span>
                        </label>
                        <label class="flex items-center justify-between p-6 bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-100 dark:border-zinc-700 cursor-pointer group hover:border-zinc-900 dark:hover:border-zinc-50 transition-all">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="insurance" class="w-5 h-5 text-zinc-900 focus:ring-0">
                                <div>
                                    <p class="font-bold text-zinc-900 dark:text-zinc-50">Standard Protection</p>
                                    <p class="text-xs text-zinc-500">$2,500 deductible.</p>
                                </div>
                            </div>
                            <span class="font-bold text-zinc-900 dark:text-zinc-50">$35.00/day</span>
                        </label>
                    </div>
                </section>

                <!-- Step 3: Payment Method -->
                <section class="space-y-6">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 rounded-full bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 flex items-center justify-center font-bold">3</div>
                        <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">Payment Method</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <button @click="paymentMethod = 'bank'" :class="paymentMethod === 'bank' ? 'border-2 border-zinc-900 dark:border-zinc-50 bg-zinc-50 dark:bg-zinc-800' : 'border border-zinc-100 dark:border-zinc-700 bg-white dark:bg-zinc-900'" class="flex flex-col items-center justify-center p-8 rounded-3xl gap-3 group transition-all">
                            <span class="material-symbols-outlined text-4xl" :class="paymentMethod === 'bank' ? 'text-zinc-900 dark:text-zinc-50' : 'text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50'">credit_card</span>
                            <span class="font-bold" :class="paymentMethod === 'bank' ? 'text-zinc-900 dark:text-zinc-50' : 'text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50'">Bank Transfer</span>
                        </button>
                        <button @click="paymentMethod = 'qris'" :class="paymentMethod === 'qris' ? 'border-2 border-zinc-900 dark:border-zinc-50 bg-zinc-50 dark:bg-zinc-800' : 'border border-zinc-100 dark:border-zinc-700 bg-white dark:bg-zinc-900'" class="flex flex-col items-center justify-center p-8 rounded-3xl gap-3 group transition-all">
                            <span class="material-symbols-outlined text-4xl" :class="paymentMethod === 'qris' ? 'text-zinc-900 dark:text-zinc-50' : 'text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50'">qr_code</span>
                            <span class="font-bold" :class="paymentMethod === 'qris' ? 'text-zinc-900 dark:text-zinc-50' : 'text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-zinc-50'">QRIS Payment</span>
                        </button>
                    </div>
                </section>
            </div>

            <!-- Right: Summary Sidebar -->
            <div class="lg:col-span-4">
                <div class="bg-zinc-900 text-white rounded-[2.5rem] p-10 sticky top-24 shadow-2xl">
                    <h2 class="text-2xl font-bold mb-8">Reservation Summary</h2>
                    
                    <!-- Vehicle Info -->
                    <div class="flex gap-6 mb-10 pb-8 border-b border-zinc-800">
                        <div class="w-24 h-24 rounded-2xl bg-zinc-800 overflow-hidden flex-shrink-0">
                            <img src="https://images.unsplash.com/photo-1592198084033-aade902d1aae?auto=format&fit=crop&q=80&w=200" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Ferrari F8 Tributo</h3>
                            <p class="text-zinc-500 text-sm">3 Days Rental</p>
                            <p class="text-zinc-400 text-xs mt-1">Oct 24 - Oct 27, 2023</p>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="space-y-4 mb-10">
                        <div class="flex justify-between text-zinc-400 text-sm">
                            <span>Rental Rate</span>
                            <span>$6,600.00</span>
                        </div>
                        <div class="flex justify-between text-zinc-400 text-sm">
                            <span>Premium Coverage</span>
                            <span>$255.00</span>
                        </div>
                        <div class="flex justify-between text-zinc-400 text-sm">
                            <span>Service Fee</span>
                            <span>$150.00</span>
                        </div>
                        <div class="flex justify-between text-zinc-400 text-sm">
                            <span>Tax (11%)</span>
                            <span>$770.55</span>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="flex justify-between items-center pt-8 border-t border-zinc-800 mb-10">
                        <span class="text-lg font-medium">Total Price</span>
                        <span class="text-3xl font-bold">$7,775.55</span>
                    </div>

                    <a :href="'{{ route('payment') }}?method=' + paymentMethod" class="w-full h-16 bg-white text-zinc-900 rounded-full flex items-center justify-center font-bold text-lg hover:bg-zinc-100 transition-colors">
                        Proceed to Payment
                    </a>
                    
                    <div class="flex items-center justify-center gap-2 mt-6 text-[10px] text-zinc-500 uppercase tracking-widest">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        Secure Encrypted Transaction
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

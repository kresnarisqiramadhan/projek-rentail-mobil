<x-profile-layout>
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Rental History</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-1">View and manage your journeys with LuxeDrive.</p>
        </div>
        
        <!-- Tabs Selector -->
        <div class="flex bg-zinc-100 dark:bg-zinc-800 p-1 rounded-xl w-fit">
            <button class="px-4 py-2 text-xs font-bold bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white shadow-sm rounded-lg">All</button>
            <button class="px-4 py-2 text-xs font-bold text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-400 transition-colors">Active</button>
            <button class="px-4 py-2 text-xs font-bold text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-400 transition-colors">Pending</button>
            <button class="px-4 py-2 text-xs font-bold text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-400 transition-colors">Past</button>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Rental Card 1: Active -->
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden hover:shadow-md transition-shadow">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="w-full lg:w-64 h-40 flex-shrink-0 relative">
                        <img src="https://images.unsplash.com/photo-1617469767053-d3b523a0b982?q=80&w=2000&auto=format&fit=crop" 
                             class="w-full h-full object-cover rounded-xl" alt="Car">
                        <div class="absolute top-2 left-2 px-3 py-1 bg-emerald-500 text-white text-[10px] font-black uppercase rounded-lg shadow-lg">Active</div>
                    </div>
                    
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-50">Mercedes-Benz G63 AMG</h3>
                                    <p class="text-xs text-zinc-500 font-bold uppercase tracking-widest mt-1">Order #ORD-20260510-A9B2</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-black text-zinc-900 dark:text-zinc-50 italic">IDR 25,000,000</div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase">Total Payment</div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-6">
                                <div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase mb-1">Pick Up Date</div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50">May 10, 2026</div>
                                </div>
                                <div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase mb-1">Return Date</div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50">May 12, 2026</div>
                                </div>
                                <div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase mb-1">Location</div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Jakarta Selatan</div>
                                </div>
                                <div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase mb-1">Method</div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50 uppercase">Bank Transfer</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-wrap items-center gap-3">
                            <button class="px-6 py-2.5 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 rounded-xl text-xs font-bold hover:opacity-90 transition-opacity">View Detail</button>
                            <button class="px-6 py-2.5 border border-zinc-200 dark:border-zinc-700 rounded-xl text-xs font-bold text-zinc-600 dark:text-zinc-400 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">Download Invoice</button>
                            <button class="ml-auto flex items-center gap-2 text-xs font-bold text-rose-500 hover:text-rose-600 transition-colors">
                                <span class="material-symbols-outlined text-sm">cancel</span>
                                Cancel Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rental Card 2: Completed -->
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden hover:shadow-md transition-shadow grayscale-[0.5] hover:grayscale-0">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="w-full lg:w-64 h-40 flex-shrink-0 relative">
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2000&auto=format&fit=crop" 
                             class="w-full h-full object-cover rounded-xl" alt="Car">
                        <div class="absolute top-2 left-2 px-3 py-1 bg-zinc-500 text-white text-[10px] font-black uppercase rounded-lg shadow-lg">Completed</div>
                    </div>
                    
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-50">Porsche 911 Carrera S</h3>
                                    <p class="text-xs text-zinc-500 font-bold uppercase tracking-widest mt-1">Order #ORD-20260424-X81Y</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-black text-zinc-900 dark:text-zinc-50 italic">IDR 12,500,000</div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase">Paid</div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-6">
                                <div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase mb-1">Pick Up Date</div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50">April 24, 2026</div>
                                </div>
                                <div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase mb-1">Return Date</div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50">April 26, 2026</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-wrap items-center gap-3">
                            <button class="px-6 py-2.5 bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-zinc-50 rounded-xl text-xs font-bold hover:bg-zinc-200 transition-colors">Rent Again</button>
                            <button class="px-6 py-2.5 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 rounded-xl text-xs font-bold flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm text-amber-400">star</span>
                                Give Rating
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-profile-layout>


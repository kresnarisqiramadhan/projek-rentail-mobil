<x-profile-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Profile Dashboard</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Welcome back, Alex Rivers. Manage your journeys and account.</p>
    </div>

    <!-- Urgent Action: Payment Countdown (Visible when status is PENDING) -->
    <div class="mb-8 p-6 bg-amber-50 border border-amber-100 rounded-2xl flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 animate-pulse">
                <span class="material-symbols-outlined">payments</span>
            </div>
            <div>
                <h4 class="font-bold text-amber-900">Payment Pending</h4>
                <p class="text-sm text-amber-700">ORD-20260510-A9B2 - Your session expires in <span class="font-mono font-bold">12:45</span></p>
            </div>
        </div>
        <a href="{{ route('payment') }}" class="w-full md:w-auto px-6 py-2.5 bg-amber-600 text-white rounded-xl text-sm font-bold hover:bg-amber-700 transition-colors text-center">
            Complete Payment
        </a>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-6 rounded-2xl">
            <div class="text-zinc-500 text-xs font-bold uppercase tracking-wider mb-2">Total Bookings</div>
            <div class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">12</div>
        </div>
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-6 rounded-2xl">
            <div class="text-zinc-500 text-xs font-bold uppercase tracking-wider mb-2">Member Status</div>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="text-lg font-bold text-zinc-900 dark:text-zinc-50">VIP Elite</span>
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-6 rounded-2xl">
            <div class="text-zinc-500 text-xs font-bold uppercase tracking-wider mb-2">Account Status</div>
            <div class="text-lg font-bold text-emerald-600 flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">verified</span> Verified
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-6 rounded-2xl">
            <div class="text-zinc-500 text-xs font-bold uppercase tracking-wider mb-2">Active Rental</div>
            <div class="text-lg font-bold text-zinc-900 dark:text-zinc-50">1 Car</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main: Active Rental -->
        <div class="lg:col-span-2 space-y-8">
            <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex justify-between items-center">
                    <h2 class="font-bold text-zinc-900 dark:text-zinc-50">Active Rental</h2>
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase rounded-full">In Progress</span>
                </div>
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        <img src="https://images.unsplash.com/photo-1617469767053-d3b523a0b982?q=80&w=2000&auto=format&fit=crop" 
                             class="w-full md:w-48 h-32 object-cover rounded-xl" alt="Car">
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-50">Mercedes-Benz G63 AMG</h3>
                                    <p class="text-sm text-zinc-500">B 1234 ABC • Obsidian Black</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase mb-1">Pick Up</div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50">May 10, 09:00 AM</div>
                                </div>
                                <div>
                                    <div class="text-[10px] text-zinc-400 font-bold uppercase mb-1">Return</div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50">May 12, 09:00 AM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800 flex flex-wrap gap-3">
                        <button class="px-4 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 rounded-xl text-xs font-bold hover:opacity-90 transition-opacity">View Agreement</button>
                        <button class="px-4 py-2 border border-zinc-200 dark:border-zinc-700 rounded-xl text-xs font-bold text-zinc-600 dark:text-zinc-400 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">Emergency Support</button>
                    </div>
                </div>
            </section>

            <!-- Secondary: Recent History Preview -->
            <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex justify-between items-center">
                    <h2 class="font-bold text-zinc-900 dark:text-zinc-50">Recent History</h2>
                    <a href="{{ route('profile.rentals') }}" class="text-xs font-bold text-zinc-500 hover:text-zinc-900 transition-colors">View All History</a>
                </div>
                <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    <div class="p-4 flex items-center justify-between hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-zinc-400 group-hover:scale-110 transition-transform">directions_car</span>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-zinc-900 dark:text-zinc-50">Porsche 911 Carrera</div>
                                <div class="text-xs text-zinc-500">April 24 - April 26 • IDR 12,500,000</div>
                            </div>
                        </div>
                        <span class="px-2 py-1 bg-zinc-100 text-zinc-500 text-[9px] font-bold uppercase rounded-md">Completed</span>
                    </div>
                    <div class="p-4 flex items-center justify-between hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-zinc-400 group-hover:scale-110 transition-transform">directions_car</span>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-zinc-900 dark:text-zinc-50">Range Rover Sport</div>
                                <div class="text-xs text-zinc-500">April 12 - April 15 • IDR 18,000,000</div>
                            </div>
                        </div>
                        <span class="px-2 py-1 bg-zinc-100 text-zinc-500 text-[9px] font-bold uppercase rounded-md">Completed</span>
                    </div>
                </div>
            </section>
        </div>

        <!-- Sidebar: Account Verification Status & Loyalty -->
        <div class="space-y-6">
            <div class="bg-zinc-900 text-white rounded-3xl p-6 relative overflow-hidden group">
                <div class="absolute -top-12 -right-12 w-32 h-32 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                <h4 class="text-sm font-bold uppercase tracking-widest text-zinc-400 mb-6">Loyalty Program</h4>
                <div class="flex items-end justify-between mb-4">
                    <div>
                        <div class="text-3xl font-black italic tracking-tighter">ELITE</div>
                        <div class="text-[10px] font-bold text-zinc-500">4,250 POINTS</div>
                    </div>
                    <div class="text-[10px] font-bold text-right text-zinc-500">
                        850 POINTS UNTIL<br>PLATINUM
                    </div>
                </div>
                <div class="w-full h-1 bg-zinc-800 rounded-full overflow-hidden">
                    <div class="h-full bg-white w-3/4 rounded-full"></div>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
                <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-400 mb-4">Document Verification</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-emerald-500 text-sm">check_circle</span>
                            <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Identity (KTP)</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-emerald-500 text-sm">check_circle</span>
                            <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Driving License (SIM)</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between opacity-50">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-zinc-400 text-sm">radio_button_unchecked</span>
                            <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">International Permit</span>
                        </div>
                    </div>
                </div>
                <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                    <a href="{{ route('profile.settings') }}" class="text-xs font-bold text-zinc-900 dark:text-zinc-50 underline underline-offset-4">Manage Documents</a>
                </div>
            </div>
        </div>
    </div>
</x-profile-layout>


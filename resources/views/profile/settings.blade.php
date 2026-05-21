<x-profile-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Account Settings</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Manage your identity, security, and preferences.</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <div class="xl:col-span-2 space-y-8">
            <!-- Profile Information -->
            <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-zinc-900 dark:text-zinc-50 uppercase tracking-widest mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-zinc-900 dark:bg-zinc-50"></span>
                    Personal Information
                </h3>
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-1">Full Name</label>
                            <input type="text" value="Alex Rivers" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm text-zinc-900 dark:text-zinc-50 outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-1">Email Address</label>
                            <input type="email" value="alex.rivers@luxedrive.com" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm text-zinc-400 outline-none cursor-not-allowed" readonly>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-1">Phone Number</label>
                            <input type="text" value="+62 812 3456 7890" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm text-zinc-900 dark:text-zinc-50 outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-1">Location</label>
                            <select class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm text-zinc-900 dark:text-zinc-50 outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
                                <option>Jakarta, Indonesia</option>
                                <option>Bali, Indonesia</option>
                                <option>Surabaya, Indonesia</option>
                            </select>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-zinc-50 dark:border-zinc-800">
                        <button type="button" class="px-8 py-3 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-xs font-bold rounded-xl hover:opacity-90 transition-opacity">Save Changes</button>
                    </div>
                </form>
            </section>

            <!-- Verification / KYC -->
            <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-zinc-900 dark:text-zinc-50 uppercase tracking-widest mb-2 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Verification Documents
                </h3>
                <p class="text-xs text-zinc-500 mb-6 font-light italic">Required to book premium vehicles.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 border-2 border-dashed border-zinc-100 dark:border-zinc-800 rounded-2xl bg-zinc-50/50 dark:bg-zinc-800/20 text-center group cursor-pointer hover:border-zinc-900 dark:hover:border-zinc-50 transition-colors">
                        <span class="material-symbols-outlined text-3xl text-zinc-300 dark:text-zinc-600 mb-3 group-hover:scale-110 transition-transform">badge</span>
                        <div class="text-xs font-bold text-zinc-900 dark:text-zinc-50 mb-1 italic">Identity Card (KTP)</div>
                        <div class="text-[10px] text-zinc-500">Uploaded on May 01, 2026</div>
                        <div class="mt-4 text-[10px] font-black uppercase text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full w-fit mx-auto">Verified</div>
                    </div>
                    
                    <div class="p-6 border-2 border-dashed border-zinc-100 dark:border-zinc-800 rounded-2xl bg-zinc-50/50 dark:bg-zinc-800/20 text-center group cursor-pointer hover:border-zinc-900 dark:hover:border-zinc-50 transition-colors">
                        <span class="material-symbols-outlined text-3xl text-zinc-300 dark:text-zinc-600 mb-3 group-hover:scale-110 transition-transform">license</span>
                        <div class="text-xs font-bold text-zinc-900 dark:text-zinc-50 mb-1 italic">Driving License (SIM A)</div>
                        <div class="text-[10px] text-zinc-500">Uploaded on May 01, 2026</div>
                        <div class="mt-4 text-[10px] font-black uppercase text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full w-fit mx-auto">Verified</div>
                    </div>
                </div>
            </section>
        </div>

        <div class="space-y-8">
            <!-- Security Section -->
            <section class="bg-zinc-900 dark:bg-zinc-50 rounded-3xl p-8 text-white dark:text-zinc-900 shadow-xl">
                <h3 class="text-xs font-bold uppercase tracking-widest mb-8 opacity-50 italic">Security</h3>
                <div class="space-y-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-bold italic mb-1 uppercase">Two-Factor Auth</div>
                            <div class="text-[10px] opacity-60">Highly Recommended</div>
                        </div>
                        <button class="w-10 h-5 bg-zinc-700 dark:bg-zinc-200 rounded-full relative transition-colors">
                            <span class="absolute right-1 top-1 w-3 h-3 bg-white dark:bg-zinc-900 rounded-full"></span>
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-bold italic mb-1 uppercase">Password</div>
                            <div class="text-[10px] opacity-60 italic">Last changed 2 months ago</div>
                        </div>
                        <button class="text-[10px] font-black uppercase underline underline-offset-4">Change</button>
                    </div>
                </div>
                
                <div class="mt-12 pt-12 border-t border-white/10 dark:border-zinc-900/10">
                    <button class="w-full py-4 border border-white/20 dark:border-zinc-900/20 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-white/5 dark:hover:bg-zinc-900/5 transition-colors">Terminate Sessions</button>
                </div>
            </section>
            
            <!-- Danger Zone -->
            <section class="bg-rose-50 border border-rose-100 rounded-2xl p-6">
                <h3 class="text-xs font-bold text-rose-900 uppercase tracking-widest mb-4 italic">Danger Zone</h3>
                <p class="text-[10px] text-rose-700 mb-6 font-medium leading-relaxed">Deleting your account is permanent. All your points and rental history will be purged.</p>
                <button class="w-full py-3 bg-white border border-rose-200 text-rose-600 text-[10px] font-black uppercase rounded-xl hover:bg-rose-600 hover:text-white transition-all">Delete Account</button>
            </section>
        </div>
    </div>
</x-profile-layout>


<x-profile-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Profile Dashboard</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Welcome back, Alex. Here's an overview of your account.</p>
    </div>

    <!-- Recent Rentals (Empty State) -->
    <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex justify-between items-center">
            <h2 class="font-semibold text-zinc-900 dark:text-zinc-50">Recent Rentals</h2>
            <a href="{{ route('profile.rentals') }}" class="text-sm text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">View all</a>
        </div>
        <div class="p-12 text-center">
            <div class="w-16 h-16 bg-zinc-50 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-zinc-300">history</span>
            </div>
            <h3 class="text-zinc-900 dark:text-zinc-50 font-medium mb-1">No rentals yet</h3>
            <p class="text-zinc-500 text-sm font-light mb-6">You haven't made any rentals with us yet.</p>
            <a href="{{ route('vehicles') }}" class="inline-flex px-6 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">
                Explore Fleet
            </a>
        </div>
    </section>

    <!-- Settings Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
            <h3 class="font-semibold text-zinc-900 dark:text-zinc-50 mb-6 pb-2 border-b border-zinc-100 dark:border-zinc-800">Personal Info</h3>
            <form class="space-y-4">
                <div>
                    <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Full Name</label>
                    <input type="text" value="Alex Rivers" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-2 text-sm text-zinc-900 dark:text-zinc-50 outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
                </div>
                <div>
                    <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Email Address</label>
                    <input type="email" value="alex.rivers@luxedrive.com" readonly class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-2 text-sm text-zinc-400 outline-none cursor-not-allowed">
                </div>
                <div class="pt-2">
                    <button type="button" class="w-full bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 font-medium py-2 rounded-xl hover:opacity-90 transition-opacity">Save Changes</button>
                </div>
            </form>
        </div>

        <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
            <h3 class="font-semibold text-zinc-900 dark:text-zinc-50 mb-6 pb-2 border-b border-zinc-100 dark:border-zinc-800">Security</h3>
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Two-Factor Auth</div>
                        <div class="text-xs text-zinc-500">Add an extra layer of security</div>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-zinc-50 text-zinc-400 border border-zinc-100">Disabled</span>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Password</div>
                        <div class="text-xs text-zinc-500">Last changed 3 months ago</div>
                    </div>
                    <a href="{{ route('profile.settings') }}" class="text-xs font-semibold text-zinc-900 dark:text-zinc-50 underline">Update</a>
                </div>
            </div>
        </div>
    </div>
</x-profile-layout>

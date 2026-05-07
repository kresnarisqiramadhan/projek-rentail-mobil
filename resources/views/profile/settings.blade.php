<x-profile-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Account Settings</h1>
        <p class="text-zinc-500 dark:text-zinc-400 mt-1">Manage your account preferences and security.</p>
    </div>

    <div class="space-y-8">
        <!-- Profile Settings -->
        <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
            <h3 class="font-semibold text-zinc-900 dark:text-zinc-50 mb-6 pb-2 border-b border-zinc-100 dark:border-zinc-800">Profile Information</h3>
            <form class="max-w-xl space-y-6">
                <div>
                    <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Full Name</label>
                    <input type="text" value="Alex Rivers" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm text-zinc-900 dark:text-zinc-50 outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
                </div>
                <div>
                    <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 block">Email Address</label>
                    <input type="email" value="alex.rivers@luxedrive.com" class="w-full bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-xl px-4 py-3 text-sm text-zinc-900 dark:text-zinc-50 outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
                </div>
                <button type="button" class="px-8 py-3 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-sm font-medium rounded-xl hover:opacity-90 transition-opacity">Update Profile</button>
            </form>
        </section>

        <!-- Security Settings -->
        <section class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6">
            <h3 class="font-semibold text-zinc-900 dark:text-zinc-50 mb-6 pb-2 border-b border-zinc-100 dark:border-zinc-800">Security</h3>
            <div class="max-w-xl space-y-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Change Password</h4>
                        <p class="text-xs text-zinc-500">Ensure your account is using a long, random password.</p>
                    </div>
                    <button class="px-4 py-2 border border-zinc-100 dark:border-zinc-800 rounded-lg text-xs font-semibold hover:bg-zinc-50 transition-colors">Change</button>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Two-Factor Authentication</h4>
                        <p class="text-xs text-zinc-500">Add additional security to your account.</p>
                    </div>
                    <button class="px-4 py-2 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 rounded-lg text-xs font-semibold hover:opacity-90 transition-opacity">Enable</button>
                </div>
            </div>
        </section>
    </div>
</x-profile-layout>

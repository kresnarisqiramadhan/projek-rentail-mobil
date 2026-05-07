<x-layout>
    <div class="min-h-[calc(100vh-64px)] flex items-center justify-center px-6 py-12 bg-zinc-50 dark:bg-zinc-950">
        <div class="w-full max-w-md bg-white dark:bg-zinc-900 rounded-[2.5rem] p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-zinc-100 dark:border-zinc-800">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-display font-bold text-zinc-900 dark:text-zinc-50 tracking-tight mb-2">Create Account</h1>
                <p class="text-zinc-500 dark:text-zinc-400 text-sm">Join the elite community of LuxeDrive.</p>
            </div>

            <form action="#" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-4 block">Full Name</label>
                    <input type="text" placeholder="Alex Rivers" class="w-full h-14 bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-full px-6 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-4 block">Email Address</label>
                    <input type="email" placeholder="alex@luxedrive.com" class="w-full h-14 bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-full px-6 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest ml-4 block">Password</label>
                    <input type="password" placeholder="••••••••" class="w-full h-14 bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-full px-6 text-sm outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full h-14 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 font-bold rounded-full hover:opacity-90 transition-opacity shadow-lg">
                        Sign Up
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <p class="text-sm text-zinc-500">Already have an account? 
                    <a href="{{ route('login') }}" class="text-zinc-900 dark:text-zinc-50 font-bold hover:underline">Sign In</a>
                </p>
            </div>
        </div>
    </div>
</x-layout>

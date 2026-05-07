<nav class="bg-white/80 dark:bg-zinc-900/80 backdrop-blur-xl docked full-width top-0 sticky z-50 border-b border-zinc-100/50 dark:border-zinc-800/50 shadow-[0_4px_30px_rgba(0,0,0,0.03)]">
    <div class="flex justify-between items-center h-16 px-6 md:px-12 max-w-[1440px] mx-auto">
        <!-- Logo (Left) -->
        <div class="flex-shrink-0">
            <a href="{{ route('home') }}" class="text-xl font-semibold tracking-tighter text-zinc-900 dark:text-zinc-50">LuxeDrive</a>
        </div>

        <!-- Navigation Links (Center) -->
        <div class="hidden md:flex space-x-8 items-center font-manrope font-light tracking-tight text-sm absolute left-1/2 -translate-x-1/2">
            <a class="text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors" href="{{ route('vehicles') }}">Vehicles</a>
            <a class="text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors" href="{{ route('experience') }}">Experience</a>
            <a class="text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors" href="{{ route('locations') }}">Locations</a>
            <a class="text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors" href="{{ route('support') }}">Support</a>
        </div>

        <!-- Search & Auth (Right) -->
        <div class="flex items-center gap-6">
            <!-- Search Box -->
            <div class="relative hidden lg:flex items-center group">
                <span class="material-symbols-outlined absolute left-3 text-zinc-400 group-focus-within:text-zinc-900 dark:group-focus-within:text-zinc-50 transition-colors text-[18px]">search</span>
                <input type="text" placeholder="Search fleet..." class="pl-10 pr-4 py-1.5 w-48 bg-zinc-50 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-700 rounded-full text-xs outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-50 transition-all">
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-2">
                <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-medium text-zinc-900 dark:text-zinc-50 hover:bg-zinc-100 dark:hover:bg-zinc-800 rounded-full transition-all">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-xs font-medium bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 rounded-full hover:opacity-90 transition-all shadow-sm">Register</a>
            </div>
        </div>
    </div>
</nav>

<x-layout>
    <div class="min-h-screen">
        <!-- Hero Section -->
        <section class="relative h-[80vh] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-zinc-900">
                <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=1920" alt="Experience" class="w-full h-full object-cover opacity-60">
            </div>
            <div class="relative z-10 text-center px-6">
                <h1 class="text-6xl md:text-8xl font-display text-white font-bold tracking-tight mb-6">Beyond Driving</h1>
                <p class="text-xl md:text-2xl text-white/80 font-light max-w-3xl mx-auto leading-relaxed">It's not about the destination. It's about the precision, the heritage, and the adrenaline of the journey.</p>
            </div>
        </section>

        <!-- Story Sections -->
        <section class="max-w-[1440px] mx-auto py-32 px-6 md:px-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-24 items-center mb-32">
                <div>
                    <h2 class="text-xs font-bold text-zinc-400 uppercase tracking-[0.4em] mb-6">Unrivaled Service</h2>
                    <h3 class="text-4xl font-display text-zinc-900 dark:text-zinc-50 font-bold mb-8 leading-tight">Your Personal Concierge. Always.</h3>
                    <p class="text-zinc-500 dark:text-zinc-400 text-lg font-light leading-relaxed mb-8">From the moment you land to the moment you depart, our team handles every detail. No paperwork, no queues. Just the keys to your masterpiece, delivered wherever you desire.</p>
                    <div class="flex gap-8">
                        <div>
                            <div class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">24/7</div>
                            <p class="text-xs text-zinc-400 uppercase tracking-widest mt-1">Support</p>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">150+</div>
                            <p class="text-xs text-zinc-400 uppercase tracking-widest mt-1">Points Check</p>
                        </div>
                    </div>
                </div>
                <div class="aspect-square bg-zinc-100 dark:bg-zinc-800 rounded-3xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80&w=800" alt="Service" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-24 items-center flex-row-reverse">
                <div class="md:order-2">
                    <h2 class="text-xs font-bold text-zinc-400 uppercase tracking-[0.4em] mb-6">The Collection</h2>
                    <h3 class="text-4xl font-display text-zinc-900 dark:text-zinc-50 font-bold mb-8 leading-tight">Pristine Condition. Pure Emotion.</h3>
                    <p class="text-zinc-500 dark:text-zinc-400 text-lg font-light leading-relaxed mb-8">Our fleet is meticulously maintained by master technicians. Each vehicle is detailed to perfection, ensuring that every mile feels like the first.</p>
                    <a href="{{ route('vehicles') }}" class="inline-flex items-center gap-3 text-zinc-900 dark:text-zinc-50 font-medium group">
                        Explore the fleet
                        <span class="material-symbols-outlined group-hover:translate-x-2 transition-transform">arrow_forward</span>
                    </a>
                </div>
                <div class="aspect-square bg-zinc-100 dark:bg-zinc-800 rounded-3xl overflow-hidden md:order-1">
                    <img src="https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&q=80&w=800" alt="Fleet" class="w-full h-full object-cover">
                </div>
            </div>
        </section>
    </div>
</x-layout>

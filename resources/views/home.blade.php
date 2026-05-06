<x-layout>
    <x-hero />

    <!-- Featured Fleet Section -->
    <section class="py-xxl px-6 md:px-12 max-w-[1440px] mx-auto bg-white">
        <div class="text-center mb-xl">
            <h2 class="font-display-lg text-display-lg text-primary mb-4">The Collection</h2>
            <p class="font-body-lg text-body-lg text-secondary max-w-2xl mx-auto">Meticulously maintained. Flawlessly presented.</p>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($vehicles as $index => $vehicle)
                <x-vehicle-card :vehicle="$vehicle" :large="$index === 0" />
            @endforeach

            <!-- View Full Fleet Card -->
            <div class="group relative bg-surface-container-lowest border border-surface-variant rounded-xl overflow-hidden hover:-translate-y-1 hover:shadow-[0_20px_40px_rgba(0,0,0,0.06)] transition-all duration-300 cursor-pointer">
                <div class="h-60 overflow-hidden bg-zinc-100 flex items-center justify-center">
                    <span class="font-headline-md text-headline-md text-primary">View Full Fleet</span>
                    <span class="material-symbols-outlined ml-2 text-primary">arrow_forward</span>
                </div>
            </div>
        </div>
    </section>
</x-layout>

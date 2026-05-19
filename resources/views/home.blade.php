<x-layout>
    <x-hero />

    <section class="py-xxl px-6 md:px-12 max-w-[1440px] mx-auto bg-white">
        <div class="text-center mb-xl">
            <h2 class="font-display-lg text-display-lg text-primary mb-4">Koleksi Kami</h2>
            <p class="font-body-lg text-body-lg text-secondary max-w-2xl mx-auto">Terawat prima. Siap menemani perjalanan Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($vehicles as $index => $vehicle)
                <x-vehicle-card :vehicle="$vehicle" :large="$index === 0" />
            @endforeach

            <a href="{{ route('vehicles') }}" class="group relative bg-surface-container-lowest border border-surface-variant rounded-xl overflow-hidden hover:-translate-y-1 hover:shadow-[0_20px_40px_rgba(0,0,0,0.06)] transition-all duration-300 cursor-pointer block">
                <div class="h-60 overflow-hidden bg-zinc-100 flex items-center justify-center">
                    <span class="font-headline-md text-headline-md text-primary">Lihat Semua Armada</span>
                    <span class="material-symbols-outlined ml-2 text-primary">arrow_forward</span>
                </div>
            </a>
        </div>
    </section>
</x-layout>

<x-layout>
    <x-hero />

    <section class="py-xxl px-6 md:px-12 max-w-[1440px] mx-auto bg-white">
        <div class="text-center mb-xl">
            <h2 class="font-display-lg text-display-lg text-primary mb-4">{{ __('Our Collection') }}</h2>
            <p class="font-body-lg text-body-lg text-secondary max-w-2xl mx-auto">{{ __('Meticulously maintained. Ready for your journey.') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($vehicles as $index => $vehicle)
                <x-vehicle-card :vehicle="$vehicle" :large="$index === 0" />
            @endforeach

            <a href="{{ route('vehicles') }}"
                class="group relative bg-surface-container-lowest border border-surface-variant rounded-xl overflow-hidden hover:-translate-y-1 hover:shadow-[0_20px_40px_rgba(0,0,0,0.06)] transition-all duration-300 cursor-pointer block">
                <div class="h-60 overflow-hidden bg-zinc-100 flex items-center justify-center">
                    <span class="font-headline-md text-headline-md text-primary">{{ __('View All Cars') }}</span>
                    <span class="material-symbols-outlined ml-2 text-primary">arrow_forward</span>
                </div>
            </a>
        </div>
    </section>

    <!-- Keunggulan Kami Section -->
    <section class="py-24 px-6 md:px-12 max-w-[1440px] mx-auto bg-zinc-50/50 border-t border-zinc-100/50">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <!-- Left Side: Sticky Title and Statement -->
            <div class="lg:col-span-5 lg:sticky lg:top-24 h-fit">
                <span class="text-xs font-bold tracking-[0.2em] text-zinc-400 uppercase block mb-4">{{ __('LuxeDrive Distinction') }}</span>
                <h2 class="text-3xl md:text-4xl font-display font-bold tracking-tight text-zinc-900 mb-6 leading-tight">
                    {{ __('Our Commitment to Your Comfort Standards') }}
                </h2>
                <p class="text-zinc-500 text-base font-light leading-relaxed mb-8">
                    {{ __('We believe that a perfect journey begins with the right vehicle. At LuxeDrive, every service detail is designed to deliver the highest standard of seamless mobility.') }}
                </p>
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-zinc-200 text-xs font-medium text-zinc-600 bg-white">
                    <span class="w-1.5 h-1.5 rounded-full bg-zinc-900 animate-pulse"></span>
                    {{ __('24/7 Emergency Support Available') }}
                </div>
            </div>

            <!-- Right Side: Asymmetrical Interactive Feature List -->
            <div class="lg:col-span-7 space-y-12">
                <!-- Feature 1 -->
                <div class="group flex gap-8 pb-10 border-b border-zinc-200/80">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 rounded-2xl bg-zinc-900 text-white flex items-center justify-center transition-transform group-hover:scale-105 duration-300 shadow-sm">
                            <span class="material-symbols-outlined text-[22px] font-light">verified_user</span>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900 mb-2 tracking-tight">
                            {{ __('Pristine Vehicle Condition') }}
                        </h3>
                        <p class="text-zinc-500 text-sm leading-relaxed font-light">
                            {{ __('Each unit undergoes a thorough technical inspection before being handed over to you. We ensure a high level of hygienic cleanliness and optimal engine performance without compromise.') }}
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="group flex gap-8 pb-10 border-b border-zinc-200/80">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 rounded-2xl bg-zinc-900 text-white flex items-center justify-center transition-transform group-hover:scale-105 duration-300 shadow-sm">
                            <span class="material-symbols-outlined text-[22px] font-light">credit_card</span>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900 mb-2 tracking-tight">
                            {{ __('Transparent Pricing Without Surprises') }}
                        </h3>
                        <p class="text-zinc-500 text-sm leading-relaxed font-light">
                            {{ __('The rate you see when booking is the final price you pay. Free from hidden fees such as sudden additional insurance or seasonal taxes not disclosed beforehand.') }}
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="group flex gap-8 pb-10 border-b border-zinc-200/80">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 rounded-2xl bg-zinc-900 text-white flex items-center justify-center transition-transform group-hover:scale-105 duration-300 shadow-sm">
                            <span class="material-symbols-outlined text-[22px] font-light">local_shipping</span>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900 mb-2 tracking-tight">
                            {{ __('Flexible Delivery & Pick-Up') }}
                        </h3>
                        <p class="text-zinc-500 text-sm leading-relaxed font-light">
                            {{ __('Vehicles can be delivered directly to your airport, hotel, office, or home. You determine the location and time of delivery for your travel efficiency.') }}
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="group flex gap-8">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 rounded-2xl bg-zinc-900 text-white flex items-center justify-center transition-transform group-hover:scale-105 duration-300 shadow-sm">
                            <span class="material-symbols-outlined text-[22px] font-light">support_agent</span>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900 mb-2 tracking-tight">
                            {{ __('24-Hour Emergency Assistance') }}
                        </h3>
                        <p class="text-zinc-500 text-sm leading-relaxed font-light">
                            {{ __('From roadside towing assistance to instant vehicle replacement in case of technical issues on the road. Our standby team is ready to assist you anytime, anywhere.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
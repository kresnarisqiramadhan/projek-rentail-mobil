<x-layout>
    @php
        // Mock data for the demonstration
        $vehicle = (object)[
            'id' => $id,
            'name' => 'Ferrari F8 Tributo',
            'class' => 'Exotic Sports',
            'price_per_day' => 2200,
            'image_url' => 'https://images.unsplash.com/photo-1592198084033-aade902d1aae?auto=format&fit=crop&q=80&w=1200',
            'description' => 'The Ferrari F8 Tributo is the new mid-rear-engined sports car that represents the highest expression of the Prancing Horse\'s classic two-seater berlinetta. It is a car with unique characteristics and, as its name implies, is an homage to the most powerful V8 in Ferrari history.',
            'specs' => [
                'Engine' => '3.9L V8 Twin-Turbo',
                'Horsepower' => '710 hp',
                '0-100 km/h' => '2.9s',
                'Top Speed' => '340 km/h'
            ],
            'features' => [
                'Carbon Ceramic Brakes',
                'Apple CarPlay',
                'Alcantara Interior',
                'Front Lift System'
            ]
        ];
    @endphp

    <main class="pt-8 pb-32 px-6 md:px-12 max-w-[1440px] mx-auto min-h-screen">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-zinc-400 text-xs uppercase tracking-widest mb-8">
            <a href="{{ route('home') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Home</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <a href="{{ route('vehicles') }}" class="hover:text-zinc-900 dark:hover:text-zinc-50 transition-colors">Fleet</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-zinc-900 dark:text-zinc-50 font-bold">{{ $vehicle->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <!-- Image Gallery -->
            <div class="space-y-6">
                <div class="aspect-[4/3] bg-zinc-100 dark:bg-zinc-800 rounded-3xl overflow-hidden shadow-sm">
                    <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->name }}" class="w-full h-full object-cover">
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <div class="aspect-square bg-zinc-100 dark:bg-zinc-800 rounded-xl overflow-hidden cursor-pointer border-2 border-zinc-900 dark:border-zinc-50">
                        <img src="{{ $vehicle->image_url }}" class="w-full h-full object-cover">
                    </div>
                    @for($i = 0; $i < 3; $i++)
                    <div class="aspect-square bg-zinc-100 dark:bg-zinc-800 rounded-xl overflow-hidden cursor-pointer opacity-50 hover:opacity-100 transition-opacity">
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-zinc-400">image</span>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            <!-- Details -->
            <div class="space-y-10">
                <div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-4xl md:text-5xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight mb-2">{{ $vehicle->name }}</h1>
                            <p class="text-xl text-zinc-500 font-light">{{ $vehicle->class }}</p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-zinc-900 dark:text-zinc-50">${{ $vehicle->price_per_day }}</div>
                            <p class="text-xs text-zinc-400 uppercase tracking-widest mt-1">Per Day</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-zinc-100 dark:border-zinc-800 pt-8">
                    <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-[0.2em] mb-4">Description</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 font-light leading-relaxed">
                        {{ $vehicle->description }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-8">
                    @foreach($vehicle->specs as $label => $value)
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">{{ $label }}</p>
                        <p class="text-lg font-medium text-zinc-900 dark:text-zinc-50">{{ $value }}</p>
                    </div>
                    @endforeach
                </div>

                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-[0.2em]">Key Features</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($vehicle->features as $feature)
                        <span class="px-4 py-2 bg-zinc-50 dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-full text-xs text-zinc-600 dark:text-zinc-400 font-medium">
                            {{ $feature }}
                        </span>
                        @endforeach
                    </div>
                </div>

                <div class="pt-6">
                    <a href="{{ route('checkout') }}" class="w-full h-16 bg-zinc-900 dark:bg-zinc-50 text-white dark:text-zinc-900 text-lg font-bold rounded-2xl hover:opacity-90 transition-opacity shadow-lg flex items-center justify-center">
                        Reserve This Vehicle
                    </a>
                    <p class="text-center text-[10px] text-zinc-400 uppercase tracking-widest mt-4">No payment required today</p>
                </div>
            </div>
        </div>
    </main>
</x-layout>

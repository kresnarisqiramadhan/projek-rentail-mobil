@props(['vehicle', 'large' => false])

<a href="{{ route('vehicle.details', $vehicle) }}" class="{{ $large ? 'lg:col-span-2' : '' }} group relative bg-surface-container-lowest border border-surface-variant rounded-xl overflow-hidden hover:-translate-y-1 hover:shadow-[0_20px_40px_rgba(0,0,0,0.06)] transition-all duration-300 cursor-pointer block">
    <div class="{{ $large ? 'h-80' : 'h-60' }} overflow-hidden bg-zinc-100">
        @if($vehicle->photos->isNotEmpty())
            <img alt="{{ $vehicle->name }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out" src="{{ asset('storage/' . $vehicle->photos->first()->path) }}"/>
        @else
            <div class="w-full h-full flex items-center justify-center text-zinc-400">
                <span class="material-symbols-outlined text-6xl">directions_car</span>
            </div>
        @endif
    </div>
    <div class="{{ $large ? 'p-8' : 'p-6' }}">
        @if($large)
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="font-headline-md text-headline-md text-primary">{{ $vehicle->name }}</h3>
                    <p class="font-body-md text-body-md text-secondary mt-1">{{ $vehicle->type }}</p>
                </div>
                <div class="text-right">
                    <span class="font-headline-lg text-headline-lg text-primary">Rp{{ number_format($vehicle->price_per_day) }}</span>
                    <span class="font-body-md text-body-md text-secondary">/hari</span>
                </div>
            </div>
            <div class="flex space-x-6 text-secondary font-label-md text-label-md border-t border-surface-variant pt-4 mt-6">
                <span class="flex items-center"><span class="material-symbols-outlined mr-2" style="font-size: 18px;">directions_car</span>{{ $vehicle->plate_number }}</span>
                @if($vehicle->avg_rating > 0)
                <span class="flex items-center"><span class="material-symbols-outlined mr-2" style="font-size: 18px;">star</span>{{ number_format($vehicle->avg_rating, 1) }}</span>
                @endif
            </div>
        @else
            <h3 class="font-headline-md text-headline-md text-primary text-2xl mb-1">{{ $vehicle->name }}</h3>
            <p class="font-body-md text-body-md text-secondary mb-4">{{ $vehicle->type }}</p>
            <div class="flex justify-between items-center border-t border-surface-variant pt-4">
                <span class="font-body-md text-body-md text-secondary text-sm">{{ $vehicle->plate_number }}</span>
                <div>
                    <span class="font-headline-md text-headline-md text-primary text-xl">Rp{{ number_format($vehicle->price_per_day) }}</span>
                    <span class="font-caption text-caption text-secondary">/hari</span>
                </div>
            </div>
        @endif
    </div>
</a>

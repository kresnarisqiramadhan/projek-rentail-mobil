@props(['vehicle', 'large' => false])

<div class="{{ $large ? 'lg:col-span-2' : '' }} group relative bg-surface-container-lowest border border-surface-variant rounded-xl overflow-hidden hover:-translate-y-1 hover:shadow-[0_20px_40px_rgba(0,0,0,0.06)] transition-all duration-300 cursor-pointer">
    <div class="{{ $large ? 'h-80' : 'h-60' }} overflow-hidden bg-zinc-100">
        <img alt="{{ $vehicle->name }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out" data-alt="{{ $vehicle->image_alt }}" src="{{ $vehicle->image_url }}"/>
    </div>
    <div class="{{ $large ? 'p-8' : 'p-6' }}">
        @if($large)
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="font-headline-md text-headline-md text-primary">{{ $vehicle->name }}</h3>
                    <p class="font-body-md text-body-md text-secondary mt-1">{{ $vehicle->class }}</p>
                </div>
                <div class="text-right">
                    <span class="font-headline-lg text-headline-lg text-primary">${{ $vehicle->price_per_day }}</span>
                    <span class="font-body-md text-body-md text-secondary">/day</span>
                </div>
            </div>
            <div class="flex space-x-6 text-secondary font-label-md text-label-md border-t border-surface-variant pt-4 mt-6">
                @if($vehicle->acceleration)
                <span class="flex items-center"><span class="material-symbols-outlined mr-2" style="font-size: 18px;">speed</span>{{ $vehicle->acceleration }}</span>
                @endif
                @if($vehicle->seats)
                <span class="flex items-center"><span class="material-symbols-outlined mr-2" style="font-size: 18px;">airline_seat_recline_normal</span>{{ $vehicle->seats }} Seats</span>
                @endif
            </div>
        @else
            <h3 class="font-headline-md text-headline-md text-primary text-2xl mb-1">{{ $vehicle->name }}</h3>
            <p class="font-body-md text-body-md text-secondary mb-4">{{ $vehicle->class }}</p>
            <div class="flex justify-between items-center border-t border-surface-variant pt-4">
                <span class="font-body-md text-body-md text-secondary">
                    @if($vehicle->electric)
                        <span class="material-symbols-outlined align-middle mr-1" style="font-size: 18px;">electric_car</span>Electric
                    @elseif($vehicle->luggage)
                        <span class="material-symbols-outlined align-middle mr-1" style="font-size: 18px;">luggage</span>{{ $vehicle->luggage }} Bags
                    @elseif($vehicle->seats)
                        <span class="material-symbols-outlined align-middle mr-1" style="font-size: 18px;">airline_seat_recline_normal</span>{{ $vehicle->seats }} Seats
                    @endif
                </span>
                <div>
                    <span class="font-headline-md text-headline-md text-primary text-xl">${{ $vehicle->price_per_day }}</span>
                    <span class="font-caption text-caption text-secondary">/day</span>
                </div>
            </div>
        @endif
    </div>
</div>

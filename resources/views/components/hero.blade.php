<section class="relative w-full h-[819px] min-h-[600px] flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0 bg-zinc-100">
        <img alt="Hero Image" class="w-full h-full object-cover object-center opacity-90" src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=1920"/>
    </div>
    <!-- Minimal Overlay Gradient -->
    <div class="absolute inset-0 z-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
    <!-- Content -->
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto mt-20">
        <h1 class="font-display-xl text-display-xl text-white mb-6 drop-shadow-md">Drive Perfection.</h1>
        <p class="font-body-lg text-body-lg text-white/90 mb-12 max-w-2xl mx-auto">Experience the world's most refined vehicles. Curated for those who demand excellence in every detail.</p>
        
        <!-- Search/Filter Bar -->
        <div class="bg-white/95 backdrop-blur-md rounded-full p-2 flex flex-col md:flex-row items-center shadow-2xl max-w-3xl mx-auto border border-white/20">
            <div class="flex-1 flex items-center px-6 py-3 w-full md:w-auto border-b md:border-b-0 md:border-r border-zinc-200">
                <span class="material-symbols-outlined text-zinc-400 mr-3">location_on</span>
                <div class="flex flex-col text-left">
                    <span class="font-label-md text-label-md text-zinc-500">Location</span>
                    <input class="bg-transparent border-none p-0 focus:ring-0 font-body-md text-body-md text-zinc-900 placeholder-zinc-400 w-full" placeholder="Where to?" type="text"/>
                </div>
            </div>
            
            <div class="flex-1 flex items-center px-6 py-3 w-full md:w-auto border-b md:border-b-0 md:border-r border-zinc-200">
                <span class="material-symbols-outlined text-zinc-400 mr-3">calendar_month</span>
                <div class="flex flex-col text-left">
                    <span class="font-label-md text-label-md text-zinc-500">Dates</span>
                    <input class="bg-transparent border-none p-0 focus:ring-0 font-body-md text-body-md text-zinc-900 placeholder-zinc-400 w-full" placeholder="Add dates" type="text"/>
                </div>
            </div>
            
            <!-- Custom Dropdown for Class -->
            <div class="flex-1 px-6 py-3 w-full md:w-auto" x-data="{ open: false, selected: 'All Classes' }">
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-zinc-400 mr-3">directions_car</span>
                    <div class="flex flex-col text-left relative w-full">
                        <span class="font-label-md text-label-md text-zinc-500">Class</span>
                        <button @click="open = !open" class="flex items-center justify-between w-full font-body-md text-body-md text-zinc-900 text-left outline-none">
                            <span x-text="selected"></span>
                            <span class="material-symbols-outlined text-[20px] transition-transform duration-300" :class="open ? 'rotate-180' : ''">expand_more</span>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute left-0 top-full mt-4 w-48 bg-white rounded-2xl shadow-xl border border-zinc-100 overflow-hidden z-50 py-2">
                            <template x-for="option in ['All Classes', 'Executive', 'Sports', 'SUV']">
                                <button @click="selected = option; open = false" 
                                        class="w-full px-4 py-2 text-left text-sm text-zinc-700 hover:bg-zinc-50 transition-colors"
                                        :class="selected === option ? 'bg-zinc-50 font-semibold text-zinc-900' : ''"
                                        x-text="option">
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-2 w-full md:w-auto mt-2 md:mt-0">
                <button class="w-full md:w-auto bg-zinc-900 text-white rounded-full px-8 py-4 font-label-md text-label-md hover:opacity-90 transition-opacity flex items-center justify-center shadow-lg">
                    <span class="material-symbols-outlined mr-2" style="font-size: 20px;">search</span>
                    Explore
                </button>
            </div>
        </div>
    </div>
</section>

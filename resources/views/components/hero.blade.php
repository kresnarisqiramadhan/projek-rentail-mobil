<section class="relative w-full h-[819px] min-h-[600px] flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0 bg-zinc-100">
        <img alt="Hero Image" class="w-full h-full object-cover object-center opacity-90" data-alt="Sleek silver luxury sports car parked on an empty modern concrete architectural surface under soft, diffused natural daylight" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCfcsLwp-HivqV5gHkjFjqKwifp9wqJfkKlw_c0yuYOdTY_VVLDL1eNdt6Zar9wpaecDO9VjrtTXRuWCDLMIzz7XrCa9927Brtk_P_kSJZS0mVmcFGEZbxVH7c-l_ah-Y2sIdEWmkFwNwQG0tFOG9AjIUedUx9lkWO91FGmAAkCJav7ajPqR4seBkh2J3R2qai-_KWz0voiZSnepggzVUZWPAmRzaUhsN6NRS5RHaXleNdVcL5J3JJ18zS5WquWv3FibcVbUx_tWw"/>
    </div>
    <!-- Minimal Overlay Gradient -->
    <div class="absolute inset-0 z-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
    <!-- Content -->
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto mt-20">
        <h1 class="font-display-xl text-display-xl text-white mb-6 drop-shadow-md">Drive Perfection.</h1>
        <p class="font-body-lg text-body-lg text-white/90 mb-12 max-w-2xl mx-auto">Experience the world's most refined vehicles. Curated for those who demand excellence in every detail.</p>
        <!-- Search/Filter Bar -->
        <div class="bg-white/95 backdrop-blur-md rounded-full p-2 flex flex-col md:flex-row items-center shadow-2xl max-w-3xl mx-auto mx-4 border border-white/20">
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
            <div class="flex-1 flex items-center px-6 py-3 w-full md:w-auto">
                <span class="material-symbols-outlined text-zinc-400 mr-3">directions_car</span>
                <div class="flex flex-col text-left">
                    <span class="font-label-md text-label-md text-zinc-500">Class</span>
                    <select class="bg-transparent border-none p-0 focus:ring-0 font-body-md text-body-md text-zinc-900 w-full appearance-none pr-4 cursor-pointer">
                        <option>All Classes</option>
                        <option>Executive</option>
                        <option>Sports</option>
                        <option>SUV</option>
                    </select>
                </div>
            </div>
            <div class="p-2 w-full md:w-auto mt-2 md:mt-0">
                <button class="w-full md:w-auto bg-primary-container text-on-primary rounded-full px-8 py-4 font-label-md text-label-md hover:opacity-80 transition-opacity flex items-center justify-center">
                    <span class="material-symbols-outlined mr-2" style="font-size: 20px;">search</span>
                    Explore
                </button>
            </div>
        </div>
    </div>
</section>

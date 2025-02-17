<div class="w-full relative overflow-hidden rounded-lg shadow-lg"
     x-data="{ 
         autoplay: null,
         startAutoplay() {
             this.autoplay = setInterval(() => $wire.next(), 5000)
         },
         stopAutoplay() {
             clearInterval(this.autoplay)
         }
     }"
     x-init="startAutoplay()"
     @mouseenter="stopAutoplay()"
     @mouseleave="startAutoplay()"
     @keydown.arrow-right.window="$wire.next()"
     @keydown.arrow-left.window="$wire.previous()">

    <div class="relative h-[300px] md:h-[400px] lg:h-[500px]">

        <div wire:loading.block class="absolute inset-0 w-full h-full bg-gray-200 animate-pulse">  {{-- Skeleton Loader --}}
            <div class="h-full w-full object-cover bg-gray-300"></div> {{-- Placeholder image --}}
            <div class="absolute bottom-0 left-0 right-0 bg-gray-400/80 p-6 text-white">
                <div class="h-8 bg-gray-500 rounded w-3/4 mb-2"></div> {{-- Placeholder title --}}
                <div class="h-6 bg-gray-500 rounded w-1/2"></div> {{-- Placeholder button --}}
            </div>
        </div>

        <div wire:loading.remove> {{-- Show carousel only when loading is finished --}}
            @foreach ($cranes as $index => $crane)
                <div class="absolute inset-0 w-full h-full transition duration-500 ease-in-out"
                     :class="{ 'opacity-100 z-10': {{ $currentIndex }} === {{ $index }}, 'opacity-0 z-0': {{ $currentIndex }} !== {{ $index }} }">
                    <img src="http://www.albertacraneservice.com/{{ $crane->images[0]->image_path ?? '' }}"
                         alt="{{ $crane->craneinventory->year ?? '' }} {{ $crane->craneinventory->subject ?? '' }}"
                         class="object-cover w-full h-full"
                         loading="lazy">

                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 text-white">
                        <h3 class="text-xl font-bold mb-2">{{ $crane->craneinventory->year ?? '' }} {{ $crane->craneinventory->subject ?? '' }}</h3>
                        <a href="{{ route('crane', ['id' => $crane->id, 'slug' => $crane->craneInventory->slugName]) }}" class="bg-cyan-600 hover:bg-cyan-700 px-4 py-2 rounded-md text-sm font-medium transition duration-300">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>  {{-- End wire:loading.remove --}}

    </div>


    <div class="absolute left-0 right-0 top-0 p-4 flex justify-between items-center z-20">
        <div class="flex">
            <button class="bg-black/50 hover:bg-black/70 text-white p-3 rounded-full mr-2 transition duration-300 cursor-pointer"
                    wire:click="previous"
                    @click="stopAutoplay(); setTimeout(() => startAutoplay(), 10000)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </button>
            <button class="bg-black/50 hover:bg-black/70 text-white p-3 rounded-full transition duration-300 cursor-pointer"
                    wire:click="next"
                    @click="stopAutoplay(); setTimeout(() => startAutoplay(), 10000)">
                <svg xmlns="http://www.w3.org/2d/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12h-18" />
                </svg>
            </button>
        </div>

        <div class="flex space-x-2">
            @foreach ($cranes as $index => $crane)
                <button wire:click="$set('currentIndex', {{ $index }})"
                        class="w-3 h-3 rounded-full transition-colors duration-300 cursor-pointer"
                        :class="{'bg-cyan-600': {{ $currentIndex }} === {{ $index }}, 'bg-cyan-900 hover:bg-cyan-950': {{ $currentIndex }} !== {{ $index }}}"></button>
            @endforeach
        </div>
    </div>

</div>
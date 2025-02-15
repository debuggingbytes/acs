<div class="w-full flex relative drop-shadow-lg max-h-3/4 cursor-pointer"
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
     
    
    <div class="slide relative w-full">
        <div class="bg-sky-700 p-0 md:p-2 w-full">
            <div class="text-center uppercase text-white font-bold">
                Featured Inventory
            </div>
        </div>
        
        <div class="w-full h-3/4 grid grid-flow-col grid-rows-3 gap-2 gap-2">
            <div class="row-span-3 col-span-3 h-full w-full block">
                <img 
                    src="http://www.albertacraneservice.com/{{ $cranes[$currentIndex]->images[0]->image_path }}"
                    alt="{{ $cranes[$currentIndex]->craneinventory->year }} {{ $cranes[$currentIndex]->craneinventory->subject }}"
                    class="object-cover w-full h-full aspect-3/2"
                    loading="lazy"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
            </div>
            
            <div class="hidden md:block col-span-2">
                <img 
                    src="http://www.albertacraneservice.com/{{ $cranes[$currentIndex]->images[1]->image_path }}"
                    alt="{{ $cranes[$currentIndex]->craneinventory->year }} {{ $cranes[$currentIndex]->craneinventory->subject }}"
                    class="object-cover w-full h-full aspect-3/2"
                    loading="lazy"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
            </div>
            <div class="hidden md:block col-span-2 row-span-2">
                <img 
                    src="http://www.albertacraneservice.com/{{ $cranes[$currentIndex]->images[2]->image_path }}"
                    alt="{{ $cranes[$currentIndex]->craneinventory->year }} {{ $cranes[$currentIndex]->craneinventory->subject }}"
                    class="object-cover w-full h-full aspect-3/2"
                    loading="lazy"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
            </div>
        </div>

        <div class="bg-sky-700 p-0 md:p-2 w-full flex items-center justify-center">
            <span class="text-white font-bold tracking-wide flex gap-1 md:gap-4"
                  x-transition:enter="transition ease-out duration-500"
                  x-transition:enter-start="opacity-0"
                  x-transition:enter-end="opacity-100"
                  x-transition:leave="transition ease-in duration-500"
                  x-transition:leave-start="opacity-100"
                  x-transition:leave-end="opacity-0">
                {{ $cranes[$currentIndex]->craneinventory->year }} 
                {{ $cranes[$currentIndex]->craneinventory->subject }}
            </span>
        </div>

        <!-- Navigation Controls -->
        <div class="absolute left-0 right-0 top-1/2 transform -translate-y-1/2 flex justify-between px-4">
            <button class="bg-black bg-opacity-50 text-white p-2 rounded-full"
                    wire:click="previous"
                    @click="stopAutoplay(); setTimeout(() => startAutoplay(), 10000)">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            
            <button class="bg-black bg-opacity-50 text-white p-2 rounded-full"
                    wire:click="next"
                    @click="stopAutoplay(); setTimeout(() => startAutoplay(), 10000)">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- Pagination Dots -->
        <div class="hidden md:block text-center mt-2">
            @for ($i = 0; $i < count($cranes); $i++)
                <button wire:click="$set('currentIndex', {{ $i }})"
                        class="inline-block w-2 h-2 mx-1 rounded-full transition-colors duration-200"
                        :class="{'bg-sky-700': {{ $currentIndex }} === {{ $i }}, 'bg-gray-400': {{ $currentIndex }} !== {{ $i }}}">
                </button>
            @endfor
        </div>
    </div>
</div>
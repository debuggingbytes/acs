{{-- resources/views/components/image-gallery.blade.php --}}
@env('development')

<div x-data="{ 
    activeImage: 'https://www.albertacraneservice.com' + '{{ $mainImage->image_path }}',
    activeIndex: 0,
    showModal: false,
    thumbnailsPerView: 5,
    startIndex: 0,
    images: {{ json_encode($images->map->image_path) }},
    next() {
        this.activeIndex = (this.activeIndex + 1) % this.images.length;
        this.activeImage = 'https://www.albertacraneservice.com'+this.images[this.activeIndex];
        this.updateThumbnailScroll();
    },
    previous() {
        this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
        this.activeImage = 'https://www.albertacraneservice.com'+this.images[this.activeIndex];
        this.updateThumbnailScroll();
    },
    updateThumbnailScroll() {
        if (this.activeIndex >= this.startIndex + this.thumbnailsPerView) {
            this.startIndex = Math.min(
                this.activeIndex - this.thumbnailsPerView + 1,
                this.images.length - this.thumbnailsPerView
            );
        } else if (this.activeIndex < this.startIndex) {
            this.startIndex = this.activeIndex;
        }
    },
    nextThumbnails() {
        this.startIndex = Math.min(
            this.startIndex + 1,
            this.images.length - this.thumbnailsPerView
        );
    },
    previousThumbnails() {
        this.startIndex = Math.max(0, this.startIndex - 1);
    }
}" class="space-y-4">
@endenv
    {{-- Main Image Container --}}
    <div class="relative overflow-hidden rounded-xl bg-gray-100 aspect-916 ">
        <img 
            :src="activeImage" 
            @click="showModal = true"
            class="w-full object-contain cursor-zoom-in "
            :alt="'{{ $altText }} - Image ' + (activeIndex + 1)"
        >
        
        {{-- Main Image Navigation Arrows --}}
        <button 
            @click="previous"
            class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/80 h-full p-2 hover:bg-white transition-colors duration-200 cursor-pointer"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        
        <button 
            @click="next"
            class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/80 h-full p-2 hover:bg-white transition-colors duration-200 cursor-pointer"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>

    {{-- Thumbnails Carousel --}}
    <div class="relative">
        {{-- Thumbnail Navigation Arrows --}}
        <template x-if="startIndex > 0">
            <button 
                @click="previousThumbnails"
                class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white/90 rounded-full p-1.5 shadow-md hover:bg-white transition-colors duration-200"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
        </template>

        <template x-if="startIndex < images.length - thumbnailsPerView">
            <button 
                @click="nextThumbnails"
                class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white/90 rounded-full p-1.5 shadow-md hover:bg-white transition-colors duration-200"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </template>

        {{-- Thumbnails Container --}}
        <div class="mx-8 overflow-hidden">
            <div 
                class="flex transition-transform duration-300 ease-in-out" 
                :style="'transform: translateX(-' + (startIndex * 20) + '%)'"
            >
                <template x-for="(image, index) in images" :key="index">
                    <button 
                        @click="activeIndex = index; activeImage = image"
                        class="w-1/5 flex-shrink-0 px-1 cursor-pointer"
                        :class="{'opacity-50 hover:opacity-75': activeImage !== image}"
                    >
                        <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg">
                            <img 
                                :src="'https://www.albertacraneservice.com'+image"
                                class="w-full h-16 md:h-32 object-cover transition-all duration-200"
                                :class="{'ring-2 ring-cyan-500': activeImage === image}"
                                :alt="'{{ $altText }} thumbnail ' + (index + 1)"
                            >
                        </div>
                    </button>
                </template>
            </div>
        </div>
    </div>

    {{-- Modal for enlarged view --}}
    <div
        x-show="showModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @keydown.escape.window="showModal = false"
+        role="dialog"
+        aria-modal="true"
+        aria-labelledby="modal-title"
        class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-75 flex items-center justify-center"
        @click.self="showModal = false"
        x-cloak
    >
        <div class="max-w-7xl mx-auto p-4">
            <img 
                :src="activeImage"
                class="max-h-[90vh] w-auto object-contain"
                :alt="'{{ $altText }} - Image ' + (activeIndex + 1)"
            >
            
            {{-- Modal Navigation --}}
            <button 
                @click="previous"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 rounded-full p-2 hover:bg-white transition-colors duration-200 cursor-pointer"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            
            <button 
                @click="next"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 rounded-full p-2 hover:bg-white transition-colors duration-200 cursor-pointer"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            {{-- Close Button --}}
            <button 
                @click="showModal = false"
                class="fixed bottom-1 left-1/2 -translate-x-1/2 w-1/5 bg-white rounded-full text-red-500 p-2 hover:bg-white duration-200 z-50 cursor-pointer"
            >
            <div class="flex items-center justify-center font-bold text-xl gap-2">

                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Close
            </div>
            </button>
        </div>
    </div>
</div>
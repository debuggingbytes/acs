<article class="bg-white rounded-lg overflow-hidden shadow-lg drop-shadow-md transition duration-300 ease-in-out hover:scale-105">  {{-- Modern card styling, hover effect --}}
    <section class="relative h-64 md:h-72 lg:h-80">  {{-- Responsive height for image section --}}
        <img src="https://www.albertacraneservice.com{{ $thumbnail }}" class="object-cover w-full h-full" alt="Used {{ $subject }} for sale" loading="lazy">
        @if($attributes->get('featured') && $attributes->get('available') == 1)
            <div class="absolute top-4 right-4 bg-red-600 text-white uppercase text-xs font-bold py-2 px-4 rounded">Featured</div>  {{-- Improved featured badge --}}
        @endif
        @if(!$attributes->get('available'))
            <div class="absolute top-4 left-4 bg-gray-800 bg-opacity-75 text-white uppercase text-sm font-bold py-2 px-4 rounded">SOLD</div>  {{-- Modernized sold banner --}}
        @endif
    </section>

    <section class="p-4">  {{-- Padding for content --}}
        <div class="flex flex-col justify-between items-start mb-2">  {{-- Title and category alignment --}}
            <h3 class="font-semibold text-lg md:text-xl text-gray-800">{{ $year }} {{ $subject }}</h3>  {{-- Improved title styling --}}
            <div class="text-sm text-gray-600 capitalize">{{ $category }}</div>
        </div>

        <div class="flex justify-between items-center mb-2">  {{-- Condition and views/images --}}
            <span class="text-sm font-medium text-gray-700">Condition: {{ $condition }}</span>
            <div class="flex items-center space-x-2">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                    <span class="text-sm text-gray-600">{{ count($images) }}</span>
                </div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    </svg>
                    <span class="text-sm text-gray-600">{{ $attributes->get('views') }}</span>
                </div>
            </div>
        </div>

        <div class="mb-4">  {{-- Price --}}
            <span class="text-lg font-bold text-cyan-700">{{ $attributes->get('price') }}</span>
        </div>

        @if($attributes->get('details'))
            <div class="mb-4">  {{-- Details --}}
                <p class="text-sm text-gray-700 leading-relaxed line-clamp-4">  {{-- Use line-clamp for truncation --}}
                    {!! nl2br($attributes->get('details')) !!}  {{-- Remove HTML tags from details --}}
                </p>
                <a href="{{ route($route, ['id' => $id, 'slug' => $slug]) }}" wire:navigate class="text-cyan-600 hover:underline text-sm">More Details</a>  {{-- "More Details" link --}}
            </div>
        @endif

        <div class="text-center">  {{-- View Inventory button --}}
            <a href="{{ route($route, ['id' => $id, 'slug' => $slug]) }}" wire:navigate
               class="bg-cyan-700 hover:bg-cyan-800 text-white font-medium py-2 px-6 rounded-lg transition duration-300 ease-in-out">
                View Inventory
            </a>
        </div>
    </section>
</article>
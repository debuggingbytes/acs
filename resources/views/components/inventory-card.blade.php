<article class="bg-neutral-100 rounded-md overflow-hidden border-cyan-700 border-2 flex flex-col justify-between shadow-md">
    {{-- Thumbnail image and Sold / Feature banner --}}
    <section class="w-100 h-60 relative">
        <img src="{{ $thumbnail }}" class="object-cover w-full h-full" alt="Used {{ $subject }} for sale" loading="lazy">
        @if($attributes->get('featured') && $attributes->get('available') == 1)
        <div class="absolute top-0 right-0 bg-red-500 text-white uppercase text-xs font-bold py-3 px-5 rounded-bl">Featured</div>
        @endif
        @if(!$attributes->get('available'))
        <div class="absolute top-3 -right-9  z-[9] h-full rounded-lg">
            <div class="flex w-100 z-20 justify-center items-center">
                <span class="block text-2xl py-1 px-8 shadow-lg text-red-500 text-center rotate-45 bg-white uppercase font-bold">SOLD</span>
            </div>
        </div>
        @endif
    </section>
    {{-- Subject & Category --}}
    <section class="flex flex-col lg:flex-row text-center justify-between p-1 lg:text-start">
        <div class="font-bold">
            <h3>{{ substr($year." ".$subject,0,30) }}</h3>
        </div>
        <div class="capitalize truncate">
            {{$category}}
        </div>
    </section>
    {{-- Condition & Views --}}
    <section class='pt-1 px-1'>
        <div class="flex justify-between gap-2">
            <div class="text-sm font-semibold">Condition: {{$condition}}</div>
            <div class="text-sm font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 inline-block" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
                {{count($images)}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline-block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  </svg>
                {{$attributes->get('views')}}
            </div>
        </div>
        <div class="flex">
            <div class="text-sm font-semibold">Price: {{$attributes->get('price') }}</div>
        </div>
    </section>
    {{-- Details --}}
    @if($attributes->get('details'))
    <section class="min-h-24 max-h-24 p-1">
        <div class="border-l-2 border-cyan-600 pl-1">
            @php
            $link = route($route, ['id' => $id, 'slug' => $slug]);
            @endphp
            <span class="">
                @bb(substr($attributes->get('details'), 0, 75) . '... <a wire:navigate href="'.$link.'" class="font-semibold">More Details</a>')
            </span>
        </div>
    </section>
    @endif
    {{-- Href --}}
    <section class="px-1 py-1">
        <div class="w-full text-center">
            <a href="{{ route($route, ['id' => $id, 'slug' => $slug]) }}" wire:navigate class="px-3 py-2 block bg-cyan-800 rounded-md text-white uppercase font-md transition-all ease-in-out hover:bg-cyan-500">View Inventory</a>
        </div>
    </section>
</article>

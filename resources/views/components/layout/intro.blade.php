<section class="mb-16 container mx-auto p-2 min-h-[70svh]"> 
    <h2 class="text-3xl font-bold mb-4">Find Your Perfect Used Crane or Heavy Equipment</h2>
    <p class="text-gray-800 leading-relaxed text-lg">
        Leverage our 30+ years of crane operating experience when you're looking for <strong>used
            cranes</strong>
        or
        <strong>heavy equipment</strong>. At Alberta Crane Service Ltd., we know what quality looks like. Our
        <strong>extensive</strong> and <strong>up-to-date inventory</strong> spans the <strong>United
            States</strong>,
        <strong>Canada</strong>, and <strong>Europe</strong>, offering a wide selection of <strong>all-terrain
            cranes</strong>, <strong>truck mounts</strong>, <strong>rough terrains</strong>, <strong>carry
            decks</strong>,
        and all the <strong>crane parts</strong> you need. We ensure <strong>thorough inspections</strong> on
        every piece
        of equipment before it's sold, ensuring your satisfaction. Browse our <a href="{{ route('inventory') }}"
            wire:navigate class="text-sky-950 text-md underline">inventory
            online</a> or contact our <strong>expert team</strong> for personalized assistance.
    </p>
    <div class="flex flex-col md:flex-row gap-1 md:gap-5 mt-10">
        <div class="grid grid-flow-col grid-rows-2 gap-2 w-full md:w-1/2">
            <div class="row-span-3 bg-gray-900 h-94 block max-w-fit relative">
                <img src="{{ asset('img/Liebherr-telescopic-crawler-crane.png') }}" alt="Alberta Crane Service" class="transition duration-300 ease-in-out hover:scale-105 h-full w-full object-cover drop-shadow-[0_5px_5px_rgba(0,0,0,0.75)]">
            </div>
            <div class="col-span-2 h-46 bg-cyan-500 block">
                <img src="{{ asset('img/tadano-gr-1200xl.png') }}" alt="Alberta Crane Service" class="transition duration-300 ease-in-out hover:scale-105 h-full w-full object-cover drop-shadow-[0_5px_5px_rgba(0,0,0,0.75)]">
            </div>
            <div class="col-span-2 h-46 row-span-2 bg-sky-400">
                <img src="https://www.albertacraneservice.com/storage/inventory/102/2008-liebherr-ltm1090-41_c4f726a1-2add-4eef-b0ee-f9e856552862.webp" alt="Alberta Crane Service" class="transition duration-300 ease-in-out hover:scale-105 h-full w-full object-cover drop-shadow-[0_5px_5px_rgba(0,0,0,0.75)]">
            </div>
        </div>
        <div class="w-full md:w-1/2 flex flex-col h-full p-1 md:p-5">
            <h3 class="text-2xl font-bold mb-4">Used Crane Inventory</h3>
            <p class="text-gray-800 leading-relaxed">
            <menu class="flex flex-col md:grid md:grid-cols-2 gap-1 md:gap-5 text-center">
                @foreach ($types as $type)
                <li class="p-1 md:p-2 bg-slate-300 h-12 border-s-4 border-cyan-700 flex items-center relative overflow-hidden transition-colors duration-300 ease-in-out group">
                    <div class="absolute inset-y-0 left-0 w-0 bg-cyan-700 transition-all duration-300 ease-in-out group-hover:w-full z-0"></div>  {{-- Overlay --}}
                    <strong class="relative z-10 group-hover:text-white transition duration-300 ease-in-out">
                        <a href='' wire:navigate>{{ ucwords(Str::replace("_", ' ', $type)) }}</a>
                    </strong>
                </li>
                @endforeach
                <li class="col-span-2 mt-5 md:mt-0">
                    <a href='' wire:navigate class="block md:inline px-4 py-2 bg-cyan-600 text-white font-bold">View Crane Inventory</a>
                </li>
            </menu>
            </p>
        </div>
    </div>
</section>
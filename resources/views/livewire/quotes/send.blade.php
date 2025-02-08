<div class="p-2">
    <span class="text-2xl text-cyan-700 font-bold">Make a quote</span>
    <p class="my-10">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsam dicta doloribus blanditiis laborum
        hic eos animi unde mollitia doloremque excepturi?</p>

    <span class="text-2xl">PDF Preview</span>
    <div class="border-2 p-2 shadow">
    <div class="flex gap-4 w-full">
        <div id="quote-logo">
            <img src="{{ asset('img/acs-logo-new.webp')}}" alt="logo" class="w-120">
        </div>
        <div id="prepared-by" class="flex gap-2 w-1/4 flex-col justify-between">
            <div class="flex flex-col">
                <span class="font-bold">Prepared by:</span>
                <span>{{ Auth::user()->name }}</span>
            </div>
            <div class="flex">
                <span class="font-bold">Alberta Crane Service Ltd.</span>
            </div>
            <div class="flex">
                <span class="font-bold">Edmonton, AB, T6X0T8, Canada</span>
            </div>
            <div class="flex flex-col">
                <span>{{ Auth::user()->email }}</span>
            </div>
            <div class="flex flex-col">
                <span>1-780-803-2302</span>
            </div>
        </div>
        <div id="prepared-for" class="flex gap-2 w-1/4 flex-col justify-between">
            <div class="flex flex-col">
                <span class="font-bold">Prepared For:</span>
                <span>NAME</span>
            </div>
            <div class="flex">
                <span class="font-bold">COMPANY NAME</span>
            </div>
            <div class="flex">
                <span class="font-bold">LOCATION</span>
            </div>
            <div class="flex flex-col">
                <span>CLIENT EMAIL</span>
            </div>
            <div class="flex flex-col">
                <span>CLIENT PHONE</span>
            </div>
        </div>
        <div id="additional-info" class="flex flex-col w-1/4 justify-between">
            <div class="flex flex-col">
                <span class="font-bold">Created On:</span>
                <span>{{ $todaysDate }}</span>
            </div>
            <div class="flex flex-col w-full">
                <span class="font-bold">Total Price:</span>
                <span class="flex justify-center items-center w-5/6 h-12 mx-auto my-1 border-2 border-black text-2xl">
                    $1,000,000
                </span>
            </div>
            <div class="flex flex-col">
                <span class="font-bold">Currency Type:</span>
                <span class="flex justify-center items-center w-5/6 h-12 mx-auto my-1 border-2 border-black text-2xl">
                    U.S Dollars
                </span>
            </div>
        </div>
    </div>
    {{-- Item Information --}}
    <div class="grid grid-cols-7 text-center border-2 gap-4 mt-20 p-2">
        {{-- Headers --}}
        <div class="flex flex-col col-span-2 h-12">
            <span class="font-bold">ITEM</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">QUANTITY</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">QUOTED PRICED</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">LIST PRICE</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">SHIPPING PRICE</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">LINE ITEM TOTAL</span>
        </div>
        {{-- Cells --}}
        <div class="flex flex-col col-span-2">
            <span
                class="font-bold">{{ $inventory->craneInventory->subject ?? $inventory->partInventory->subject ?? $inventory->equipmentInventory->subject ?? "ERROR" }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">1</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">1,000,000</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">0</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">0</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">1,000,000</span>
        </div>
    </div>
    {{-- Call to Action --}}
    <div class="flex justify-end items-end w-full p-2">
        <a href="#" class="bg-cyan-700 text-white p-2 rounded-md">View on Web</a>
    </div>
    {{-- Images --}}
    <div class="flex p-2">
        <div class="flex flex-col md:flex-row w-full gap-4">
            {{-- left column --}}
            <div class="flex w-full @if(count($inventory->images) < 1) md:w-1/2 @endif">
                <img src='{{ asset($inventory->thumbnail)}}' alt="crane" class="@if(count($inventory->images) <= 1) w-1/2 mx-auto @else w-120 @endif rounded shadow">
            </div>
            {{-- right column --}}
            @if(count($inventory->images) > 1)
                <div class="grid grid-cols-2 gap-3 w-full md:w-1/2">
                    @foreach ($inventory->images as $image)
                        @if($loop->iteration > 6)
                            @break
                        @endif
                        <div class="flex justify-center items-center w-full">
                            {{-- @dd($inventory->images[$i + 1]->image_path) --}}
                            <img src='{{ asset($image->image_path) }}' alt="crane"
                                class="w-full h-48 object-fill rounded shadow">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Equipment Information --}}
    <span class="text-2xl text-cyan-700 font-bold my-10">Specification</span>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2 mt-5 w-3/4 mx-auto">
        <div class="flex gap-2">
            <span class="font-bold w-1/3 bg-gray-400 p-2">Make:</span>
            <span class="p-2">{{ $inventory->craneInventory->make ?? $inventory->equipmentInventory->make ?? $inventory->partsInventory->make ?? "ERROR" }}</span>
        </div>
        <div class="flex gap-2">
            <span class="font-bold w-1/3 bg-gray-400 p-2">Model:</span>
            <span class="p-2">{{ $inventory->craneInventory->model ?? $inventory->equipmentInventory->model ?? $inventory->partsInventory->model ?? "ERROR" }}</span>

        </div>
        <div class="flex gap-2">
            <span class="font-bold w-1/3 bg-gray-400 p-2">Year:</span>
            <span class="p-2">{{ $inventory->craneInventory->year ?? $inventory->equipmentInventory->year ?? $inventory->partsInventory->year ?? "ERROR" }}</span>

        </div>
        <div class="flex gap-2">
            <span class="font-bold w-1/3 bg-gray-400 p-2">Capacity:</span>
            <span class="p-2">{{ $inventory->craneInventory->capacity ?? $inventory->equipmentInventory->capacity ?? $inventory->partsInventory->capacity ?? "ERROR" }}</span>

        </div>
        @if ($inventory->craneInventory)
            <div class="flex gap-2">
                <span class="font-bold w-1/3 bg-gray-400 p-2">Boom:</span>
                <span class="p-2">{{ $inventory->craneInventory->boom ?? "ERROR" }}</span>
            </div>
            <div class="flex gap-2">
                <span class="font-bold w-1/3 bg-gray-400 p-2">Jib:</span>
                <span class="p-2">{{ $inventory->craneInventory->jib ?? "ERROR" }}</span>
            </div>

        @endif

        @isset($inventory->craneInventory->hours)
        <div class="flex gap-2">
            <span class="font-bold w-1/3 bg-gray-400 p-2">Hours:</span>
            <span class="p-2">{{ $inventory->craneInventory->hours ?? $inventory->equipmentInventory->hours ?? $inventory->partsInventory->hours  }}</span>
        </div>
        @endisset
        <div class="flex gap-2">
            <span class="font-bold w-1/3 bg-gray-400 p-2">Price:</span>
            <span class="p-2">$1,000,000</span>
        </div>
    </div>
    {{-- Details --}}
    <div class="w-3/4 mx-auto mt-10 p-2">
        @bb(nl2br($inventory->craneInventory->description ?? $inventory->partsInventory->description ?? $inventory->equipmentInventory->description ?? "ERROR"))
    </div>
    {{-- Contact --}}
    <div class="p-2 text-center w-3/4 mx-auto">
        <span class="mt-5">For more information please contact <span class="font-bold">{{ Auth::user()->name }}</span>, thank you for
            your consideration</span>
    </div>
    {{-- Item Information --}}
    <div class="grid grid-cols-7 text-center border-2 gap-4 mt-20 p-2">
        {{-- Headers --}}
        <div class="flex flex-col col-span-2 h-12">
            <span class="font-bold">ITEM</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">QUANTITY</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">QUOTED PRICED</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">LIST PRICE</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">SHIPPING PRICE</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">LINE ITEM TOTAL</span>
        </div>
        {{-- Cells --}}
        <div class="flex flex-col col-span-2">
            <span class="font-bold">Crane Name</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">1</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">1,000,000</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">0</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">0</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">1,000,000</span>
        </div>
    </div>

    </div>
</div>

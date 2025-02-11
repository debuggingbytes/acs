<div class="p-2 relative">  {{-- Relative for positioning the tab --}}
    <span class="text-2xl px-4 text-cyan-700 font-bold">Make a quote</span>
    <p class="mt-10 mb-5 px-4">
        Please fill out the form below, values will be auto populated on the PDF preview.  Once you save the form, the PDF will be created
        and you will be able to download it.  You will be redirected to the quote page where you can view, edit, or delete the quote and finally send it to the client.
    </p>
    <p class="px-4">
        This quote form is currently in a beta phase, You are currently limited to one item per quote.  If you would like to add multiple items, please create a new quote for each item.
        More Features will be developed at a later date.
    </p>
    <p class="mb-10 px-4">
        <x-alert info title="Price Format" @class(["bg-blue-500", "text-white"])>
            <x-slot name="slot">
                When inputting the price, please use the following format: 1234.56
            </x-slot>
        </x-alert>
    </p>
    @if(session('status'))
        @php
            switch (session('status.type')) {
                case 'success':
                    $colour = ['bg-green-500', 'text-green-800'];
                    break;
                case 'negative':
                    $colour = ['bg-red-500', 'text-red-800'];
                    break;
                case 'warning':
                    $colour = ['bg-yellow-500', 'text-yellow-800'];
                    break;
                case 'info':
                    $colour = ['bg-blue-500', 'text-blue-800'];
                    break;
                default:
                    $colour = ['bg-gray-500', 'text-gray-800'];
                    break;
            }
        @endphp
        <x-alert title="{{session('status.title')}}" @class([$colour[0], $colour[1]])>
            <x-slot name="slot">{{ session('status.message') }}</x-slot>
        </x-alert>
    @endif

    <div class="container mx-auto p-4">
    <form wire:submit.prevent="submit" class="space-y-4">

        <div class="flex flex-col gap-4">  {{-- Responsive grid --}}
            <div>
                <label for="clientName" class="block text-sm font-medium text-gray-700">Client Name</label>
                <input type="text" id="clientName" wire:model.live="clientName"
                       class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm"
                       required>
                @error('clientName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="clientCompany" class="block text-sm font-medium text-gray-700">Client Company</label>
                <input type="text" id="clientCompany" wire:model.live="clientCompany"
                       class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm">
                @error('clientCompany') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            </div>
        </div>

        <div class="flex flex-col gap-4">
            <div>
                <label for="clientEmail" class="block text-sm font-medium text-gray-700">Client Email</label>
                <input type="email" id="clientEmail" wire:model.live="clientEmail"
                       class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm"
                       required>
                @error('clientEmail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="clientPhone" class="block text-sm font-medium text-gray-700">Client Phone</label>
                <input type="tel" id="clientPhone" wire:model.live="clientPhone"
                       class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm">
                @error('clientPhone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="clientAddress" class="block text-sm font-medium text-gray-700">Client Address</label>
            <input id="clientAddress" wire:model.live="clientAddress" required
                      class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm"
            @error('clientAddress') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>


        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="text" step="0.01" id="price" wire:model.blur="price"
                       class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm"
                       required>
                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="text" step="0.01" id="price" wire:model.live="quantity"
                       class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm"
                       required>
                @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                <input type="text" step="0.01" id="price" wire:model.live="currency"
                       class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm"
                       required>
                @error('currency') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="listPrice" class="block text-sm font-medium text-gray-700">List Price</label>
                <input type="text" step="0.01" id="listPrice" wire:model.blur="listPrice"
                       class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm">
                @error('listPrice') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="shippingPrice" class="block text-sm font-medium text-gray-700">Shipping Price</label>
                <input type="text" step="0.01" id="shippingPrice" wire:model.blur="shippingPrice"
                    class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm">
                @error('shippingPrice') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="lineItem" class="block text-sm font-medium text-gray-700">Line Item</label>
                <input type="text" step="0.01" id="lineItem" wire:model.live="lineItem"
                    class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm">
                @error('lineItem') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
        </div>

        <button wire:click='submit'type="submit"
                class="w-full rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
            Submit
        </button>
    </form>
</div>
<span class="text-2xl">PDF Preview</span>
<div class="border-2 p-2 shadow">
    <div class="p-2 flex w-full items-center justify-end text-sm font-bold text-black">
        ACS-AUTO-Generated
    </div>
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
                <span>{{$clientName}}</span>
            </div>
            <div class="flex">
                <span class="font-bold">{{ $clientCompany }}</span>
            </div>
            <div class="flex">
                <span class="font-bold">{{ $clientAddress }}</span>
            </div>
            <div class="flex flex-col">
                <span> {{ $clientEmail }}</span>
            </div>
            <div class="flex flex-col">
                <span>{{ $clientPhone }}</span>
            </div>
        </div>
        <div id="additional-info" class="flex flex-col w-1/4 justify-between">
            <div class="flex flex-col">
                <span class="font-bold">Created On:</span>
                <span>{{ $todaysDate }}</span>
            </div>
            <div class="flex flex-col w-full">
                <span class="font-bold">Total Price:</span>
                <span class="flex justify-center items-center w-5/6 p-2 mx-auto my-1 border-2 border-black text-2xl">
                    {{ $price }}
                </span>
            </div>
            <div class="flex flex-col">
                <span class="font-bold">Currency Type:</span>
                <span class="flex justify-center items-center w-5/6 p-2 mx-auto my-1 border-2 border-black text-2xl">
                    {{ $currency }}
                </span>
            </div>
        </div>
    </div>
    {{-- Item Information --}}
    <div class="grid grid-cols-7 text-center border-2 gap-4 mt-20 p-2">
        {{-- Headers --}}
        <div class="flex flex-col col-span-2 p-2">
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
            <span class="font-bold">{{ $quantity }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">{{ $price }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">{{ $listPrice }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">{{ $shippingPrice }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">{{ $lineItem }}</span>
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
    <div class="flex flex-col gap-2 p-2 mt-5 w-3/4 mx-auto">
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
        @if ($inventory->craneInventory)
        <div class="flex gap-2">
            <span class="font-bold w-1/3 bg-gray-400 p-2">Capacity:</span>
            <span class="p-2">{{ $inventory->craneInventory->capacity ?? $inventory->equipmentInventory->capacity ?? $inventory->partsInventory->capacity ?? "ERROR" }}</span>

        </div>
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
            <span class="p-2">{{$price}}</span>
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
        <div class="flex flex-col col-span-2 p-2">
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
            <span class="font-bold">{{ $quantity }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">{{ $price }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">{{ $listPrice }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">{{ $shippingPrice }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">{{ $lineItem }}</span>
        </div>
    </div>

</div>
</div>

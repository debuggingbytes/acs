<div class="flex flex-col mb-10 p-2 w-full">
    <div class="hidden lg:block -my-2 overflow-x-auto sm:-mx-6 w-full">
        <div class="py-2 align-middle block min-w-full sm:px-6 lg:px-6 w-full">
            <div class="px-2 py-1 grid grid-cols-5 gap-3 w-full">
                <div class="">Search Filter: </div>
                <select class="px-2 py-1 bg-sky-200/80 text-sm" wire:model.live='selectedMake'>
                    <option selected value="">Filter By Manufacture</option>
                    @foreach ($makes as $make)
                        <option value="{{$make}}">{{$make}}</option>
                    @endforeach
                </select>
                <select class="px-2 py-1 bg-sky-200/80 text-sm" wire:model.live='selectedModel'>
                    <option selected value=''>Filter by Model</option>
                    @foreach ($models as $model)
                    <option value="{{$model}}">{{$model}}</option>
                @endforeach
                </select>
                <select class="px-2 py-1 bg-sky-200/80 text-sm" wire:model.live='selectedYear'>
                    <option selected value="">Filter by Year</option>
                    @foreach ($years as $year)
                        <option value="{{$year}}">{{$year}}</option>
                    @endforeach
                </select>
                <button class="px-3 py-1.5 bg-amber-500 text-white uppercase rounded-xl shadow-md font-bold" wire:click.prevent='resetFilter'>Reset</button>
            </div>
            <div class="overflow-hidden  border-2 rounded-lg w-full">
                <div class="bg-cyan-700 px-2 py-1">
                    <!-- Table header -->
                    <div class="flex w-full gap-3 font-bold justify-between items-center uppercase text-white h-8">
                        <div class="truncate w-4/12 text-center">Name</div>
                        <div class="truncate w-1/12 text-center">year</div>
                        <div class="truncate w-2/12 text-center">make</div>
                        <div class="truncate w-1/12 text-center">S/N</div>
                        <div class=" w-1/12 text-center">Featured</div>
                        <div class=" w-1/12 text-center">Available</div>
                        <div class="truncate w-2/12 text-center">Price</div>
                    </div>
                </div>
                <div class="bg-white divide-y divide-gray-200">
                    <!-- Table rows -->
                    @foreach ($inventories as $index => $inventory)
                    <div class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200 cursor-pointer px-2 py-1" wire:click='editInventory({{$inventory->id}})'>
                        <div class="flex w-full gap-2 text-gray-800  justify-between">
                            <div class="truncate w-4/12 text-center">{{ $inventory->craneInventory->subject ?? $inventory->partInventory->subject ?? $inventory->equipmentInventory->subject }}</div>
                            <div class="truncate w-1/12 text-center">{{ $inventory->craneInventory->year ?? $inventory->partInventory->year  ?? $inventory->equipmentInventory->year }}</div>
                            <div class="truncate w-2/12 text-center">{{ $inventory->craneInventory->make ?? $inventory->partInventory->make ?? $inventory->equipmentInventory->make }}</div>
                            <div class="truncate w-1/12 text-center">{{ $inventory->serial_number }}</div>
                            <div class="truncate w-1/12 flex justify-center items-center">
                                @if($inventory->is_featured)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none" />
                                  </svg>
                                @endif
                                </div>
                            <div class="truncate w-1/12 text-center flex justify-center items-center font-bold">
                                @if($inventory->is_available)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none" />
                                  </svg>
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none" />
                                  </svg>
                                @endif
                            </div>
                            <div class="truncate w-2/12 text-center">
                                {{ $inventory->cost }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="lg:hidden">
        <!-- Mobile View -->
        @foreach ($inventories as $index => $inventory)
            <div class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200 cursor-pointer mb-4 px-2 py-1" wire:click='editInventory({{$inventory->id}})'>
                <div class="flex flex-row gap-1 text-gray-800">
                    @isset($inventory->thumbnail)
                    <div class="w-1/4">
                        <img src="{{$inventory->thumbnail}}" class="content-fit w-full h-full">
                    </div>
                    @endisset
                    <div class="w-3/4">
                        <div class="truncate text-center">{{ $inventory->craneInventory->subject ?? $inventory->partInventory->subject ?? $inventory->equipmentInventory->subject }}</div>
                        <div class="truncate text-center">{{ $inventory->craneInventory->year ?? $inventory->partInventory->year  ?? $inventory->equipmentInventory->year }}</div>
                        <div class="truncate text-center">{{ $inventory->craneInventory->make ?? $inventory->partInventory->make ?? $inventory->equipmentInventory->make }}</div>
                        <div class="truncate text-center">{{ $inventory->serial_number }}</div>
                        <div class="truncate text-center">{{ $inventory->craneInventory ? "Crane" : 'Parts'}}</div>
                        <div class="truncate text-center">{{ $inventory->is_featured ? 'Featured' : '' }}</div>
                        <div class="truncate text-center">{{ $inventory->is_available ? 'Available' : 'Unavailable' }}</div>
                        <div class="truncate text-center">{{ $inventory->cost }}</div>

                    </div>

                </div>
            </div>
        @endforeach
    </div>

</div>

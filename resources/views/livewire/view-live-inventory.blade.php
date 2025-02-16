<div class="container mx-auto p-4">  {{-- Main container --}}

    <div class="mb-8">  {{-- Filter Section --}}
        <h3 class="font-bold text-2xl text-cyan-700 mb-4">Filter Results</h3>

        <div class="mb-4">  {{-- Keyword Search --}}
            <label for="search" class="block text-gray-700 font-medium mb-2">Keywords:</label>
            <input type="text" id="search" name="search" wire:model.live="query" wire:keydown="searchInventory"
                   class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-cyan-500"
                   placeholder="Enter keywords (make, model, capacity, etc.)">
        </div>

        @if (!empty($query))  {{-- Display Searched Keywords --}}
            <div class="bg-zinc-100 rounded-lg p-4 mb-4">
                <div class="text-xl text-center mb-2">
                    Showing {{$totalResults}} {{ Str::plural("result", $totalResults) }} for:
                </div>
                <div class="flex flex-wrap gap-2 justify-center">
                    @foreach (explode(" ", $query) as $keyword)
                        <div class="bg-cyan-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                            {{ $keyword }}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">  {{-- Select Filters --}}
            <select wire:model.live="selectedMake"
                    class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                <option value="">Filter By Manufacturer [{{ count($makes) }}]</option>
                @foreach ($makes as $make)
                    <option value="{{ $make }}">{{ $make }}</option>
                @endforeach
            </select>

            <select wire:model.live="selectedModel"
                    class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                <option value="">Filter By Model [{{ count($models) }}]</option>
                @foreach ($models as $model)
                    <option value="{{ $model }}">{{ $model }}</option>
                @endforeach
            </select>

            <select wire:model.live="selectedYear"
                    class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                <option value="">Filter By Year [{{ count($years) }}]</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">  {{-- Reset Button --}}
            <button wire:click.prevent="resetFilter"
                    class="bg-cyan-700 hover:bg-cyan-800 text-white font-medium py-2 px-6 rounded-lg transition duration-300 ease-in-out">
                Reset Filters
            </button>
        </div>
    </div>

    <div class="flex justify-end items-center mb-4">  {{-- View Toggle --}}
        <button wire:click="$set('view', 'grid')"
                class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium mr-2 @if ($view === 'grid') bg-gray-300 @endif">
            <i class="fas fa-th-large mr-2"></i> Grid View
        </button>
        <button wire:click="$set('view', 'list')"
                class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium @if ($view === 'list') bg-gray-300 @endif">
            <i class="fas fa-list mr-2"></i> List View
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
         x-show="$wire.view === 'grid'">
        @foreach ($inventories as $inventory)
            @if($inventory->is_public)
                @if ($inventory->inventoryable_type == "App\Models\CraneInventory")
                    <x-inventory-card :loop="$loop->iteration" :category="$inventory->craneInventory->readabletype"
                                      :year="$inventory->craneInventory->year" :subject="$inventory->craneInventory->subject"
                                      :capacity="$inventory->craneInventory->capacity" :condition="$inventory->craneInventory->condition"
                                      :images="$inventory->images" :id="$inventory->id" :slug="$inventory->craneInventory->slugName" route="crane"
                                      :thumbnail="$inventory->thumbnail" :details="$inventory->craneInventory->description"
                                      :featured="$inventory->is_featured" :available="$inventory->is_available"
                                      :views="count($inventory->uniqueViews)" :price="$inventory->cost" />
                @elseif ($inventory->inventoryable_type == "App\Models\PartInventory")
                    <x-inventory-card :loop="$loop->iteration" :category="$inventory->partInventory->readabletype"
                                      :year="$inventory->partInventory->year" :subject="$inventory->partInventory->subject"
                                      :capacity="$inventory->partInventory->capacity" :condition="$inventory->partInventory->condition"
                                      :images="$inventory->images" :id="$inventory->id" :slug="$inventory->partInventory->slugName" route="part"
                                      :thumbnail="$inventory->thumbnail" :details="$inventory->partInventory->description"
                                      :featured="$inventory->is_featured" :available="$inventory->is_available"
                                      :views="count($inventory->uniqueViews)" :price="$inventory->cost" />
                @elseif ($inventory->inventoryable_type == "App\Models\EquipmentInventory")
                    <x-inventory-card :loop="$loop->iteration" :category="$inventory->equipmentInventory->readabletype"
                                      :year="$inventory->equipmentInventory->year" :subject="$inventory->equipmentInventory->subject"
                                      :capacity="$inventory->equipmentInventory->capacity" :condition="$inventory->equipmentInventory->condition"
                                      :images="$inventory->images" :id="$inventory->id" :slug="$inventory->equipmentInventory->slugName"
                                      route="equipment" :thumbnail="$inventory->thumbnail" :details="$inventory->equipmentInventory->description"
                                      :featured="$inventory->is_featured" :available="$inventory->is_available"
                                      :views="count($inventory->uniqueViews)" :price="$inventory->cost" />
                @endif
            @endif
        @endforeach
    </div>
    <div x-show="$wire.view === 'list'">  {{-- List View --}}
        @foreach ($inventories as $inventory)
            @if($inventory->is_public)
                @if ($inventory->inventoryable_type == "App\Models\CraneInventory")
                    <article class="bg-white rounded-lg shadow-md p-4 mb-4 transition duration-300 ease-in-out hover:scale-105 flex flex-col md:flex-row">
                        <img src="https://www.albertacraneservice.com{{ $inventory->thumbnail }}" alt="Used {{ $inventory->craneInventory->subject }} for sale" class="hidden md:block w-32 h-32 object-cover rounded-l-lg mr-4">
                        <div class="flex-grow">
                            <h3 class="font-semibold text-lg text-gray-800 mb-1">{{ $inventory->craneInventory->year }} {{ $inventory->craneInventory->subject }}</h3>
                            <p class="text-sm text-gray-600 capitalize">{{ $inventory->craneInventory->readabletype }} | {{ $inventory->craneInventory->condition }}</p>
                            <p class="text-gray-700 leading-relaxed line-clamp-2">{{ $inventory->craneInventory->description }}</p>
                            <a href="{{ route('crane', ['id' => $inventory->id, 'slug' => $inventory->craneInventory->slugName]) }}" wire:navigate class="text-cyan-600 hover:underline text-sm mt-2 inline-block">More Details</a>
                        </div>
                        <div class="flex-shrink-0 ml-4">
                            <span class="text-lg font-bold text-cyan-700 mb-2">{{ $inventory->cost }}</span>
                            <a href="{{ route('crane', ['id' => $inventory->id, 'slug' => $inventory->craneInventory->slugName]) }}" wire:navigate
                               class="text-center bg-cyan-700 hover:bg-cyan-800 text-white font-medium py-2 px-4 rounded-lg transition duration-300 ease-in-out block">
                                View
                            </a>
                        </div>
                    </article>
                @elseif ($inventory->inventoryable_type == "App\Models\PartInventory")
                    <article class="bg-white rounded-lg shadow-md p-4 mb-4 transition duration-300 ease-in-out hover:scale-105 flex flex-col md:flex-row">
                        <img src="https://www.albertacraneservice.com{{ $inventory->thumbnail }}" alt="Used {{ $inventory->partInventory->subject }} for sale" class="w-32 h-32 object-cover rounded-l-lg mr-4">
                        <div class="flex-grow">
                            <h3 class="font-semibold text-lg text-gray-800 mb-1">{{ $inventory->partInventory->year }} {{ $inventory->partInventory->subject }}</h3>
                            <p class="text-sm text-gray-600 capitalize">{{ $inventory->partInventory->readabletype }} | {{ $inventory->partInventory->condition }}</p>
                            <p class="text-gray-700 leading-relaxed line-clamp-2">{{ $inventory->partInventory->description }}</p>
                            <a href="{{ route('part', ['id' => $inventory->id, 'slug' => $inventory->partInventory->slugName]) }}" wire:navigate class="text-cyan-600 hover:underline text-sm mt-2 inline-block">More Details</a>
                        </div>
                        <div class="flex-shrink-0 ml-4">
                            <span class="text-lg font-bold text-cyan-700 mb-2">{{ $inventory->cost }}</span>
                            <a href="{{ route('part', ['id' => $inventory->id, 'slug' => $inventory->partInventory->slugName]) }}" wire:navigate
                               class="text-center bg-cyan-700 hover:bg-cyan-800 text-white font-medium py-2 px-4 rounded-lg transition duration-300 ease-in-out block">
                                View
                            </a>
                        </div>
                    </article>
                @elseif ($inventory->inventoryable_type == "App\Models\EquipmentInventory")
                    <article class="bg-white rounded-lg shadow-md p-4 mb-4 transition duration-300 ease-in-out hover:scale-105 flex flex-col md:flex-row">
                        <img src="https://www.albertacraneservice.com{{ $inventory->thumbnail }}" alt="Used {{ $inventory->equipmentInventory->subject }} for sale" class="w-32 h-32 object-cover rounded-l-lg mr-4">
                        <div class="flex-grow">
                            <h3 class="font-semibold text-lg text-gray-800 mb-1">{{ $inventory->equipmentInventory->year }} {{ $inventory->equipmentInventory->subject }}</h3>
                            <p class="text-sm text-gray-600 capitalize">{{ $inventory->equipmentInventory->readabletype }} | {{ $inventory->equipmentInventory->condition }}</p>
                            <p class="text-gray-700 leading-relaxed line-clamp-2">{{ $inventory->equipmentInventory->description }}</p>
                            <a href="{{ route('equipment', ['id' => $inventory->id, 'slug' => $inventory->equipmentInventory->slugName]) }}" wire:navigate class="text-cyan-600 hover:underline text-sm mt-2 inline-block">More Details</a>
                        </div>
                        <div class="flex-shrink-0 ml-4">
                            <span class="text-lg font-bold text-cyan-700 mb-2">{{ $inventory->cost }}</span>
                            <a href="{{ route('equipment', ['id' => $inventory->id, 'slug' => $inventory->equipmentInventory->slugName]) }}" wire:navigate
                               class="text-center bg-cyan-700 hover:bg-cyan-800 text-white font-medium py-2 px-4 rounded-lg transition duration-300 ease-in-out block">
                                View
                            </a>
                        </div>
                    </article>
                @endif
            @endif
        @endforeach
    </div>
</div>
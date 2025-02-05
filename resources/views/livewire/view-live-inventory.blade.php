<div>
  <div class="mx-auto w-full md:w-2/3 p-3">
    <h3 class="font-bold text-lg md:text-xl text-cyan-600 py-4">Filter Results</h3>
    <p><b>Keywords</b>: Enter keywords related to the item you're searching for. This could include make, model,
      capacity, or any other relevant details.</p>
    <x-forms.label-input label="Search" name="search" livewire='query' wire:keydown='searchInventory' />

    @empty(! $query)
      <div class="bg-zinc-50 rounded-lg p-2">
        <div class="block mx-auto w-1/2 text-center text-2xl">
        Showing {{$totalResults}} {{Str::plural("result", $totalResults)}} for the following keywords
        </div>
        <div class="grid grid-flow-col auto-cols-max gap-2 p-4">
        @php
        $keywords = explode(" ", $query);
      @endphp
        @foreach ($keywords as $keyword)
      <div class="inline-block whitespace-nowrap bg-cyan-600 text-center text-white px-4 py-1 rounded-full">
        {{$keyword}}
      </div>
    @endforeach
        </div>
      </div>
  @endempty
    <div class="flex flex-col lg:flex-row justify-between w-full gap-2">
      <select class="px-2 py-1 bg-sky-200/80 text-sm w-full lg:w-1/3" wire:model.live='selectedMake'>
        <option selected value="">Filter By Manufacture [Total: {{count($makes)}} ]</option>
        @foreach ($makes as $make)
      <option value="{{$make}}">{{$make}}</option>
    @endforeach
      </select>
      <select class="px-2 py-1 bg-sky-200/80 w-full lg:w-1/3 text-sm" wire:model.live='selectedModel'>
        <option selected value=''>Filter by Model [Total: {{count($models)}} ]</option>
        @foreach ($models as $model)
      <option value="{{$model}}">{{$model}}</option>
    @endforeach
      </select>
      <select class="px-2 py-1 bg-sky-200/80 w-full lg:w-1/3 text-sm" wire:model.live='selectedYear'>
        <option selected value="">Filter by Year [Total: {{count($years)}} ]</option>
        @foreach ($years as $year)
      <option value="{{$year}}">{{$year}}</option>
    @endforeach
      </select>
      <button class="px-3 py-1.5 bg-cyan-700 text-white uppercase rounded-xl shadow-md font-bold"
        wire:click.prevent='resetFilter'>Reset</button>
    </div>
  </div>
  <div class="grid grid-flow-rows grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 grid-rows-max gap-5 p-2">
    @foreach ($inventories->sortByDesc(function ($inventory) {
      return [$inventory->is_featured ? 1 : 0, $inventory->inventoryable_type == "App\Models\CraneInventory" ? 1 : 0];
    }) as $inventory)
      @if($inventory->is_public)
      @if ($inventory->inventoryable_type == "App\Models\CraneInventory")
      <x-inventory-card :loop="$loop->iteration" :category="$inventory->craneInventory->readabletype"
      :year="$inventory->craneInventory->year" :subject="$inventory->craneInventory->subject"
      :capacity="$inventory->craneInventory->capacity" :condition="$inventory->craneInventory->condition"
      :images="$inventory->images" :id="$inventory->id" :slug="$inventory->craneInventory->slugName" route="crane"
      :thumbnail="$inventory->thumbnail" :details="$inventory->craneInventory->description"
      :featured="$inventory->is_featured" :available="$inventory->is_available" :views="count($inventory->uniqueViews)"
      :price="$inventory->cost" />
    @elseif ($inventory->inventoryable_type == "App\Models\PartInventory")
      <x-inventory-card :loop="$loop->iteration" :category="$inventory->partInventory->readabletype"
      :year="$inventory->partInventory->year" :subject="$inventory->partInventory->subject"
      :capacity="$inventory->partInventory->capacity" :condition="$inventory->partInventory->condition"
      :images="$inventory->images" :id="$inventory->id" :slug="$inventory->partInventory->slugName" route="part"
      :thumbnail="$inventory->thumbnail" :featured="$inventory->is_featured" :available="$inventory->is_available"
      :details="$inventory->partInventory->description" :views="count($inventory->uniqueViews)"
      :price="$inventory->cost" />
    @elseif ($inventory->inventoryable_type == "App\Models\EquipmentInventory")
      <x-inventory-card :loop="$loop->iteration" :category="$inventory->equipmentInventory->readabletype"
      :year="$inventory->equipmentInventory->year" :subject="$inventory->equipmentInventory->subject"
      :capacity="$inventory->equipmentInventory->capacity" :condition="$inventory->equipmentInventory->condition"
      :images="$inventory->images" :id="$inventory->id" :slug="$inventory->equipmentInventory->slugName"
      route="equipment" :thumbnail="$inventory->thumbnail" :featured="$inventory->is_featured"
      :available="$inventory->is_available" :details="$inventory->equipmentInventory->description"
      :views="count($inventory->uniqueViews)" :price="$inventory->cost" />
    @endif
    @endif
  @endforeach
  </div>

</div>

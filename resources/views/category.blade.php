  @extends('template')

  @section('title')
  @php
    $type = null;

    if ($inventories[0]->craneInventory) {
        $type = $inventories[0]->craneInventory;
    } elseif ($inventories[0]->partInventory) {
        $type = $inventories[0]->partInventory;
    } elseif ($inventories[0]->equipmentInventory) {
        $type = $inventories[0]->equipmentInventory;
    }
@endphp
  Used {{$type->readableType}} for Sale | Alberta Crane Service Ltd
  @endsection

  @section('vh')
  vh-50 hero-bg
  @endsection
  @section('h1-text')
    <h1 class="text-white uppercase font-bold text-2xl lg:text-4xl">Used {{$type->readableType}} inventory for sale</h1>
  @endsection
  @section('content')

  <section class="py-10">
    <div class="md:container md:mx-auto p-4">
      {{-- Breadcrumb Navigation --}}
      <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 my-5 rounded-lg bg-gray-50 shadow-md drop-shadow-md"  aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li><a href="{{ route('home') }}" class="hover:text-cyan-600">Home</a> > </li> 
            <li><a href="{{ route('inventory') }}" class="hover:text-cyan-600">Inventory</a> ></li>
            <li class="text-cyan-600">{{ ucwords($type->readableType) }}</li>
        </ol>
    </nav>
      <div class="grid grid-flow-rows grid-cols-1 lg:grid-cols-3 grid-rows-max gap-5">
        @foreach ($inventories->sortByDesc(function ($inventory) {
            return [$inventory->is_featured ? 1 : 0, $inventory->inventoryable_type == "App\Models\CraneInventory" ? 1 : 0];
        }) as $inventory)
            @if ($inventory->inventoryable_type == "App\Models\CraneInventory" )
                <x-inventory-card
                    :loop="$loop->iteration"
                    :category="$inventory->craneInventory->readabletype"
                    :year="$inventory->craneInventory->year"
                    :subject="$inventory->craneInventory->subject"
                    :capacity="$inventory->craneInventory->capacity"
                    :condition="$inventory->craneInventory->condition"
                    :images="$inventory->images"
                    :id="$inventory->id"
                    :slug="$inventory->craneInventory->slugName"
                    route="crane"
                    :thumbnail="$inventory->thumbnail"
                    :details="$inventory->craneInventory->description"
                    :featured="$inventory->is_featured"
                    :available="$inventory->is_available"
                />
            @elseif ($inventory->inventoryable_type == "App\Models\PartInventory" )
                <x-inventory-card
                    :loop="$loop->iteration"
                    :category="$inventory->partInventory->readabletype"
                    :year="$inventory->partInventory->year"
                    :subject="$inventory->partInventory->subject"
                    :capacity="$inventory->partInventory->capacity"
                    :condition="$inventory->partInventory->condition"
                    :images="$inventory->images"
                    :id="$inventory->id"
                    :slug="$inventory->partInventory->slugName"
                    route="part"
                    :thumbnail="$inventory->thumbnail"
                    :featured="$inventory->is_featured"
                    :available="$inventory->is_available"
                    :details="$inventory->partInventory->description"
                />
            @elseif ($inventory->inventoryable_type == "App\Models\EquipmentInventory" )
                <x-inventory-card
                    :loop="$loop->iteration"
                    :category="$inventory->equipmentInventory->readabletype"
                    :year="$inventory->equipmentInventory->year"
                    :subject="$inventory->equipmentInventory->subject"
                    :capacity="$inventory->equipmentInventory->capacity"
                    :condition="$inventory->equipmentInventory->condition"
                    :images="$inventory->images"
                    :id="$inventory->id"
                    :slug="$inventory->equipmentInventory->slugName"
                    route="equipment"
                    :thumbnail="$inventory->thumbnail"
                    :featured="$inventory->is_featured"
                    :available="$inventory->is_available"
                    :details="$inventory->equipmentInventory->description"
                />
            @endif
        @endforeach
      </div>
    </div>
  </section>

  @endsection

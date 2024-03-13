{{--

  ToDo: Hide all images which are not filtered by data-type

  --}}


  @extends('template')

  @section('title')
  Used {{$category}} for Sale | Alberta Crane Service Ltd
  @endsection

  @section('vh')
  vh-50 hero-bg
  @endsection
  @section('h1-text')
    <h1 class="text-white uppercase font-bold text-2xl lg:text-4xl">Used {{$category}} inventory for sale</h1>
  @endsection
  @section('content')

  <section id='breadcrumbs' class="p-5">
    <div class="text-start uppercase font-semibold font-xl text-cyan-800"><a href="{{ route('home') }}">Home</a> > <a href="{{ route('inventory') }}">Inventory</a> > <a href="{{ route('category', ['slug' => Str::kebab($category)]) }}">{{$category}}</a></div>
  </section>

  <section class="py-10">
    <div class="md:container-lg md:mx-auto p-4">
      <div class="flex justify-center items-center vh-50 bg-neutral-50 rounded-xl shadow w-full py-10">
        <div class="bg-gradient-to-b from:cyan-600">
          <img src="{{ asset('img/acs-logo-new.png') }}" class="mx-auto w-1/2"  alt="Used Cranes | Alberta Crane Service">
          <h2 class="uppercase text-2xl text-cyan-800">Sorry, There was no results found for {{ $category }}</h2>
          <div class="text-center pt-10">
            <span class='block text-cyan-800 text-lg'>Consider looking at this random inventory item!</span>
            <div class="mx-auto w-3/4">
            @foreach ($randomInventory as $inventory)
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
                :views="count($inventory->uniqueViews)"
                :price="$inventory->cost"
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
                :views="count($inventory->uniqueViews)"
                :price="$inventory->cost"

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
                :views="count($inventory->uniqueViews)"
                :price="$inventory->cost"

            />
        @endif
            @endforeach
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  @endsection

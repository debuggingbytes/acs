{{--

  ToDo: Hide all images which are not filtered by data-type

  --}}

{{-- @dd($inventories) --}}
@extends('template')

@section('title')
Used {{$inventories[0]->craneInventory->ReadableType}} for Sale | Alberta Crane Service Ltd
@endsection

@section('vh')
vh-50 hero-bg
@endsection
@section('h1-text')
  <h1 class="text-white uppercase font-bold text-2xl lg:text-4xl">Used {{$inventories[0]->craneInventory->ReadableType}} inventory for sale</h1>
@endsection
@section('content')

<section id='breadcrumbs' class="p-5">
  <div class="text-start uppercase font-semibold font-xl text-cyan-800"><a href="{{ route('home') }}">Home</a> > <a href="{{ route('inventory') }}">Inventory</a> > <a href="{{ route('category', ['slug' => $inventories[0]->craneInventory->kebab_type]) }}">{{$inventories[0]->craneInventory->ReadableType}}</a></div>
</section>

<section class="py-10">
  <div class="md:container md:mx-auto p-4">
    <div class="grid grid-flow-rows grid-cols-1 lg:grid-cols-3 grid-rows-max gap-5">
      @foreach ($inventories as $inventory)
          @if ($inventory->inventoryable_type == "App\Models\CraneInventory" && $inventory->is_available)
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
          />
          @endif
      @endforeach
    </div>
  </div>
</section>

@endsection

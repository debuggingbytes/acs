@extends('template')
{{-- @dd($inventory) --}}
@section('title')
Used {{$inventory->equipmentInventory->year}} {{$inventory->equipmentInventory->subject}} for sale | Alberta Crane Service Ltd
@endsection

@section('meta')
  <meta name="title" content="Used {{$inventory->equipmentInventory->year}} {{$inventory->equipmentInventory->subject}} for sale | Alberta Crane Service Ltd">
  <meta name="keywords" content="{{$inventory->equipmentInventory->year}} {{ $inventory->equipmentInventory->subject }}, {{ $inventory->equipmentInventory->capacity }} ton, {{ $inventory->equipmentInventory->condition }} condition, Crane, All-Terrain, Truck Mount, Boom Truck, Tadano, Grove, Liebherr, Mannitwoc, GMK, LTM, LR, Hook, Block, Ball, cropac equipment inc, crane network">
  <meta name="description" content="{{$inventory->equipmentInventory->year}} {{ $inventory->equipmentInventory->subject }} crane with {{ $inventory->equipmentInventory->capacity }} ton capacity, currently in {{ $inventory->equipmentInventory->condition }} condition for sale">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="2 days">
  <meta name="language" content="English">
  <!-- Social Media tags -->
  <meta property="og:title" content="Used {{$inventory->equipmentInventory->year}} {{$inventory->equipmentInventory->subject}} for sale">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{Request::url()}}">
  <meta property="og:image" content="{{$inventory->images[0]}}">
@endsection



@section('vh')
vh-50
@endsection
@section('hero')
  style='background-image: url("{{$inventory->images[0]->image_path}}"); background-position: center center; background-size: cover;'
@endsection
@section('h1-text')
  <h1 class="text-white uppercase font-bold text-2xl lg:text-4xl">Used {{$inventory->equipmentInventory->year}} {{$inventory->equipmentInventory->make}} {{$inventory->equipmentInventory->model}} for sale</h1>
@endsection

@section('content')

<section id='breadcrumbs' class="p-5">
<div class="text-start uppercase font-semibold font-xl text-cyan-800"><a href="{{ route('home') }}">Home</a> > <a href="{{ route('inventory') }}">Inventory</a> > <a href="{{ route('category', ['slug' => $inventory->equipmentInventory->kebabType]) }}">{{ $inventory->equipmentInventory->ReadableType }}</a> > <a href="">{{$inventory->equipmentInventory->subject}}</a></div>
</section>
<section class="py-10">
    <livewire:count-live-views />
  <div class="md:container md:mx-auto p-4 ">
    <div class="p-2 relative">
        @if(!$inventory->is_available)
        <div class="absolute inset-1 z-[9] h-full rounded-lg">
            <div class="flex w-100 z-20 h-full justify-center items-center">
                <span class="text-9xl bg-zinc-50 shadow-lg border-2 border-red-700 px-10 py-5 -rotate-12 rounded-xl text-red-700 uppercase font-bolder">SOLD</span>
            </div>
        </div>
        @endif
      <h2 class="uppercase text-cyan-800 text-2xl lg:text-4xl font-bold">Used {{ $inventory->equipmentInventory->year }} {{ $inventory->equipmentInventory->subject }} for sale</h2>
      <p class="font-medium text-xl pt-5">Alberta Crane Service Ltd is proud to present the {{$inventory->equipmentInventory->year}} {{ $inventory->equipmentInventory->subject}} for sale. This equipment is currently listed in {{ $inventory->equipmentInventory->condition }} condition. The {{$inventory->equipmentInventory->year}} {{ $inventory->equipmentInventory->subject }} is classified as a {{ $inventory->equipmentInventory->ReadableType }}.
      @if (!empty($inventory->equipmentInventory->boom))
      This {{ $inventory->equipmentInventory->make }} comes with {{$inventory->equipmentInventory->boom}}' of boom
        @if (!empty($inventory->equipmentInventory->jib))
        , and {{$inventory->equipmentInventory->jib}}' of jib.
        @else
          .
        @endif
      @endif
    </p>
      <div class="flex-rows lg:flex pt-12 gap-5">
        <div class="w-full lg:w-3/5 pb-10 lg:pb-0 relative rounded-xl p-2 bg-neutral-100 shadow-lg">
          <div class="w-full overflow-hidden transition-all duration-500 ease-in-out @if (count($inventory->images) <= 1) pb-2 @endif">
            <img src='{{ $inventory->images[0]->image_path }}' title='{{$inventory->equipmentInventory->year}} {{$inventory->equipmentInventory->subject}} for sale' class="w-full h-full craneImg rounded-xl" alt="{{ $inventory->equipmentInventory->subject }} for sale"/>
          </div>
          @if (count($inventory->images) > 1)
          <div class="overflow-x-scroll snap-x flex gap-1 mt-2 rounded-md">
            @foreach ($inventory->images->sortBy('image_order') as $image)
                <img src='{{ $image->image_path }}' title='{{$inventory->equipmentInventory->year}} {{$inventory->equipmentInventory->subject}} for sale' class=' h-48 cursor-pointer craneThumb @if ($loop->first) active @endif' alt="{{ $inventory->equipmentInventory->subject }} for sale"/>
            @endforeach
          </div>
          <div class="py-2">
            <p class="text-center text-xl font-,">Click on the images to see larger picture</p>
          </div>
          @endif
        </div>
        <div class="mt-5 lg:mt-0 w-100 lg:w-2/5 font-bold bg-neutral-100 rounded-xl shadow-lg p-2 flex flex-col justify-start">
          <x-inventory.inventory-detail
            detailName="Manufacture"
            :detailData="$inventory->equipmentInventory->make"
           />
           <x-inventory.inventory-detail
            detailName="Condition"
            :detailData="$inventory->equipmentInventory->condition"
            />
            <x-inventory.inventory-detail
            detailName="Category"
            :detailData="$inventory->equipmentInventory->readable_type"
            />
          @if($inventory->customFields)
              @foreach ($inventory->customFields as $field)
                <x-inventory.inventory-detail
                :detailName="$field->key"
                :detailData="$field->value"
                />
              @endforeach
          @endif
          <div class="block border-stone-800 bg-zinc-200 rounded-lg shadow-md border-b-2 mb-3">
            <span class="block md:rounded-tl-lg md:rounded-tr-lg p-2 text-center bg-cyan-600 text-white uppercase">Details</span>
            <span class="block xl:text-md md:ml-2 px-2 text-center xl:text-left py-2">
                @bb(($inventory->equipmentInventory->description))
            </span>
          </div>
        </div>
      </div>
      {{-- <div class="text-center bg-neutral-50 mt-5 rounded-lg shadow-lg p-2">
        <h4 class="uppercase text-cyan-800 text-2xl font-semibold">Additional Information</h4>
        <div class="rounded-xl w-2/3 mx-auto overflow-hidden">
            @bb(nl2br($inventory->equipmentInventory->description))
        </div>
     </div> --}}
      <div class="flex-rows md:flex w-100 md:justify-between pt-10">
        {{-- <div class="uppercase text-xl font-medium text-cyan-800">
          @if (!empty($prev->subject))
            <a href="{{ route('crane', ['id' => $prev->id, 'slug' => $prev->slugName]) }}" class="underline">{{ $prev->subject }}</a>
          @else
            {{$prev}}
          @endif
        </div>
        <div class="uppercase text-xl font-medium text-cyan-800">

          @if (!empty($next->subject))
            <a href="{{ route('crane', ['id' => $next->id, 'slug' => $next->slugName]) }}" class="underline">{{ $next->subject }}</a>
          @else
            {{$next}}
          @endif
        </div> --}}

      </div>
    </div>
  </div>
  <div class="w-3/4 mx-auto mt-10">
    <p class="pt-5 text-xl font-medium">
      <x-about-us/>
    </p>
  </div>
</section>
@endsection

{{-- @php
  print_r($images)
@endphp --}}

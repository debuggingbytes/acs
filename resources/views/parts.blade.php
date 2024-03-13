@extends('template')
@section('title')
Used {{$inventory->partInventory->year}} {{$inventory->partInventory->subject}} for sale | Alberta Crane Service Ltd
@endsection

@section('meta')
  <meta name="title" content="Used {{$inventory->partInventory->year}} {{$inventory->partInventory->subject}} for sale | Alberta Crane Service Ltd">
  <meta name="keywords" content="{{$inventory->partInventory->year}} {{ $inventory->partInventory->subject }}, {{ $inventory->partInventory->capacity }} ton, {{ $inventory->partInventory->condition }} condition, Crane, All-Terrain, Truck Mount, Boom Truck, Tadano, Grove, Liebherr, Mannitwoc, GMK, LTM, LR, Hook, Block, Ball, cropac equipment inc, crane network">
  <meta name="description" content="{{$inventory->partInventory->year}} {{ $inventory->partInventory->subject }} crane with {{ $inventory->partInventory->capacity }} ton capacity, currently in {{ $inventory->partInventory->condition }} condition for sale">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="2 days">
  <meta name="language" content="English">
  <!-- Social Media tags -->
  <meta property="og:title" content="Used {{$inventory->partInventory->year}} {{$inventory->partInventory->subject}} for sale">
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
  <h1 class="text-white uppercase font-bold text-2xl lg:text-4xl">Used {{$inventory->partInventory->year}} {{$inventory->partInventory->make}} {{$inventory->partInventory->model}} for sale</h1>
@endsection

@section('content')

<section id='breadcrumbs' class="p-5">
<div class="text-start uppercase font-semibold font-xl text-cyan-800"><a href="{{ route('home') }}">Home</a> > <a href="{{ route('inventory') }}">Inventory</a> > <a href="{{ route('category', ['slug' => $inventory->partInventory->kebab_type]) }}">{{ $inventory->partInventory->ReadableType }}</a> > <a href="">{{$inventory->partInventory->subject}}</a></div>
</section>
<section class="py-10">
  <div class="md:container md:mx-auto p-4 ">
    <livewire:count-live-views />
    <div class="p-2 relative">
        @if(!$inventory->is_available)
        <div class="absolute inset-1 z-[9] h-full rounded-lg">
            <div class="flex w-100 z-20 h-full justify-center items-center">
                <span class="text-9xl bg-zinc-50 shadow-lg border-2 border-red-700 px-10 py-5 -rotate-12 rounded-xl text-red-700 uppercase font-bolder">SOLD</span>
            </div>
        </div>
        @endif
      <h2 class="uppercase text-cyan-800 text-2xl lg:text-4xl font-bold">Used {{ $inventory->partInventory->year }} {{ $inventory->partInventory->subject }} for sale</h2>
      <p class="font-medium text-xl pt-5">Alberta Crane Service Ltd is proud to present the {{$inventory->partInventory->year}} {{ $inventory->partInventory->subject}} for sale. This equipment is currently listed in {{ $inventory->partInventory->condition }} condition. The {{$inventory->partInventory->year}} {{ $inventory->partInventory->subject }} is classified as a {{ $inventory->partInventory->ReadableType }}.
      @if (!empty($inventory->partInventory->boom))
      This {{ $inventory->partInventory->make }} comes with {{$inventory->partInventory->boom}}' of boom
        @if (!empty($inventory->partInventory->jib))
        , and {{$inventory->partInventory->jib}}' of jib.
        @else
          .
        @endif
      @endif
    </p>

      <div class="flex-rows lg:flex pt-12 gap-5">
        <div class="w-100 lg:w-1/2 pb-10 lg:pb-0 relative rounded-xl p-5 bg-neutral-100 shadow-lg">
          <div class="w-full p-2 overflow-hidden transition-all duration-500 ease-in-out">
            <img src='{{ $inventory->images[0]->image_path }}' title='{{$inventory->partInventory->year}} {{$inventory->partInventory->subject}} for sale' class="w-full h-full craneImg" alt="{{ $inventory->partInventory->subject }} for sale"/>
          </div>
          <div class="mt-5 h-42 px-1 py-2 relative " id="slider">
            <div class="flex gap-2 overflow-hidden">
            @foreach ($inventory->images->sortBy('image_order') as $image)
              <img src='{{ $image->image_path }}' title='{{$inventory->partInventory->year}} {{$inventory->partInventory->subject}} for sale' class='w-32 h-32 craneThumb cursor-pointer @if ($loop->first) active @endif' alt="{{ $inventory->partInventory->subject }} for sale"/>
            @endforeach
          </div>
            <button id="prevCrane" class="hover:drop-shadow-md hover:font-bold hover:opacity-80 text-black font-semibold bg-white/80 rounded-xl px-2 py-1.5">
              <i class="fas fa-arrow-left"></i>
            </button>
            <button id="nextCrane" class="hover:drop-shadow-md hover:font-bold hover:opacity-80 text-black font-semibold bg-white/80 rounded-xl px-2 py-1.5">
              <i class="fas fa-arrow-right"></i>
            </button>
          </div>
          <div class="uppercase text-center pb-10 lg:pb-0 hidden md:block">
            <p class="block">Use the arrow keys for easier scrolling</p>
            Current Image <span id="curImg"></span> of <span id="imgTotal"></span>
          </div>
        </div>
        <div class="w-100 lg:w-1/2 text-xl font-normal bg-neutral-100 rounded-xl shadow-lg p-5 flex flex-col justify-evenly">
          <div class="block border-slate-800 rounded-lg shadow-md border-b-2 mb-3 uppercase">
            <span class="block xl:inline-block xl:w-1/3 md:rounded-l-lg p-2 text-center bg-cyan-600 text-white">manufacture</span>
            <span class="block xl:inline-block md:ml-2 px-2 text-center xl:text-left font-semibold">{{ $inventory->partInventory->make }}</span>
          </div>
          <div class="block border-slate-800 rounded-lg shadow-md border-b-2 mb-3 uppercase">
            <span class="block xl:inline-block xl:w-1/3 md:rounded-l-lg p-2 text-center bg-cyan-600 text-white">Year</span>
            <span class="block xl:inline-block md:ml-2 px-2 text-center xl:text-left font-semibold">{{ $inventory->partInventory->year }}</span>
          </div>
          <div class="block border-slate-800 rounded-lg shadow-md border-b-2 mb-3 uppercase">
            <span class="block xl:inline-block xl:w-1/3 md:rounded-l-lg p-2 text-center bg-cyan-600 text-white">Condition</span>
            <span class="block xl:inline-block md:ml-2 px-2 text-center xl:text-left font-semibold">{{ $inventory->partInventory->condition }}</span>
          </div>
          <div class="block border-slate-800 rounded-lg shadow-md border-b-2 mb-3 uppercase">
            <span class="block xl:inline-block xl:w-1/3 md:rounded-l-lg p-2 text-center bg-cyan-600 text-white">category</span>
            <span class="block xl:inline-block md:ml-2 px-2 text-center xl:text-left font-semibold">{{ $inventory->partInventory->ReadableType }}</span>
          </div>
          <div class="block border-slate-800 rounded-lg shadow-md border-b-2 mb-3">
            <span class="block md:rounded-tl-lg md:rounded-tr-lg p-2 text-center bg-cyan-600 text-white uppercase">Details</span>
            <span class="block xl:text-md md:ml-2 px-2 text-center xl:text-left py-2">
                @bb(($inventory->partInventory->readableDescription))
            </span>
          </div>
        </div>
      </div>
      {{-- <div class="text-center bg-neutral-50 mt-5 rounded-lg shadow-lg p-2">
        <h4 class="uppercase text-cyan-800 text-2xl font-semibold">Additional Information</h4>
        <div class="rounded-xl w-2/3 mx-auto overflow-hidden">
            @bb(nl2br($inventory->partInventory->description))
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

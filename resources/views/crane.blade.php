@extends('template')
@section('title')
Used {{$inventory->craneInventory->year}} {{$inventory->craneInventory->subject}} for sale | Alberta Crane Service Ltd
@endsection

@section('meta')
  <meta name="title" content="Used {{$inventory->craneInventory->year}} {{$inventory->craneInventory->subject}} for sale | Alberta Crane Service Ltd">
  <meta name="keywords" content="For Sale {{$inventory->craneInventory->year}} {{ $inventory->craneInventory->subject }}, {{ $inventory->craneInventory->capacity }} ton, {{ $inventory->craneInventory->condition }} condition, Crane, All-Terrain, Truck Mount, Boom Truck, Tadano, Grove, Liebherr, Mannitwoc, GMK, LTM, LR, Hook, Block, Ball, Machinery Trader, cropac equipment inc, crane network">
  <meta name="description" content="For Sale {{$inventory->craneInventory->year}} {{ $inventory->craneInventory->subject }} crane with {{ $inventory->craneInventory->capacity }} ton capacity, currently in {{ $inventory->craneInventory->condition }} condition for sale">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="2 days">
  <meta name="language" content="English">
  <!-- Social Media tags -->
  <meta property="og:title" content="For Sale Used {{$inventory->craneInventory->year}} {{$inventory->craneInventory->subject}} for sale">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{Request::url()}}">
  <meta property="og:image" content="{{asset($inventory->thumbnail)}}">
@endsection

@section('vh')
vh-50
@endsection
@section('hero')
  style='background-image: url("{{asset($inventory->thumbnail)}}"); background-position: center center; background-size: cover;'
@endsection
@section('h1-text')
  <h1 class="text-white uppercase font-bold text-2xl lg:text-4xl">Used {{$inventory->craneInventory->year}} {{$inventory->craneInventory->make}} {{$inventory->craneInventory->model}} for sale</h1>
@endsection

@section('content')

<section id='breadcrumbs' class="p-5">
<div class="text-start uppercase font-semibold font-xl text-cyan-800"><a href="{{ route('home') }}">Home</a> > <a href="{{ route('inventory') }}">Inventory</a> > <a href="{{ route('category', ['slug' => $inventory->craneInventory->kebab_type]) }}">{{ $inventory->craneInventory->ReadableType }}</a> > <a href="">{{$inventory->craneInventory->subject}}</a></div>
</section>
<section class="py-10">
<livewire:count-live-views />
<div class="md:container md:mx-auto p-4">
  <div class="p-2 relative w-full">

      <div class="relative">  {{-- Container for SOLD overlay and title --}}
          @if(!$inventory->is_available)
              <div class="absolute inset-0 z-10 h-full rounded-lg bg-zinc-50/50 backdrop-blur-sm">  {{-- Semi-transparent overlay --}}
                  <div class="flex w-full h-full justify-center items-center">
                      <span class="text-9xl bg-red-100/75 shadow-lg border-2 border-red-700 px-10 py-5 -rotate-12 rounded-xl text-red-700 uppercase font-bolder">SOLD</span>
                  </div>
              </div>
          @endif

          <h2 class="uppercase text-cyan-800 text-3xl lg:text-5xl font-bold mb-2">  {{-- Increased title size, added margin --}}
              {{ $inventory->craneInventory->year }} {{ $inventory->craneInventory->subject }}
          </h2>
      </div>

      <p class="font-medium text-xl pt-5 leading-relaxed">
        Alberta Crane Service Ltd is proud to present this used {{ $inventory->craneInventory->year }} {{ $inventory->craneInventory->subject }} for sale.  {{-- Added "used" for clarity --}}
        This {{ $inventory->craneInventory->subject }} is currently in {{ $inventory->craneInventory->condition }} condition and is classified as a {{ $inventory->craneInventory->ReadableType }}.  {{-- Rephrased for better flow --}}
    
        @if (!empty($inventory->craneInventory->boom))
            This {{ $inventory->craneInventory->make }} {{ $inventory->craneInventory->subject }} comes equipped with {{ $inventory->craneInventory->boom }}{{ !Str::endsWith($inventory->boom, "'") ? "'" : '' }} of boom.  {{-- Added "equipped with" and repeated subject for keyword richness --}}
            @if (!empty($inventory->craneInventory->jib))
                It also has {{ $inventory->craneInventory->jib }}{{ !Str::endsWith($inventory->jib, "'") ? "'" : '' }} of jib.  {{-- Added "also has" --}}
            @endif
        @endif
    
        {{-- Potential additions for SEO and user experience: --}}
        @if ($inventory->craneInventory->capacity)  {{-- Only add if capacity exists --}}
            <br>  {{-- Add a line break for better visual separation --}}
            Its lifting capacity is {{ $inventory->craneInventory->capacity }} Tons.  {{-- Added "lifting capacity" for clarity --}}
        @endif
        
        @if ($inventory->craneInventory->hoursUpper)
            It has approximately {{ $inventory->craneInventory->hoursUpper }} upper engine hours.
            @if ($inventory->craneInventory->hoursLower)
             And approximately {{ $inventory->craneInventory->hoursLower }} lower engine hours.
        @endif
        @endif
        
        @if ($inventory->serial_number)
            Serial Number: {{ $inventory->serial_number }}  {{-- Added "Serial Number" label --}}
        @endif
    
        {{-- You could also add a short summary of key features here if available.  For example: --}}
        {{-- @if ($inventory->craneInventory->key_features) --}}
        {{--     <br> --}}
        {{--     Key Features: {{ $inventory->craneInventory->key_features }} --}}
        {{-- @endif --}}
    
        {{-- Consider adding structured data (Schema.org) to provide more context to search engines. --}}
        {{--  This is best done outside of this paragraph, but it's related to SEO.  More on this below. --}}
    
    </p>
      {{--  --}}
      <div class="flex-rows lg:flex pt-12 gap-5 w-full">
        <div class="w-full lg:w-3/5 pb-10 lg:pb-0 relative rounded-xl p-2 bg-neutral-100 shadow-lg">
            <div class="w-full overflow-hidden transition-all duration-500 ease-in-out ">
                <img src='{{ $inventory->images[0]->image_path }}' title='{{$inventory->craneInventory->year}} {{$inventory->craneInventory->subject}} for sale' class="w-full h-full max-h-96 object-contain craneImg rounded-xl" alt="{{ $inventory->craneInventory->subject }} for sale"/>
            </div>
            <div class="overflow-x-scroll snap-x flex gap-0.5 mt-2 rounded-md">
                @foreach ($inventory->images->sortBy('image_order') as $image)
                    <img src='{{ $image->image_path }}' title='{{$inventory->craneInventory->year}} {{$inventory->craneInventory->subject}} for sale' class='w-3/5 h-48 cursor-pointer craneThumb @if ($loop->first) active @endif' alt="{{ $inventory->craneInventory->subject }} for sale"/>
                @endforeach
            </div>
            <div class="py-2">
                <p>Total Images: {{$inventory->images->count()}}</p>
                <p class="text-center text-xl font-,">Click on the images to see larger picture. Scroll or Swipe to see all images</p>
            </div>
        </div>
        <div class="mt-5 lg:mt-0 w-100 lg:w-1/2 uppercase bg-neutral-100 rounded-xl shadow-lg p-5">
            @if($inventory->cost)
                <x-inventory.inventory-detail
                    detailName="Price"
                    :detailData="$inventory->cost"
                />
            @endif
            <x-inventory.inventory-detail
                detailName="Manufacture"
                :detailData="$inventory->craneInventory->make"
            />
            <x-inventory.inventory-detail
                detailName="Model"
                :detailData="$inventory->craneInventory->model"
            />
            <x-inventory.inventory-detail
                detailName="Year"
                :detailData="$inventory->craneInventory->year"
            />
            @if ($inventory->serial_number)
                <x-inventory.inventory-detail
                    detailName="S/N"
                    :detailData="$inventory->serial_number"
                />
            @endif
            @if ($inventory->craneInventory->hoursLower)
                <x-inventory.inventory-detail
                    detailName="Lower Hours"
                    :detailData="$inventory->craneInventory->hoursLower"
                />
            @endif
            @if($inventory->craneInventory->hoursUpper)
                <x-inventory.inventory-detail
                    detailName="Upper Hours"
                    :detailData="$inventory->craneInventory->hoursUpper"
                />
            @endif
            <x-inventory.inventory-detail
                detailName="Condition"
                :detailData="$inventory->craneInventory->condition"
            />
            <x-inventory.inventory-detail
                detailName="Capacity"
                :detailData="$inventory->craneInventory->capacity"
            />
            <x-inventory.inventory_detail
                detailName="Boom Length"
                :detailData="$inventory->craneInventory->boom"
            />
            @if ($inventory->craneInventory->jib)
                <x-inventory.inventory_detail
                    detailName="Jib Length"
                    :detailData="$inventory->craneInventory->jib"
                />
            @endif
            @if($inventory->craneInventory->jibInserts)
                <div class="block border-stone-800 rounded-lg shadow-md border-b-2 mb-3 bg-zinc-200">
                    <span class="block rounded-t-lg p-2 text-center bg-cyan-600 text-white">Jib Inserts</span>
                    <span class="block md:ml-2 px-2 text-center xl:text-left">
                        <div class="flex justify-between items-center my-2">
                            @php
                                $inserts = explode(",", $inventory->craneInventory->jibInserts);
                            @endphp
                            @foreach ($inserts as $insert)
                                <span class="px-2 py-1 inline-block bg-zinc-50 shadow-lg rounded-md">{{$insert}}' section</span>
                            @endforeach
                        </div>
                    </span>
                </div>

            @endif
            @if($inventory->craneInventory->total_jib_length)
                <x-inventory.inventory-detail
                    detailName="Total Jib Length"
                    :detailData="$inventory->craneInventory->total_jib_length"
                />
            @endif
            @if($inventory->craneInventory->jibType)
                <x-inventory.inventory_detail
                    detailName="Jib Type"
                    :detailData="$inventory->craneInventory->jibType"
                />
            @endif
            @if($inventory->customFields)
                @foreach ($inventory->customFields as $field)
                    <x-inventory.inventory_detail
                        :detailName="$field->key"
                        :detailData="$field->value"
                    />
                @endforeach
            @endif
            <x-inventory.inventory_detail
                detailName="Category"
                :detailData="$inventory->craneInventory->ReadableType"
            />
            <x-inventory.inventory_detail
                detailName="Last Updated"
                :detailData="$inventory->craneInventory->updated_at->diffForHumans()"
            />
            <p class="normal-case my-5 text-lg">Want more information about this crane? simply put your email down below</p>
            <livewire:contact.request-crane-info :crane="$inventory" />
        </div>
    </div>

    <div class="bg-neutral-50 mt-5 rounded-lg shadow-lg">
        <h4 class="block md:rounded-t-lg p-2 lg:text-center bg-cyan-600 text-white uppercase font-semibold text-xl lg:text-2xl">Additional Information</h4>
        <div class="rounded-xl w-full lg:text-center lg:w-4/5 lg:mx-auto overflow-hidden p-2">
            @bb(nl2br($inventory->craneInventory->description))
        </div>
    </div>

    <div class="bg-neutral-50 mt-5 rounded-lg shadow-lg w-full block">
        <h4 class="block md:rounded-t-lg p-2 lg:text-center bg-cyan-600 text-white uppercase font-semibold sm:text-lg lg:text-2xl">Related Inventory to {{ $inventory->craneInventory->subject }}</h4>
        <div class="rounded-xl w-full p-2">
            <livewire:inventory.related :inventory="$inventory"/>
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
@section('scripts')
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "{{ $inventory->craneInventory->year }} {{ $inventory->craneInventory->subject }}",
    "description": "<?php 
                      $desc = "Used " . $inventory->craneInventory->year . " " . $inventory->craneInventory->subject . " for sale. ";
                      if ($inventory->craneInventory->capacity) {
                          $desc .= "Lifting capacity: " . $inventory->craneInventory->capacity . ". ";
                      }
                      $desc .= "Condition: " . $inventory->craneInventory->condition . ". ";
                      $desc .= "More Details: " . $inventory->craneInventory->description . ". ";
                      // ... add other relevant details
                      echo str_replace('"', '\\"', strip_tags($desc)); // Escape quotes
                      ?>",
    "sku": "{{ $inventory->serial_number ?? 'N/A' }}", // Add Serial Number or N/A
    "mpn": "{{ $inventory->serial_number ?? 'N/A' }}", // MPN can be the same as SKU
    "brand": "{{ $inventory->craneInventory->make }}",
    "condition": "https://schema.org/UsedCondition", // Or "NewCondition" if applicable
    "offers": {
      "@type": "Offer",
      "priceCurrency": "USD", // Or USD, etc.
      "price": "{{ $inventory->cost ?? '0.00' }}", // Make sure it is number
      "availability": "{{ $inventory->is_available ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}"
    },
    "image": "{{ $inventory->thumbnail ?? '' }}"
  }
  </script>
@endsection
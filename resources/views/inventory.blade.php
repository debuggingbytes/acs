@extends('template')

@section('title')
Used Crane Inventory for Sale | Alberta Crane Service Ltd
@endsection

@section('h1-text')
  <h1 class="text-white uppercase font-bold text-2xl lg:text-4xl">Used Crane inventory for sale</h1>
@endsection
@section('hero-image')
<img src="{{ asset('img/liebherr-ltm-1300-4-2-alberta-crane-service.png') }}" class="object-cover w-full max-h-[50svh] h-full">  {{-- Apply max-h to the image --}}
@endsection

@section('content')

<section id='breadcrumbs' class="p-5">
  <div class="text-start uppercase font-semibold font-xl text-cyan-800 break-words"><a href="{{ route('home') }}">Home</a> > <a href="{{ route('inventory') }}">Inventory</a></div>
</section>
<section class="py-10">
  <div class="md:container md:mx-auto p-4">
    <livewire:view-live-inventory />
  </div>
</section>

@endsection

{{--

  ToDo: Hide all images which are not filtered by data-type

  --}}


@extends('template')

@section('title')
Used Crane Inventory for Sale | Alberta Crane Service Ltd
@endsection

@section('vh')
vh-50 hero-bg
@endsection
@section('h1-text')
  <h1 class="text-white uppercase font-bold text-2xl lg:text-4xl">Used Crane inventory for sale</h1>
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

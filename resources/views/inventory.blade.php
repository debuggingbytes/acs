@extends('template')

@section('title')
    Used Crane Inventory for Sale | Alberta Crane Service Ltd
@endsection

@section('h1-text')
    <h1 class="text-white uppercase font-bold text-2xl lg:text-4xl">Used Crane inventory for sale</h1>
@endsection
@section('hero-image')
    <img src="{{ asset('img/liebherr-ltm-1300-4-2-alberta-crane-service.png') }}"
        alt="Liebherr LTM 1300 4.2 All-Terrain Crane" class="object-cover w-full max-h-[50svh] h-full"> {{-- Apply max-h to
    the image --}}
@endsection

@section('content')

<section class="py-10">
    <div class="md:container md:mx-auto p-4">
            <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 shadow-md drop-shadow-md" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li><a href="{{ route('home') }}" class="hover:text-cyan-600">Home</a> > </li> 
                    <li><a href="{{ route('inventory') }}" class="hover:text-cyan-600">Inventory</a></li>
                </ol>
            </nav>
            <livewire:view-live-inventory />
        </div>
    </section>

@endsection
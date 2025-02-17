@props(
    [
        'title' => 'Alberta Crane Service | Used Equipment Sales',
        'heroImage' => '',
        'h1Text' => '',
        'inventory' => ''
    ]
)
<!DOCTYPE html>
<html lang="en" class="scroll-auto md:scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Used Cranes and Equipment for Sale | Canada, USA | Alberta Crane Service">
    <meta name="google-site-verification" content="zAV9dkbH17UMAnk68CJSTUezIECZu4tCUDu2e9ZVtJE" />
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
    <title>{{$title ?? 'Alberta Crane Service | Used Equipment Sales'}}</title>
    @production
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-61207822-1"></script>
        @if (! Auth::user())
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag() { dataLayer.push(arguments); }
                gtag('js', new Date());
                gtag('config', 'UA-61207822-1');
            </script>
        @endif
    @endproduction
    {{-- Google Icons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{asset('site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/c5608c8cee.js" crossorigin="anonymous"></script>
    <wireui:scripts/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-slate-200 relative">
    {{-- Maintenance Banner when active --}}
    <livewire:system.maintenance.maintenance />
    {{-- Header & Navigation --}}
    <header class="flex flex-col relative h-[50svh]">
        <div class="max-h-[50svh] h-[50svh] absolute inset-0 overflow-hidden">  {{-- Add overflow-hidden to the container --}}
            <div class="bg-radial-[at_85%_55%] from-bg-cyan-700 to-sky-800 to-75% absolute inset-0"></div>
            @if(!empty($heroImage))
                <img src="https://www.albertacraneservice.com{{ $heroImage }}"
                    alt="Liebherr LTM 1300 4.2 All-Terrain Crane" class="object-cover w-full max-h-[50svh] h-full">
            @endif
        </div>
        <nav
            class="bg-gradient-to-b from-slate-900 to-gray-700 sm:px-4 py-2.5 w-full z-20 sticky top-0 border-b border-gray-200 ">
            <div class="container md:flex md:flex-wrap md:justify-between md:items-center md:mx-auto p-2">
                <a href="https://albertacraneservice.com/" class="flex items-center">
                    <img src="{{ asset('img/logo.png') }}" class="mr-3 h-16"
                        alt="Used Cranes | Alberta Crane Service">
                </a>
                <x-Navigation />
            </div>
        </nav>
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-center h-full gap-10 z-10"> {{-- Center content --}}
            <div class="w-full">
                <h1 class="text-center text-2xl md:text-5xl font-bold text-white dark:text-gray-50 sm:text-center">
                    <span class="block uppercase">
                        {{ $h1Text ?? ''}}    
                    </span>                    
                </h1>
            </div>
        </div>
    </header>
    {{-- Main content --}}
    <main class="py-12">
       {{$slot}}
    </main>
    {{-- Footer --}}
    <x-footer />
    @livewireScripts
</body>
</html>
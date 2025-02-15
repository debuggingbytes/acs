<!DOCTYPE html>
<html lang="en" class="scroll-auto md:scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Used Cranes and Equipment for Sale | Canada, USA | Alberta Crane Service">
    <meta name="google-site-verification" content="zAV9dkbH17UMAnk68CJSTUezIECZu4tCUDu2e9ZVtJE" />
    <title>Used Cranes for Sale | Financing | Alberta
    </title>
    {{-- Custom CSS --}}

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- Google tag (gtag.js) -->
    {{-- Only load analytics if in productions --}}
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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-slate-200 relative">
    {{-- Maintenance Banner when active --}}
    <livewire:system.maintenance.maintenance />
    {{-- Header & Navigation --}}
    <header class="bg-radial-[at_85%_55%] from-bg-cyan-700 to-sky-800 to-75% h-[80svh] flex flex-col">
        <nav
            class="bg-gradient-to-b from-slate-900 to-gray-700 sm:px-4 py-2.5 dark:bg-gray-900 w-full z-20 sticky top-0 border-b border-gray-200 dark:border-gray-600">
            <div class="container flex flex-wrap justify-between items-center mx-auto">
                <a href="https://albertacraneservice.com/" class="flex items-center">
                    <img src="{{ asset('img/acs-logo-new.png') }}" class="mr-3 h-16"
                        alt="Used Cranes | Alberta Crane Service">
                </a>
                <x-Navigation />
            </div>
        </nav>
        <div class="container mx-auto flex items-center justify-center h-full gap-10"> {{-- Center content --}}
            <div class="w-full">
                <h1
                    class="text-center text-4xl md:text-5xl lg:text-6xl font-bold text-white dark:text-gray-50 sm:text-center md:text-left">
                    {{-- Styles for H1 --}}
                    <span class="block uppercase border-b">Used Cranes and Equipment for Sale</span>
                    <span class="text-base/6 block mt-4">Alberta Crane Service has access to a vast inventory of used
                        equipment and
                        used
                        cranes
                        for
                        sale across Alberta
                        and
                        the global market.</span>
                </h1>
                <div class="mt-8 flex justify-center md:justify-start"> {{-- Added margin top and flexbox for alignment
                    --}}
                    <a wire:navigate href="{{ route('inventory') }}"
                        class="px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-medium transition duration-300 ease-in-out drop-shadow-md">
                        View Our Inventory
                    </a>
                </div>
            </div>

            <livewire:templates.scrolling-inventory />
    </header>
    <main class="py-12"> {{-- Added padding to the main section --}}
        <section class="mb-16 container mx-auto"> {{-- Added margin to bottom of section --}}
            <h2 class="text-3xl font-bold mb-4">Find Your Perfect Used Crane or Heavy Equipment</h2>
            <p class="text-gray-800 leading-relaxed">
                Leverage our 30+ years of crane operating experience when you're looking for <strong>used
                    cranes</strong>
                or
                <strong>heavy equipment</strong>. At Alberta Crane Service Ltd., we know what quality looks like. Our
                <strong>extensive</strong> and <strong>up-to-date inventory</strong> spans the <strong>United
                    States</strong>,
                <strong>Canada</strong>, and <strong>Europe</strong>, offering a wide selection of <strong>all-terrain
                    cranes</strong>, <strong>truck mounts</strong>, <strong>rough terrains</strong>, <strong>carry
                    decks</strong>,
                and all the <strong>crane parts</strong> you need. We perform <strong>thorough inspections</strong> on
                every piece
                of equipment before it's sold, ensuring your satisfaction. Browse our <a href="{{ route('inventory') }}"
                    wire:navigate class="text-sky-950 text-md underline">inventory
                    online</a> or contact our <strong>expert team</strong> for personalized assistance.
            </p>
            <div class="flex gap-5 mt-10">
                <div class="grid grid-flow-col grid-rows-3 gap-2 w-1/2">
                    <div class="row-span-3 bg-gray-900 h-94">01</div>
                    <div class="col-span-2 h-46 bg-cyan-500">02</div>
                    <div class="col-span-2 h-46 row-span-2 bg-sky-400">03</div>
                </div>
                <div class="w-1/2">
                    <h3 class="text-2xl font-bold mb-4">Used Crane Inventory</h3>
                    <p class="text-gray-800 leading-relaxed">
                    <menu class="grid grid-cols-2 gap-2">
                        @foreach ($types as $type)
                            <li class="p-2 border-s-4 border-b-4 border-cyan-700">
                                {{ ucwords(Str::replace("_", ' ', $type)) }}
                            </li>
                        @endforeach
                    </menu>
                    </p>
                </div>

            </div>
        </section>

    </main>
    @livewireScripts
</body>

</html>

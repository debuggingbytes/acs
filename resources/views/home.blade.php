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
            <div class="container md:flex md:flex-wrap md:justify-between md:items-center md:mx-auto p-2">
                <a href="https://albertacraneservice.com/" class="flex items-center">
                    <img src="{{ asset('img/logo.png') }}" class="mr-3 h-16"
                        alt="Used Cranes | Alberta Crane Service">
                </a>
                <x-Navigation />
            </div>
        </nav>
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-center h-full gap-10"> {{-- Center content --}}
            <div class="w-full">
                <h1
                    class="text-center text-2xl md:text-5xl font-bold text-white dark:text-gray-50 sm:text-center md:text-left">
                    {{-- Styles for H1 --}}
                    <span class="block uppercase border-b">Used Cranes and Equipment for Sale</span>
                    <span class="text-sm md:text-base/6 block mt-4">Alberta Crane Service has access to a vast inventory of used
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
                        class="flex gap-1 px-2 py-1.5 md:gap-3 md:px-6 md:py-3 bg-orange-600 hover:bg-orange-700 text-white font-medium transition duration-300 ease-in-out drop-shadow-md">
                        View Our Inventory
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm10.72 4.72a.75.75 0 0 1 1.06 0l3 3a.75.75 0 0 1 0 1.06l-3 3a.75.75 0 1 1-1.06-1.06l1.72-1.72H9a.75.75 0 0 1 0-1.5h10.94l-1.72-1.72a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                          
                    </a>
                </div>
            </div>

            <livewire:templates.scrolling-inventory />
        </div>
    </header>
    <main class="py-12">
        {{-- Intro --}}
        <x-layout.intro :types="$types" />
        {{-- Cost Explaination --}}
        <x-layout.cost-explaination />

        {{-- Appraisals --}}
        <x-layout.appraisals />
        {{-- Testimonals --}}
        <x-layout.testimonials />
        {{-- About --}}
        <x-layout.about />
    </main>
    {{-- Footer --}}
    <x-footer />
    @livewireScripts
</body>

</html>

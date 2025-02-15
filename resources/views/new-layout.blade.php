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
        <section class="mb-16 container mx-auto p-2 min-h-[70svh]"> 
            <h2 class="text-3xl font-bold mb-4">Find Your Perfect Used Crane or Heavy Equipment</h2>
            <p class="text-gray-800 leading-relaxed text-lg">
                Leverage our 30+ years of crane operating experience when you're looking for <strong>used
                    cranes</strong>
                or
                <strong>heavy equipment</strong>. At Alberta Crane Service Ltd., we know what quality looks like. Our
                <strong>extensive</strong> and <strong>up-to-date inventory</strong> spans the <strong>United
                    States</strong>,
                <strong>Canada</strong>, and <strong>Europe</strong>, offering a wide selection of <strong>all-terrain
                    cranes</strong>, <strong>truck mounts</strong>, <strong>rough terrains</strong>, <strong>carry
                    decks</strong>,
                and all the <strong>crane parts</strong> you need. We ensure <strong>thorough inspections</strong> on
                every piece
                of equipment before it's sold, ensuring your satisfaction. Browse our <a href="{{ route('inventory') }}"
                    wire:navigate class="text-sky-950 text-md underline">inventory
                    online</a> or contact our <strong>expert team</strong> for personalized assistance.
            </p>
            <div class="flex flex-col md:flex-row gap-1 md:gap-5 mt-10">
                <div class="grid grid-flow-col grid-rows-2 gap-2 w-full md:w-1/2">
                    <div class="row-span-3 bg-gray-900 h-94 block max-w-fit relative">
                        <img src="{{ asset('img/Liebherr-telescopic-crawler-crane.png') }}" alt="Alberta Crane Service" class="transition-all ease-in-out hover:scale-1.1 h-full w-full object-cover drop-shadow-[0_5px_5px_rgba(0,0,0,0.75)]">
                    </div>
                    <div class="col-span-2 h-46 bg-cyan-500 block">
                        <img src="{{ asset('img/tadano-gr-1200xl.png') }}" alt="Alberta Crane Service" class="h-full w-full object-cover drop-shadow-[0_5px_5px_rgba(0,0,0,0.75)]">
                    </div>
                    <div class="col-span-2 h-46 row-span-2 bg-sky-400">
                        <img src="https://www.albertacraneservice.com/storage/inventory/102/2008-liebherr-ltm1090-41_c4f726a1-2add-4eef-b0ee-f9e856552862.webp" alt="Alberta Crane Service" class="h-full w-full object-cover drop-shadow-[0_5px_5px_rgba(0,0,0,0.75)]">
                    </div>
                </div>
                <div class="w-full md:w-1/2 flex flex-col h-full p-1 md:p-5">
                    <h3 class="text-2xl font-bold mb-4">Used Crane Inventory</h3>
                    <p class="text-gray-800 leading-relaxed">
                    <menu class="flex flex-col md:grid md:grid-cols-2 gap-1 md:gap-5 text-center">
                        @foreach ($types as $type)
                        <li class="p-1 md:p-2 bg-slate-300 h-12 border-s-4 border-cyan-700 flex items-center relative overflow-hidden transition-colors duration-300 ease-in-out group">
                            <div class="absolute inset-y-0 left-0 w-0 bg-cyan-700 transition-all duration-300 ease-in-out group-hover:w-full z-0"></div>  {{-- Overlay --}}
                            <strong class="relative z-10 group-hover:text-white transition duration-300 ease-in-out">
                                <a href='' wire:navigate>{{ ucwords(Str::replace("_", ' ', $type)) }}</a>
                            </strong>
                        </li>
                        @endforeach
                        <li class="col-span-2 mt-5 md:mt-0">
                            <a href='' wire:navigate class="block md:inline px-4 py-2 bg-cyan-600 text-white font-bold">View Crane Inventory</a>
                        </li>
                    </menu>
                    </p>
                </div>
            </div>
        </section>
        {{-- Cost Explaination --}}
        <section class="flex bg-radial-[at_0%_75%] from-bg-cyan-200 to-sky-950 to-75% min-h-[70svh]">
            <div class="container mx-auto flex flex-col md:flex-row items-center justify-center gap-10 p-2">
                <div class="w-full md:w-1/2 py-5">
                    <x-forms.contact />
                </div>
                <div class="w-full md:w-1/2">
                    <h3 class="text-2xl md:text-white font-bold mb-4 mt-4 border-b-2">Used Cranes & Heavy Equipment: A <span class="text-orange-500">Cost-Effective</span> Solution</h3>
                    <p class="md:text-gray-200 text-lg leading-relaxed">
                        The cost of new cranes and heavy equipment can be prohibitive for many businesses. Alberta Crane Service offers a smart alternative: a wide selection of quality used cranes, attachments, and other heavy equipment.  Buying used saves you money and gives you access to well-maintained machines.  Our inventory includes various models from leading manufacturers like Liebherr (all-terrain cranes, crawler cranes), Tadano (rough terrain cranes), Grove, and Linkbelt (truck mount cranes). Browse our inventory today!
                    </p>
                    
                </div>
            </div>
        </section>

        {{-- Appraisals --}}
        <section class="mb-16 container mx-auto p-2 mt-20"> 
            <div class="flex flex-col md:flex-row gap-1 md:gap-5 mt-10 justify-center items-center min-h-[60svh]">
                <div class="grid grid-flow-col grid-rows-2 gap-2 w-full md:w-1/2">
                    
                    <div class="col-span-2 h-56 block">
                        <img src="https://www.albertacraneservice.com/storage/inventory/127/2014-tadano-atf130g-5_fc5c4aad-e7ba-4944-acee-c5e09437c44e.webp" alt="Alberta Crane Service" class="h-full w-full object-cover rounded-t-lg drop-shadow-[0_5px_5px_rgba(0,0,0,0.75)]">
                    </div>
                    <div class="col-span-2 h-56 ">
                        <img src="https://www.albertacraneservice.com/storage/inventory/1/2016-grove-gmk4100_73a12120-6dc9-4d50-b68f-bdd328f62bdc.jpg" alt="Alberta Crane Service" class="h-full w-full object-cover rounded-b-lg drop-shadow-[0_5px_5px_rgba(0,0,0,0.75)]">
                    </div>
                    
                </div>
                <div class="w-full md:w-1/2 flex flex-col h-full p-1 md:p-5">
                    <h3 class="text-2xl font-bold mb-4">Crane Appraisals & Fleet Evaluations</h3>
                    <p class="text-gray-800 leading-relaxed text-lg">
                        Alberta Crane Service is your trusted partner for all your <strong>crane</strong> and <strong>heavy equipment</strong> needs. In addition to our wide selection of <strong>used cranes</strong> and <strong>used equipment</strong>, we offer specialized services to help you manage your assets effectively. Our <strong>certified crane appraisers</strong> provide accurate and reliable <strong>crane appraisals</strong>, essential for insurance, financing, and sales transactions. We also conduct comprehensive <strong>fleet evaluations</strong> to help businesses optimize their equipment utilization, reduce costs, and improve overall efficiency. Contact us today to schedule your <strong>crane appraisal</strong> or <strong>fleet evaluation</strong>.
                    </p>
                    <a href="" wire:navigate class="flex justify-center items-center text-white mt-5 px-5 py-2 bg-sky-700 transition-all ease-in-out hover:bg-sky-900 mx-auto w-1/3 gap-5">
                        Find out more
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M12 1.5a.75.75 0 0 1 .75.75V4.5a.75.75 0 0 1-1.5 0V2.25A.75.75 0 0 1 12 1.5ZM5.636 4.136a.75.75 0 0 1 1.06 0l1.592 1.591a.75.75 0 0 1-1.061 1.06l-1.591-1.59a.75.75 0 0 1 0-1.061Zm12.728 0a.75.75 0 0 1 0 1.06l-1.591 1.592a.75.75 0 0 1-1.06-1.061l1.59-1.591a.75.75 0 0 1 1.061 0Zm-6.816 4.496a.75.75 0 0 1 .82.311l5.228 7.917a.75.75 0 0 1-.777 1.148l-2.097-.43 1.045 3.9a.75.75 0 0 1-1.45.388l-1.044-3.899-1.601 1.42a.75.75 0 0 1-1.247-.606l.569-9.47a.75.75 0 0 1 .554-.68ZM3 10.5a.75.75 0 0 1 .75-.75H6a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 10.5Zm14.25 0a.75.75 0 0 1 .75-.75h2.25a.75.75 0 0 1 0 1.5H18a.75.75 0 0 1-.75-.75Zm-8.962 3.712a.75.75 0 0 1 0 1.061l-1.591 1.591a.75.75 0 1 1-1.061-1.06l1.591-1.592a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                          </svg>
                          
                    </a>
                </div>
            </div>
        </section>
        {{-- Testimonals --}}
        <section class="flex bg-gradient-to-t from-cyan-950 from-10% via-sky-700 via-30% to-blue-500 to-90% min-h-[70svh] py-12 justify-center items-center">  
            <div class="container mx-auto">
                <h3 class="text-2xl md:text-white font-bold mb-8 text-center md:text-left">Testimonials</h3> 
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">  
        
                    <div class="bg-white rounded-lg shadow-md p-6 md:p-8 transition duration-300 ease-in-out hover:scale-105">
                        <div class="flex items-center mb-4">
                            <div>
                                <h4 class="font-medium text-gray-800">Client Name</h4>  {{-- Replace with client name --}}
                                <p class="text-gray-600 text-sm">Client Title/Company</p>  {{-- Replace with title/company --}}
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed">
                            "This is where the testimonial text goes.  It should be concise and impactful.  Focus on the benefits and results."  {{-- Replace with testimonial text --}}
                        </p>
                        <div class="mt-4 text-gray-600 flex">
                          <i class="text-yellow-500 mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                              </svg>
                          </i>
                          <i class="text-yellow-500 mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                              </svg>
                          </i>
                          <i class="text-yellow-500 mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                              </svg>
                          </i>
                          <i class="text-yellow-500 mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                              </svg>
                          </i>
                          <i class="text-yellow-500 mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                              </svg>
                          </i>
                          
                        </div>
                    </div>
                    {{-- Repeat the Testimonial Card Template as many times as you have testimonials --}}
                    <div class="bg-white rounded-lg shadow-md p-6 md:p-8 transition duration-300 ease-in-out hover:scale-105">
                        {{-- ... (Content for another testimonial card) ... --}}
                    </div>
        
                    <div class="bg-white rounded-lg shadow-md p-6 md:p-8 transition duration-300 ease-in-out hover:scale-105">
                        {{-- ... (Content for another testimonial card) ... --}}
                    </div>
                </div>
            </div>
        </section>
        {{-- About --}}
        <section class="mb-16 container mx-auto p-2 mt-20"> 
            <div class="flex flex-col md:flex-row gap-1 md:gap-5 mt-10 justify-center items-center min-h-[50svh]">
                <div class="flex items-center justify-center w-full md:w-1/2">
                    <img src="{{asset('img/logo.png')}}" alt="Alberta Crane Service" class="h-full object-cover rounded-t-lg drop-shadow-[0_5px_5px_rgba(0,0,0,0.75)] w-1/2">
                </div>
                <div class="w-full md:w-1/2 flex flex-col h-full p-1 md:p-5">
                    <h6 class="text-2xl font-bold mb-4">Reliable Used Cranes & Heavy Equipment: 38+ Years of Expertise</h6>
                    <p class="text-lg md:text-xl text-black leading-relaxed mb-6">  
                        Since 2013, Alberta Crane Service Ltd., located in Edmonton, Alberta, Canada, has earned a reputation for excellence in the heavy equipment industry. With over 38 years of combined crane industry experience, our Canadian-owned and operated company provides expert service and professionalism that sets us apart. We specialize in connecting buyers and sellers of cranes worldwide, offering a diverse inventory and unparalleled support. Whether you're looking to buy or sell, contact us today to leverage our expertise and global network.
                    </p>           
                  
                    <a href="" wire:navigate class="flex justify-center items-center text-white mt-5 px-5 py-2 bg-orange-700 transition-all ease-in-out hover:bg-orange-900 mx-auto w-1/3 gap-5">
                        Contact us today
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M15 3.75a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0V5.56l-4.72 4.72a.75.75 0 1 1-1.06-1.06l4.72-4.72h-2.69a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
                          </svg>
                    </a>
                </div>
            </div>
        </section>
    </main>
    {{-- Footer --}}
    <x-footer />
    @livewireScripts
</body>

</html>

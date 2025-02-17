@extends('template')

@section('title')
    Crane & Heavy Equipment Financing
@endsection

@section('vh')
    vh-50 hero-bg
@endsection

@section('h1-text')
    <h1 class="text-white uppercase font-bold text-3xl md:text-5xl">Crane & Heavy Equipment Financing</h1>  {{-- Increased title size --}}
@endsection

@section('content')

  

    <section class="py-16 bg-white">  {{-- Added background, increased padding --}}
        <div class="container mx-auto p-4">

          <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 mb-5 rounded-lg bg-gray-50 shadow-md drop-shadow-md"  aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('home') }}" class="hover:text-cyan-600">Home</a> > </li> 
                <li><a href="{{ route('inventory') }}" class="hover:text-cyan-600">Equipment Financing</a></li>
            </ol>
        </nav>

            <h2 class='uppercase text-3xl text-cyan-800 font-bold mb-6'>Financing Options</h2>  {{-- Improved heading styles --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">  {{-- Grid layout for content and image --}}
                <div>  {{-- Text content area --}}
                    <p class="text-lg leading-relaxed mb-6">  {{-- Improved readability --}}
                      Acquiring appropriate funding for your cranes and heavy machinery is essential for business expansion. We recognize the difficulties and are here to make the process easier. At Alberta Crane Service, we've teamed up with industry specialists to provide customized financing options that suit your unique requirements.
                    </p>

                    <p class="text-lg leading-relaxed mb-6">
                      Reasons to finance your equipment? It releases essential funds, enabling you to allocate resources to different aspects of your business, including marketing, growth, or recruitment. Funding also provides consistent monthly payments, simplifying the budgeting process. Additionally, it may offer tax benefits.
                    </p>

                    <p class="text-lg leading-relaxed mb-6">
                        We connect you with trusted financing partners who understand the heavy equipment industry.  They'll work with you to find the best terms and rates available, so you can acquire the equipment you need without breaking the bank.
                    </p>

                    <p class="text-lg leading-relaxed">
                      We link you to reliable financing partners familiar with the heavy equipment sector. They'll collaborate with you to discover the most favorable terms and rates, allowing you to obtain the necessary equipment without straining your finances.
                    </p>
                </div>

                <div class="md:h-full flex items-center justify-center">  {{-- Image container with flexbox for vertical centering --}}
                    <img src="{{ asset('img/equipment-capital-corp.jpg') }}" alt="Used equipment Financing provided by Canadian Equipment Finance - Alberta Crane Service" class="w-full rounded-xl shadow-lg max-h-fit">  {{-- Added shadow --}}
                </div>
            </div>



            <div class="mt-16 bg-neutral-50 rounded-xl ring-2 ring-cyan-700 p-8">  {{-- Separated partner section, improved styling --}}
                <div class="flex flex-col md:flex-row items-center gap-8 md:gap-5">
                    <img src="{{ asset('img/equipment-capital-corp.jpg') }}" alt="Equipment Capital Corp." class="w-full md:w-1/3 rounded-xl shadow-lg mb-6 md:mb-0">  {{-- Image on the left --}}
                    <div class="md:w-2/3">  {{-- Text on the right --}}
                        <h3 class="uppercase text-cyan-800 font-bold text-2xl mb-4">Equipment Capital Corp.</h3>  {{-- Improved heading styling --}}
                        <p class="text-lg leading-relaxed mb-6">
                            Navigating the world of financing can be complex. That's why we've partnered with Equipment Capital Corp., experts in heavy equipment financing.  They'll handle the details, finding the optimal financing solutions tailored to your business.
                        </p>
                        <p class="text-lg leading-relaxed mb-6">
                            Equipment Capital Corp. understands the crane and heavy equipment industry inside and out.  Let them secure the financing you need to operate at peak performance. Contact Luke Loran at Equipment Capital Corp. today to get started.
                        </p>
                        <a href="https://equipmentcapitalcorp.ca/" target="_blank" class="bg-cyan-600 hover:bg-cyan-700 text-white font-medium py-3 px-6 rounded-xl transition duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500">Contact Today</a>  {{-- Improved button styling --}}
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
@extends('template')

@section('title')
    Used Cranes & Heavy Equipment for sale | Contact Alberta Crane Service
@endsection

@section('vh')
    vh-50 hero-bg
@endsection

@section('h1-text')
    <h1 class="text-white uppercase font-bold text-3xl lg:text-5xl">Get in Touch</h1>  {{-- Improved heading --}}
@endsection

@section('content')


    <section class="py-16 bg-white">  {{-- Added background, increased padding --}}
        <div class="container mx-auto p-4">
          {{-- Breadcrumb Navigation --}}
          <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg mb-10 bg-gray-50 shadow-md drop-shadow-md"  aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('home') }}" class="hover:text-cyan-600">Home</a> &raquo; </li> 
                <li><a href="{{ route('inventory') }}" class="hover:text-cyan-600">Contact Us</a></li>
            </ol>
        </nav>
            <h2 class='uppercase text-3xl text-cyan-800 font-bold mb-8 text-center lg:text-left'>Contact Alberta Crane Service</h2>  {{-- Centered on smaller screens --}}

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">  {{-- Grid layout, increased gap --}}

                <div class="flex flex-col">  {{-- About Us section --}}
                    <img src="{{ asset('img/acs-logo-new.png') }}" alt="Alberta Crane Service Ltd" class="w-48 mb-6">  {{-- Adjusted image size, added margin --}}
                    <p class="text-lg leading-relaxed mb-4">
                        Founded in 2013, Alberta Crane Service Ltd. has earned a strong reputation in the heavy equipment industry.
                    </p>
                    <p class="text-lg leading-relaxed mb-4">
                        Located in Edmonton, Alberta, Canada, we are a proudly Canadian owned and operated company with over 38 years of combined experience.  Our cranes are located worldwide, and we are committed to providing unmatched service and professionalism. We specialize in buying and selling cranes globally.
                    </p>

                    {{-- Add more About Us details here as needed --}}
                    <div class="mt-6">  {{-- Contact Information --}}
                        <h4 class="text-xl font-bold text-cyan-800 mb-2">Contact Information</h4>
                        <ul class="text-lg leading-relaxed space-y-2">
                            <li><i class="fas fa-map-marker-alt mr-2 text-cyan-600"></i>  {{-- Added icon --}}
                                Edmonton, AB, Canada
                            </li>
                            <li><i class="fas fa-phone mr-2 text-cyan-600"></i> <a href="tel:780-803-2302" class="hover:text-cyan-600 transition duration-300">780-803-2302</a></li>
                            <li><i class="fas fa-envelope mr-2 text-cyan-600"></i> <a href="mailto:contact@albertacraneservice.com" class="hover:text-cyan-600 transition duration-300">contact@albertacraneservice.com</a></li>
                            {{-- Add more contact details like fax, etc. --}}
                        </ul>
                    </div>

                    <div class="mt-6 w-full">  {{-- Business Hours --}}
                      <h4 class="text-xl font-bold text-cyan-800 mb-2">Business Hours</h4>
                      <div class="text-lg leading-relaxed">  {{-- Use a div for better structure --}}
                          <div class="flex items-center mb-2">  {{-- Use flexbox for alignment --}}
                              <span class="font-medium w-28">Sunday:</span>  {{-- Fixed width for consistency --}}
                              <span>Closed</span>
                          </div>
                          <div class="flex items-center mb-2">
                              <span class="font-medium w-28">Monday:</span>
                              <span>8:00 a.m. – 6:00 p.m.</span>
                          </div>
                          <div class="flex items-center mb-2">
                              <span class="font-medium w-28">Tuesday:</span>
                              <span>8:00 a.m. – 6:00 p.m.</span>
                          </div>
                          <div class="flex items-center mb-2">
                              <span class="font-medium w-28">Wednesday:</span>
                              <span>8:00 a.m. – 6:00 p.m.</span>
                          </div>
                          <div class="flex items-center mb-2">
                              <span class="font-medium w-28">Thursday:</span>
                              <span>8:00 a.m. – 6:00 p.m.</span>
                          </div>
                          <div class="flex items-center mb-2">
                              <span class="font-medium w-28">Friday:</span>
                              <span>8.00 a.m. – 6:00 p.m.</span>
                          </div>
                          <div class="flex items-center">  {{-- No margin on the last item --}}
                              <span class="font-medium w-28">Saturday:</span>
                              <span>Closed</span>
                          </div>
                      </div>
                  </div>

                </div>

                <div class="flex flex-col">  {{-- Contact Form section --}}
                    <h3 class="uppercase text-2xl text-cyan-800 font-bold mb-6 lg:mb-0 lg:mt-0 text-center lg:text-left pb-5 drop-shadow-md">Send Us a Message</h3>
                    <livewire:contact.emailer/>
                </div>
            </div>

        </div>
    </section>

@endsection
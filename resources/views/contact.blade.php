  @extends('template')

  @section('title')
    Used Cranes & Heavy Equipment for sale | Contact Alberta Crane Service
  @endsection
  
  @section('vh')
  vh-50 hero-bg
  @endsection
  @section('h1-text')
    <h1 class="text-white uppercase font-bold text-2xl lg:text-4xl">Get in touch today</h1>
  @endsection
  @section('content')
   
  <section id='breadcrumbs' class="p-5">
    <div class="text-start uppercase font-semibold font-xl text-cyan-800"><a href="{{ route('home') }}">Home</a> > <a href='{{ route('contact') }}'>Contact Us</a></div>
  </section>
  
  <section class="py-10">
    <div class="md:container md:mx-auto p-4">
      <h2 class='uppercase text-2xl text-cyan-800 font-semibold'>Contact Alberta Crane Service</h2>
      <div class="flex-rows md:flex pt-10 gap-10">
        <div class="w-full py-5 md:py-0 md:w-1/2">
          <img src="{{ asset('img/acs-logo-new.png') }}" alt="Albert Crane Service Ltd" class="float-left">
          <p class="text-xl leading-12">
            <span class="block pb-5">
              Founded in 2013, Alberta Crane Service Ltd. has quickly become well-known and respected in the heavy equipment industry.
            </span>
            Located in Edmonton, Alberta, Canada, Alberta Crane Service Ltd. is a proudly Canadian owned and operated company providing you with over 38 years experience in the crane industry. With our cranes located worldwide, we are proud to offer our customers with a service and professionalism that cannot be matched. We specialize in buying and selling cranes all over the globe.</p>
        </div>
        <div class="w-full py-5 md:py-0 md:w-1/2">
        
          <x-forms.contact/>
        </div>
      </div>      
    </div>
  </section>
  
  @endsection
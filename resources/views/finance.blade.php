  @extends('template')

  @section('title')
    Crane & Heavy equipment financing
  @endsection
  
  @section('vh')
  vh-50 hero-bg
  @endsection
  @section('h1-text')
    <h1 class="text-white uppercase font-bold text-2xl lg:text-4xl">Cranes & Heavy Equipment Financing</h1>
  @endsection
  @section('content')
   
  <section id='breadcrumbs' class="p-5">
    <div class="text-start uppercase font-semibold font-xl text-cyan-800"><a href="{{ route('home') }}">Home</a> > <a href='{{ route('finance') }}'>Heavy Equipment Financing</a></div>
  </section>
  
  <section class="py-10">
    <div class="md:container md:mx-auto p-4">
      <h2 class='uppercase text-2xl text-cyan-800 font-semibold'>Financing Options</h2>
      <p class="py-5 text-lg">
        A lot of people are always wondering if they should get their equipment financed. The answer to that question is yes, you should get your equipment financed. Equipment financing is a great way to get the equipment that you need for your business without having to pay for it all at once.
      </p>
      <p class="py-5 text-lg mb-10">
        There are many benefits to getting your equipment financed instead of paying for it all at once upfront. The most important benefit is that you don't have to come up with a large lump sum payment right away which means that you can save up money beforehand and then make payments on the loan as they come due while still having enough money left over to cover other expenses like marketing or payroll. This can be especially useful if your business isn't doing well because then you can finance the equipment over a term.
      </p>
      <div class="flex-rows lg:flex justify-center items-center gap-5 bg-neutral-50 rounded-xl ring-2 ring-cyan-700 relative lg:h-96 py-10 lg:py-0">
        
        <img src="{{ asset('img/equipment-capital-corp.jpg') }}" alt="Used equipment Financing provided by Canadian Equipment Finance - Alberta Crane Service" class="w-full pb-5 px:2 md:px-0 lg:pb-0 lg:float-left lg:w-1/2 lg:m-2 rounded-xl shadow">
        <div class="px-5 lg:px-0">
          <h3 class="uppercase text-cyan-800 font-medium pb-5 lg:pb-0 text-xl lg:text-3xl lg:absolute lg:top-0 lg:left-2/6 lg:-translate-x-2/6">Equipment Capital Corp.</h3>
          <p class="pb-5 ml-0 md:ml-2.5">
            We know financing can be stressful, thats why we've partnered with them to provide you with the best financing options available.
            Capital Corp Financing is a company that provides financing for small and medium-sized businesses. They are committed to helping entrepreneurs, who have great business ideas, but just need some help with the money.
          </p>
          <p class="ml-0 md:ml-2.5">
            Let Equipmental Capital Corp deal with the complex world of financing, and find the best solution for you, and your company. Equipment Capital Corp understands the crane industry, so let them arrange the financing needed for your business to operate at its peak performance.
  Contact Luke Loran with Equipment Capital Corp, the equipment financing experts.
          </p>
          <div class="block pt-10">
            <a href="https://equipmentcapitalcorp.ca/" target="_blank" class="bg-cyan-600 hover:bg-cyan-700 shadow px-4 py-2 rounded-xl text-white uppercase font-medium">Contact Today</a>
          </div>
        </div>
      </div>      
    </div>
  </section>
  
  @endsection
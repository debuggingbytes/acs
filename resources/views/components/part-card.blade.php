<!-- create card -->
<div class="p-2 bg-neutral-50 rounded-lg relative drop-shadow-lg bg-gradient-to-t from-neutral-300 via-slate-300 to-cyan-800 border-solid border-2 border-sky-800 w-full sm:w-1/5 fadeIn">
  <img src="{{ asset( $image ) }}" class="w-full h-48" alt="{{ $crane }}"/>
  <div class="crane block">
    <h3 class='uppercase text-center font-bold mb-5'>
      <span class="block text-xl">{{ $crane }}</span>
      <span class="block text-xs">for sale</span>
    </h3>
    <a href='{{ route($route)}}' class="block bg-cyan-900 px-7 py-3 mx-2 my-5 rounded-xl text-center uppercase text-white font-semibold">
      View Parts
    </a>
  </div>
  </div>
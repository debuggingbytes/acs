<footer class="w-full bg-cyan-900 h-auto xl:h-80 text-xl relative">
  <div class="md:container px-5  md:px-0 mx-auto md:grid grid-rows md:grid-cols-3 pt-5">
    <div class="text-start pb-5 md:pb-0">
      <h4 class="text-lg text-white font-medium uppercase tracking-wide border-b-2 inline-block pb-1 mb-3">Misc
        Inventory</h4>
      {{-- <img src="https://www.albertacraneservice.com/files/acs-logo-new.png" class="mr-3 h-6 sm:h-28"
        alt="Used Cranes | Alberta Crane Service"> --}}
        <livewire:templates.footer-inventory />
    </div>
    <div class="text-start pb-5 md:pb-0 text-white">
      <h4 class="text-lg text-white font-medium uppercase tracking-wide border-b-2 inline-block w-24 pb-1 mb-3">Sitemap
      </h4>
      <div class="block w-full uppercase">
        <ul>
          <li class="pb-2"><i class="fa-solid fa-house-chimney mr-3 w-8"></i><a wire:navigate href='{{ route('home') }}'>home</a></li>
          <li class="pb-2"><i class="fa-solid fa-warehouse mr-3 w-8"></i><a wire:navigate href='{{ route('inventory') }}'>inventory</a></li>
          <li class="pb-2"><i class="fa-solid fa-hand-holding-dollar mr-3 w-8"></i><a wire:navigate href='{{ route('finance') }}'>financing</a></li>
          <li class="pb-2"><i class="fa-solid fa-at mr-3 w-8"></i><a wire:navigate href='{{ route('contact') }}'>contact</a></li>
        </ul>
      </div>
    </div>
    <div class="text-start pb-20 md:pb-0">
      <h4 class="text-lg text-white font-medium uppercase tracking-wide border-b-2 inline-block w-24 pb-1 mb-3">Contact
      </h4>
      <div class="block w-full uppercase text-white ">
        <ul>
          <li class="pb-2">
            <span class="fa-solid fa-mobile-screen mr-3 w-8"></span><a href='tel:780-803-2302'  class="">780-803-2302</a>
          </li>
          <li class="pb-2">
            <span class="fa-brands fa-twitter mr-3 w-8"></span><a href='https://www.facebook.com/AlbertaCraneService/' target="_blank"  class="">Facebook</a>
          </li>
          <li class="pb-2">
            <span class="fa-brands fa-facebook mr-3 w-8"></span><a href='https://twitter.com/albertacranesrv'  class="" target="_blank">Twitter</a>
          </li>
          <li class="pb-2">
            <span class="fa-regular fa-envelope mr-3 w-8"></span><a href='mailto:contact@albertacraneservice.com'  class="">Email</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="absolute bottom-1 left-1/2 -translate-x-1/2 pt-14 lg:pt-0 w-full" >
    <h6 class="block uppercase text-xs text-white text-center w-full">
      <span class="copyright block"></span>
      <span class="block">Website developed and maintained by <a href='https://www.debuggingbytes.com'>DebuggingBytes.com</a></span>
    </h6>
  </div>
</footer>

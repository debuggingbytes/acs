<footer class="w-full bg-cyan-900 py-12 md:py-20 relative">  {{-- Increased padding, removed fixed height --}}
  <div class="container mx-auto flex flex-col md:flex-row justify-center items-center">  {{-- Flexbox for layout --}}

      <div class="w-full md:w-1/3 mb-8 md:mb-0 flex flex-col justify-center items-center">  {{-- Misc Inventory Section --}}
          <h6 class="text-lg text-white font-medium uppercase tracking-wide mb-6">
              Misc Inventory
          </h6>
          <livewire:templates.footer-inventory />
      </div>

      <div class="w-full md:w-1/3 mb-8 md:mb-0 flex flex-col justify-center items-center">  {{-- Sitemap Section --}}
          <h6 class="text-lg text-white font-medium uppercase tracking-wide mb-6">
              Sitemap
          </h6>
          <ul class="text-white">
              <li class="mb-2">
                  <a wire:navigate href="{{ route('home') }}" class="flex items-center hover:text-orange-500">
                      <i class="fa-solid fa-house-chimney mr-2"></i> Home
                  </a>
              </li>
              <li class="mb-2">
                  <a wire:navigate href="{{ route('inventory') }}" class="flex items-center hover:text-orange-500">
                      <i class="fa-solid fa-warehouse mr-2"></i> Inventory
                  </a>
              </li>
              <li class="mb-2">
                  <a wire:navigate href="{{ route('finance') }}" class="flex items-center hover:text-orange-500">
                      <i class="fa-solid fa-hand-holding-dollar mr-2"></i> Financing
                  </a>
              </li>
              <li class="mb-2">
                  <a wire:navigate href="{{ route('contact') }}" class="flex items-center hover:text-orange-500">
                      <i class="fa-solid fa-at mr-2"></i> Contact
                  </a>
              </li>
          </ul>
      </div>

      <div class="w-full md:w-1/3 flex flex-col justify-center items-center">  {{-- Contact Section --}}
          <h6 class="text-lg text-white font-medium uppercase tracking-wide mb-6">
              Contact Us
          </h6>
          <ul class="text-white">
              <li class="mb-2 flex items-center hover:text-orange-500">
                  <i class="fa-solid fa-phone mr-2"></i> <a href="tel:780-803-2302">780-803-2302</a>
              </li>
              <li class="mb-2 flex items-center hover:text-orange-500">
                  <i class="fa-brands fa-facebook mr-2"></i> <a href="https://www.facebook.com/AlbertaCraneService/" target="_blank" rel="noopener noreferrer">Facebook</a>
              </li>
              <li class="mb-2 flex items-center hover:text-orange-500">
                  <i class="fa-brands fa-twitter mr-2"></i> <a href="https://twitter.com/albertacranesrv" target="_blank" rel="noopener noreferrer">Twitter</a>
              </li>
              <li class="mb-2 flex items-center hover:text-orange-500">
                  <i class="fa-regular fa-envelope mr-2"></i> <a href="mailto:contact@albertacraneservice.com">Email</a>
              </li>
          </ul>
      </div>

  </div>

  <div class="text-center text-xs text-white py-6 absolute bottom-0 left-0 w-full">  {{-- Copyright --}}
      <span class="block">&copy; {{ date('Y') }} Alberta Crane Service Ltd., All rights reserved.</span>  {{-- Dynamic year --}}
      <span class="block">Website developed and maintained by <a href="https://www.debuggingbytes.com" target="_blank" rel="noopener noreferrer" class="underline hover:text-orange-500">DebuggingBytes.com</a></span>
  </div>
</footer>
<button class="md:hidden px-2 py-1 bg-cyan-600 rounded-md" id='toggleNav'>
  <img src="{{asset('img/icons/menu-closed.svg')}}" alt="open navigation" width="32px" height="32px" class="menuIcon">
</button>
{{-- Desktop Navigation --}}
<div class="hidden justify-between items-center w-1/2 md:flex md:w-auto md:order-1" id="navbar-sticky">
  <ul
    class="flex flex-col p-4 mt-6 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-transparent items-center">
    <li>
      <a wire:navigate href="{{ route('home') }}"
        class="block py-2 pr-4 pl-3 text-gray-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-md uppercase">Home</a>
    </li>
    <li>
      <a wire:navigate href="{{ route('inventory') }}"
        class="block py-2 pr-4 pl-3 text-gray-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-md uppercase">Inventory</a>
    </li>
    <li>
      <a wire:navigate href="{{ route('finance') }}"
        class="block py-2 pr-4 pl-3 text-gray-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-md uppercase">Financing</a>
    </li>
    <li>
      <a wire:navigate href="{{ route('contact') }}"
        class="block py-2 pr-4 pl-3 text-gray-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-md uppercase">Contact</a>
    </li>
    <li>
      <a wire:navigate href='tel:7808032302'
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 text-md md:block hidden">Call
      us today!</a>
    </li>
    {{-- @auth
    <li>
      Welcome Back {{Auth::user()->id}}
    </li>
    @endauth --}}
  </ul>
</div>
{{-- Mobile Navigation --}}
<div class="mobileNav" aria-expanded="false">
  <div class="mobileNavLinks relative">
    <div class="absolute -top-10 left-1/2 -translate-x-1/2">
      <img src="https://www.albertacraneservice.com/files/acs-logo-new.png" class="content-fill w-auto h-auto " alt="Used Cranes | Alberta Crane Service">
    </div>
    <ul class="text-white pt-20">
      <li class="uppercase text-white font-semibold text-2xl">
        <a wire:navigate href='{{ route('home') }}'>HOME</a>
      </li>
      <li class="uppercase text-white font-semibold text-2xl">
        <a wire:navigate href='{{ route('inventory') }}'>inventory</a>
      </li>
      <li class="uppercase text-white font-semibold text-2xl">
        <a wire:navigate href='{{ route('finance') }}'>financing</a>
      </li>
      <li class="uppercase text-white font-semibold text-2xl">
        <a wire:navigate href='{{ route('contact') }}'>contact</a>
      </li>
    </ul>

    <div class="absolute -bottom-10 left-1/2 -translate-x-1/2 w-full">
      <span class="copyright block w-100 text-white text-center"></span>
      <span class="block text-white text-center">Website created by: <a href='http://www.debuggingbytes.com'>DebuggingBytes</a></span>
    </div>
  </div>
</div>

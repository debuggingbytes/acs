<button class="md:hidden px-2 py-1 bg-cyan-600 rounded-md" id='toggleNav'>
  <img src="{{asset('img/icons/menu-closed.svg')}}" alt="open navigation" width="32px" height="32px" class="menuIcon">
</button>
{{-- Desktop Navigation --}}
<div class="hidden justify-between items-center w-1/2 md:flex md:w-auto md:order-1" id="navbar-sticky">
  <ul
    class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-transparent items-center">
    <li>
      <a href="{{ route('home') }}"
        class="block py-2 pr-4 pl-3 text-gray-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-md uppercase">Home</a>
    </li>
    <li>
        <a href="{{ route('bbcode') }}"
          class="block py-2 pr-4 pl-3 text-gray-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-md uppercase">BBCode</a>
      </li>
  </ul>
</div>
{{-- Mobile Navigation --}}
<div class="mobileNav" aria-expanded="false">
  <div class="mobileNavLinks relative">
    <div class="absolute -top-7 left-1/2 -translate-x-1/2">
      <img src="https://www.albertacraneservice.com/files/acs-logo-new.png" class="content-fill w-auto h-auto" alt="Used Cranes | Alberta Crane Service">
    </div>
    <ul class="text-white pt-20">
        <li class="uppercase text-white font-semibold text-2xl">
            <a href='{{ route('home') }}'>HOME</a>
        </li>

        <!-- New Menu Items -->
        <li class="uppercase text-white font-semibold text-2xl">
            <a href='{{ route('admin.dashboard') }}' wire:navigate>
                    Dashboard
            </a>
        </li>

        <li class="uppercase text-white font-semibold text-2xl">
            <a href='{{ route('profile.user') }}' wire:navigate>
                    My Account
            </a>
        </li>

        <li class="uppercase text-white font-semibold text-2xl">
            <a href='{{route('logout.user')}}' wire:navigate>
                    Logout
            </a>
        </li>

        <li class="uppercase text-white font-semibold text-2xl">
            <a href='{{ route('add.crane.inventory') }}' wire:navigate>
                    Add Crane
            </a>
        </li>

        <li class="uppercase text-white font-semibold text-2xl">
            <a href='{{ route('add.part.inventory') }}' wire:navigate>
                    Add Part
            </a>
        </li>
        <li class="uppercase text-white font-semibold text-2xl">
            <a href='{{ route('add.equipment.inventory') }}' wire:navigate>
                    Add Equipment
            </a>
        </li>
        <li class="uppercase text-white font-semibold text-2xl">
            <a href='{{ route('show.inventory') }}' wire:navigate>
                    Show Inventory
            </a>
        </li>

        <!-- Add Crane Categories and Add Part Categories can be added similarly -->

        <li class="uppercase text-white font-semibold text-2xl">
                Coming Soon
        </li>
    </ul>

    <div class="absolute -bottom-10 left-1/2 -translate-x-1/2 w-full">
      <span class="copyright block w-100 text-white text-center"></span>
      <span class="block text-white text-center">Website created by: <a href='http://www.debuggingbytes.com'>DebuggingBytes</a></span>
    </div>
  </div>
</div>

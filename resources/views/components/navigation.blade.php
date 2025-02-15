<div x-data="{ open: false }">
  <!-- Mobile menu button -->
  <button @click="open = !open" class="md:hidden px-2 py-1 bg-cyan-600 rounded-md absolute top-7 right-2">
    <img :src="open 
      ? '{{asset('img/icons/menu-open.svg')}}' 
      : '{{asset('img/icons/menu-closed.svg')}}'" 
      alt="toggle navigation" width="32px" height="32px" >
  </button>

  <!-- Navigation menu -->
  <div :class="{'hidden': !open}" class="justify-between items-center w-full md:flex md:w-auto md:order-1">
    <ul class="flex flex-col p-4 mt-6 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-transparent items-center">
      <li>
        <a wire:navigate @click="open = false" href="{{ route('home') }}"
          class="block py-2 pr-4 pl-3 text-gray-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-md uppercase">Home</a>
      </li>
      <li>
        <a wire:navigate @click="open = false" href="{{ route('inventory') }}"
          class="block py-2 pr-4 pl-3 text-gray-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-md uppercase">Inventory</a>
      </li>
      <li>
        <a wire:navigate @click="open = false" href="{{ route('finance') }}"
          class="block py-2 pr-4 pl-3 text-gray-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-md uppercase">Financing</a>
      </li>
      <li>
        <a wire:navigate @click="open = false" href="{{ route('contact') }}"
          class="block py-2 pr-4 pl-3 text-gray-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-md uppercase">Contact</a>
      </li>
      <li>
        @auth
          <a wire:navigate @click="open = false" href='{{ route('admin.dashboard')}}'
            class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center mr-3 md:mr-0 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-blue-800 text-md block">
            Dashboard
          </a>
        @else
          <a wire:navigate @click="open = false" href='tel:7808032302'
            class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center mr-3 md:mr-0 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-blue-800 text-md block">
            Call us today!
          </a>
        @endauth
      </li>
    </ul>
  </div>
</div>
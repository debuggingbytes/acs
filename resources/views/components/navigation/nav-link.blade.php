@props(['route', 'routeName'])

<a wire:navigate @click="open = false" href="{{ route($route) }}" class="block py-2 pr-4 pl-3 text-gray-400 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 text-md uppercase
          @if(request()->routeIs($routeName)) text-orange-500 border-b border-orange-500 @endif">
    {{ $slot }}
</a>
<label class="relative inline-flex items-center cursor-pointer bg-cyan-600 px-4 py-2 rounded-xl">
    <input type="checkbox" wire:model='{{$livewire}}' value="" class="sr-only peer" {{$attributes->get('truthy') ? 'checked' : '';}}>
    <div class="w-11 h-6 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full bg-rose-700 peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[0.6rem] after:start-[1.1rem] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-emerald-400"></div>
    <span class="uppercase text-white font-semibold ms-3">{{$label}}</span>
</label>

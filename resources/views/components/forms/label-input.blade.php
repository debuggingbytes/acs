<div class="flex flex-col md:flex-row items-center py-1">
    <label for="{{$name}}" wire:target='{{$livewire}}' wire:dirty.class='bg-yellow-500' class="text-white w-full md:w-1/5 font-bold text-lg uppercase bg-cyan-600 p-1.5 rounded-t-lg md:rounded-none  md:rounded-l-lg
         flex items-center justify-center">{{$label}}</label>
    <input {{$attributes}} wire:model='{{$livewire}}' type="text" id="{{$name}}" name="{{$name}}" class="sm:rounded-b-lg md:rounded-r-lg md:rounded-b-none border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full p-1.5 bg-white
        ">
</div>
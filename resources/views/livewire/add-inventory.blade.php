<div class="rounded-md px-2 py-4">
    {{-- Livewire Modal --}}
    <livewire:modals.InfoModal />

  <form class="block w-100" wire:submit='save'>
    <h3 class="uppercase block text-center rounded-lg py-2 bg-slate-200 shadow-md mb-5">Crane Information</h3>
    <div class="sm:grid sm:gap-2 lg:flex lg:justify-evenly mx-auto w-2/3">
        <x-forms.checkbox-toggle label="Available" livewire="is_available"/>
        <x-forms.checkbox-toggle label="Featured" livewire="is_featured"/>
    </div>
    <div class="flex flex-col md:flex-row items-center py-2 relative">

        <label for="type" class="text-white font-bold text-lg uppercase bg-cyan-600 px-3 rounded-l-lg h-12 flex items-center justify-center w-full md:w-1/5">Crane Type</label>
        <select id="type" name="type" wire:model='type' class="rounded-r-lg border-gray-300 text-black shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full p-3 bg-white h-12 appearance-none">
            <option selected disabled value="null">Select Crane Type</option>
            @foreach ($types as $crane)
                <option value="{{$crane->type}}" class="relative">{{$crane->text}}</option>
            @endforeach
        </select>

        <button class="absolute right-2 px-2.5 py-1.5 bg-green-500 text-white font-bold rounded-xl" wire:click.prevent='showType'>+</button>
    </div>
    @if ($addNewCraneTypeShow)
    <div class="my-10 ring-2 ring-red-500 bg-white shadow-xl rounded-lg ">
        <div class="block">
            <x-forms.label-input name="newtype" label="Add Category" livewire="addNewCraneType" />
        </div>
        <button class="bg-cyan-600 text-white uppercase font-bold block w-full text-center py-2.5 rounded-full" wire:click.prevent='addCraneType'>Add Category</button>
    </div>
    @endif
    <div class="flex flex-col md:flex-row items-center py-2">
        <label for="year" class="text-white w-full md:w-1/5 font-bold text-lg uppercase bg-cyan-600 px-3 rounded-l-lg h-12 flex items-center justify-center">Year</label>
        <input wire:model='year' type="text" id="year" name="year" class="rounded-r-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full p-3 bg-white h-12">
    </div>
    <x-forms.label-input name="cost" label="cost" livewire="cost" />
    <x-forms.label-input name="sn" label="S/N" livewire="serial_number" />
    <x-forms.label-input name="make" label="make" livewire="make" />
    <x-forms.label-input name="model" label="model" livewire="model"/>
    <x-forms.label-input name="condition" label="condition" livewire="condition" />
    <x-forms.label-input name="boom" label="boom length" livewire="boom"/>
    <div class="flex flex-col md:flex-row items-center py-2">
        <label for="capacity" class="w-full text-white md:w-1/5 font-bold text-lg uppercase bg-cyan-600 px-3 rounded-l-lg h-12 flex items-center justify-center">Capacity</label>
        <input wire:model="capacity" type="text" id="capacity" name="capacity" class="rounded-r-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full p-3 bg-white h-12">
    </div>
    <h3 class="uppercase block text-center rounded-lg py-2 bg-slate-200 shadow-md my-5">Jib Information</h3>

    <x-forms.label-input name="jib" label="jib length" livewire="jib"/>
    <x-forms.label-input name="jibInsert" label="jib inserts" livewire="jibInserts"/>
    <div class="flex flex-col md:flex-row items-center py-2">
        <label for="craneType" class="w-full text-white font-bold text-lg uppercase bg-cyan-600 px-3 rounded-l-lg h-12 flex items-center justify-center md:w-1/5">Jib Type</label>
        <select wire:model='jibType' id="craneType" class="rounded-r-lg border-gray-300 text-black shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full p-3 bg-white h-12 appearance-none">
            <option selected value="na">None
            <option value="Fixed Jib">Fixed</option>
            <option value="Luffing Jib">Luffing</option>
            <option value="Fixed_and_Luffing">Fixed & Luffing</option>
        </select>
    </div>
    <h3 class="uppercase block text-center rounded-lg py-2 bg-slate-200 shadow-md my-5">Engine Information</h3>

    <x-forms.label-input name="Upper" label="upper hours" livewire="hoursUpper" />
    <x-forms.label-input name="Lower" label="lower hours" livewire="hoursLower" />
    <x-forms.label-input name="mileage" label="mileage" livewire="mileage"/>

    <div class="flex flex-col md:flex-row items-center py-2">
        <input type="text" class="text-white w-full md:w-1/5 font-bold text-lg uppercase bg-cyan-600 px-3 rounded-t-lg md:rounded-none  md:rounded-l-lg  h-12 flex items-center justify-center" placeholder="Add Custom Name" wire:model.live='customKey'>
        <input type="text" class="sm:rounded-b-lg md:rounded-r-lg md:rounded-b-none border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full p-3 bg-white h-12" placeholder="Custom Value" wire:model.live='customValue'>
        @if ($customKey && $customValue)
            <button class="bg-green-500 px-2 rounded-xl py-1 ml-4" wire:click.prevent='addCustomField'>Add</button>
        @endif
    </div>
    @if(!empty($customFields))
    <div class="grid grid-rows-3 w-2/3 mx-auto">
      @foreach($customFields as $index => $field)
        @foreach($field as $key => $value)
          <div class="border border-1 p-2 border-sky-800 block bg-zinc-50 relative">{{ $key }}: {{ $value }}
            <div class="absolute right-5 top-1/2 -translate-y-1/2 bg-red-500 rounded-md px-2 py-1 text-white">
                <button class="text-white" wire:click.prevent='removeCustom({{$index}})'>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" width="24" height="24" viewBox="0 0 24 24"><path d="M3 6v18h18v-18h-18zm5 14c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4-18v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712z"/></svg>
                </button>
            </div>
          </div>
        @endforeach
      @endforeach
    </div>
    @endif

    <h3 class="uppercase block text-center rounded-lg py-2 bg-slate-200 shadow-md my-5">Additional Information</h3>
    <div class="flex flex-col md:flex-row items-center py-2">
        <label for="description" class="w-full text-white md:w-1/5 font-bold text-lg uppercase bg-cyan-600 px-3 rounded-l-lg h-12 md:h-32 flex items-center">Description</label>
        <textarea wire:model.live='description' id="description" name="description" class="rounded-r-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full p-3 bg-white h-32"></textarea>
    </div>
    <div class="flex items-center justify-center w-full">
        <button class='rounded-xl px-4 py-2 bg-cyan-500 text-white uppercase text-lg' wire:click.prevent='descriptionLiveToggle'>Enable Live View</button>
    </div>
    <div class="flex w-3/4 mx-auto mt-5">
        @if ($this->descriptionLive)
            <div class="bg-neutral-50 rounded-xl shadow-lg ml-4 p-2">
                @if(!empty($this->description))
                    @bb($this->description)
                @endif
            </div>
        @endif
    </div>
    <h3 class="uppercase block text-center rounded-lg py-2 bg-slate-200 shadow-md mt-8 mb-4">Upload Images</h3>
    <div class="block w-full">
        <div wire:loading.delay.long class="w-full">
            <div class="rounded-lg bg-green-500 flex justify-center items-center p-5 w-1/2 mx-auto">
                <span class="uppercase text-white">Loading Images... Please wait</span>
            </div>
          </div>
    </div>

    <div class="block rounded-md mb-4 w-full bg-white">
        <div class="flex flex-col md:flex-row items-center justify-center">
          <label for="files" class="w-full h-12 md:w-1/5 md:h-40 text-white font-bold bg-cyan-600 py-2 px-4 rounded-l-md cursor-pointer hover:bg-cyan-700 flex items-center justify-center">
            <span class="text-lg">Choose Files</span>
            <input type="file" id="files" multiple wire:model="newImages" class="hidden">
          </label>
          <div class="grid grid-cols-4 gap-1 w-full pl-2">

            @if($images)
              @foreach($images as $key => $image)
                <div class="min-w-fit md:w-1/4 mb-4 relative">
                    <div class="absolute bottom-2 w-full" >
                        <div class="flex justify-between">
                            @if(!$loop->first)
                            <svg wire:click.prevent='moveImage({{$key}}, {{$key - 1}})' xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 rounded-md cursor-pointer text-white bg-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                              </svg>
                            @endif

                            <svg wire:click.prevent='removeImage({{$key}})' xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer rounded-md text-white bg-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>

                            @if(!$loop->last)
                            <svg wire:click.prevent='moveImage({{$key}}, {{$key + 1}})' xmlns="http://www.w3.org/2000/svg" class="h-6 rounded-md cursor-pointer w-6 text-white bg-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                              </svg>
                            @endif
                        </div>
                    </div>
                  <img src="{{ $image->temporaryUrl() }}" alt="Uploaded Image" class="rounded-lg w-full h-auto md:h-32 object-cover mt-2">
                </div>
              @endforeach
            @endif
          </div>

        </div>
      </div>
      @if(session('error'))
        <div class="bg-red-500 rounded-md p-2 mx-auto w-1/2 text-bold block my-2 text-center">{{ session('error') }}</div>
    @endif
    <div class="block rounded-full w-1/3 mt-5 mx-auto bg-cyan-600 text-center px-4 py-2">
        <button type="submit" name="submit" class="text-white font-bold uppercase" @if (empty($images))
        wire:confirm='Are you sure you want to submit without images?' @endif>Add Inventory</button>
    </div>
  </form>
</div>

<div class="p-2 relative">
    <h1 class="text-2xl text-cyan-900 font-bold">Site Settings</h1>
    <p>This is the major configurations that the website runs off of, be careful with the settings that you change</p>
    <span class="block text-lg md:text-2xl text-cyan-800 my-5 font-bold">Site Information</span>
    @php $counter = 0; @endphp
    @foreach($configs as $config)
        @if(! Str::startsWith($config->key, 'license_') && ! Str::startsWith($config->key, 'max_'))
            <div class="mb-1">
                <x-forms.label-input :label="Str::replace('_', ' ', $config->key)" name="inputs.{{ $config->key }}"
                    livewire="inputs.{{ $config->key }}" />
            </div>
        @elseif(Str::startsWith($config->key, 'max_'))
            @if($counter == 0)
                <span class="block text-lg md:text-2xl text-cyan-800 my-5 font-bold">Max Allowed Values for your product</span>
                @php $counter++; @endphp

            @endif
        @endif
    @endforeach
    @if(Auth::user()->user_level == 3)
        <span class="block text-lg md:text-2xl text-cyan-800 my-5 font-bold">License Information</span>
        @foreach($configs as $config)
            @if(Str::startsWith($config->key, 'license_'))
                <div class="mb-1">
                    <div class="flex flex-col md:flex-row items-center py-1">
                        <label for="{{$config->readableKey}}"
                            class="text-white w-full md:w-1/5 font-bold text-lg uppercase bg-cyan-600 p-1.5 rounded-t-lg md:rounded-none  md:rounded-l-lg
                                                                                                                                                                             flex items-center justify-center">{{$config->readableKey}}</label>
                        <input type="text" id="{{$config->readableKey}}" name="{{$config->readableKey}}" value="{{$config->value}}"
                            disabled
                            class="sm:rounded-b-lg md:rounded-r-lg md:rounded-b-none border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full p-1.5 bg-white
                                                                                                                                                                            ">
                    </div>
                </div>
            @endif
        @endforeach
    @endif
    @if (session()->has('message'))
        <div class="mt-2 text-green-500">{{ session('message') }}</div>
    @endif
</div>
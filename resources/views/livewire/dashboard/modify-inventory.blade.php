
        {{-- Livewire Modal --}}
        <div>
            <livewire:modals.InfoModal />

            <h3 class="text-white bg-cyan-700 rounded-tl-md rounded-tr-md p-2 hover:bg-cyan-800 uppercase">
                <strong>Updating {{ $inventory->craneinventory->cleanSlug ?? $inventory->partInventory?->equipmentInventory->cleanSlug }}</strong>
            </h3>

            <div class="flex flex-col lg:flex-row gap-4 p-2 justify-center lg:relative">
                <div class="inline-block justify-self-end lg:absolute lg:top-1 lg:right-1">
                    <button class="bg-red-500 rounded-xl uppercase text-white px-4 py-2" wire:click='deleteInventory({{$inventory->id}})' wire:confirm='Are you sure you want to delete this?'>DELETE INVENTORY</button>
                </div>
                @if ($inventory->craneInventory)
                    @empty($boom)
                        <button class="px-4 py-2 bg-cyan-700 text-white uppercase rounded-xl shadow-md" wire:click='addValue("boom")'>Add Boom Length</button>
                    @endempty
                    @empty($jibType)
                        <button class="px-4 py-2 bg-cyan-700 text-white uppercase rounded-xl shadow-md" wire:click='addValue("jibType")'>Add Jib Type</button>
                    @endempty

                    @empty($hoursLower)
                        <button class="px-4 py-2 bg-cyan-700 text-white uppercase rounded-xl shadow-md" wire:click='addValue("hoursLower")'>Add Lower Hours</button>
                    @endempty

                    @empty($mileage)
                        <button class="px-4 py-2 bg-cyan-700 text-white uppercase rounded-xl shadow-md" wire:click='addValue("mileage")'>Add Mileage</button>
                    @endempty

                    @empty($capacity)
                        <button class="px-4 py-2 bg-cyan-700 text-white uppercase rounded-xl shadow-md" wire:click='addValue("capacity")'>Add Capacity</button>
                    @endempty
                    @empty($jibInserts)
                        <button class="px-4 py-2 bg-cyan-700 text-white uppercase rounded-xl shadow-md" wire:click='addValue("jibInserts")'>Add Jib Inserts</button>
                    @endempty
                @endif

                @empty($serialNumber)
                    <button class="px-4 py-2 bg-cyan-700 text-white uppercase rounded-xl shadow-md" wire:click='addValue("serialNumber")'>Add Serial Number</button>
                @endempty

            </div>
            <div class="block w-2/3 mx-auto p-2 bg-cyan-700 rounded-md shadow-xl my-5">
                @if(!empty($thumbnail))<img src="{{$thumbnail}}" class="max-w-contain rounded-md">@else No Thumbnail. @endif
            </div>

            <div class="flex w-full">
                @if($errors->any())
                <div class="text-red-500">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form class="block w-full p-2" wire:submit='saveChanges'>
                    <div wire:dirty.class='flex justify-center items-center mx-auto my-3 w-1/2 px-4 py-2 bg-yellow-500 rounded-xl'>
                        <span wire:dirty>You currently have unsaved changes.</span>
                    </div>
                    <div class="flex flex-col gap-2 pb-5 lg:pb-2 lg:flex-row justify-evenly mx-auto w-2/3">
                        <x-forms.checkbox-toggle label="Available" livewire="is_available" :truthy="$this->is_available"/>
                        <x-forms.checkbox-toggle label="Featured" livewire="is_featured" :truthy="$this->is_featured"/>
                    </div>
                    <x-forms.label-input name="Price" label="Price" livewire="cost" />
                    <x-forms.label-input name="Slug" label="Url Slug" livewire="slugName" disabled="true"/>
                    @if($type)
                        <x-forms.label-input name="type" label="type" livewire="type" />
                    @endif
                    @if($serialNumber)
                        <x-forms.label-input name="serialNumber" label="S/N" livewire="serialNumber"/>
                    @endif
                    <x-forms.label-input name="year" label="year" livewire="year"/>
                    <x-forms.label-input name="make" label="make" livewire="make"/>
                    @if($model)
                        <x-forms.label-input name="model" label="model" livewire="model"/>
                    @endif
                    @if($capacity)
                        <x-forms.label-input name="capacity" label="capacity" livewire="capacity"/>
                    @endif
                    @if($boom)
                        <x-forms.label-input name="boom" label="boom" livewire="boom"/>
                    @endif
                    @if($jib)
                        <x-forms.label-input name="jib" label="jib" livewire="jib"/>
                    @endif
                    @if ($jibInserts)
                        <x-forms.label-input name="jibInserts" label="jib inserts" livewire="jibInserts"/>
                        <span class="block text-center text-sm">Jib Inserts should be seperated by a comma ","  <strong>Ex: 40,40,50</strong></span>
                    @endif
                    @if($jibType)
                        <x-forms.label-input name="jibType" label="jibType" livewire="jibType"/>
                    @endif
                    @if($hoursLower)
                        <x-forms.label-input name="Lower" label="Lower" livewire="hoursLower"/>
                    @endif
                    @if($hoursUpper)
                        <x-forms.label-input name="Upper" label="Upper" livewire="hoursUpper"/>
                    @endif
                    @if($mileage)
                        <x-forms.label-input name="mileage" label="mileage" livewire="mileage"/>
                    @endif
                    {{-- Custom Fields --}}
                    <div class="bg-cyan-600/60 text-center rounded-xl px-2 pb-4">
                        <span class="uppercase text-white font-semibold text-lg block">Custom Fields</span>
                        <span>Here is the custom fields you created, These fields will automatically be updated and saved when you click off of them.</span>
                    @if($customFields)
                        @foreach($customFields as $index => $field)
                        <div class="flex flex-col md:flex-row items-center py-2">
                            <input type="text" class="text-center text-white w-full md:w-1/5 font-bold text-lg uppercase bg-cyan-600 px-3 rounded-t-lg md:rounded-none  md:rounded-l-lg  h-12 flex items-center justify-center" wire:key='{{$index}}' wire:model.blur='customFieldsData.{{$index}}.key'>
                            <input type="text" class="sm:rounded-b-lg md:rounded-r-lg md:rounded-b-none border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full p-3 bg-white h-12" wire:key='{{$index}}' wire:model.blur='customFieldsData.{{$index}}.value'>
                        </div>
                        @endforeach
                    @endif
                    </div>

                    <x-forms.label-input name="condition" label="condition" livewire="condition"/>
                    <div class="flex items-center py-2">
                        <label for="description" class="text-white w-1/5 font-bold text-lg uppercase bg-cyan-600 px-3 rounded-l-lg h-32 flex items-center">Description</label>
                        <textarea wire:model='description' id="description" name="description" class="rounded-r-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full p-3 bg-white h-32"></textarea>
                    </div>
                    {{-- Display all images in table like form  OR show upload images--}}


                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 items-center justify-center my-5" >
                        <li class="me-2">
                            <a href="#" wire:click.prevent='toggleView' class="inline-block px-4 py-3 @if($showImages) text-white bg-blue-600 @else hover:text-gray-900 hover:bg-gray-100 @endif rounded-lg ">View Images</a>
                        </li>
                        <li class="me-2">
                            <a href="#" wire:click.prevent='toggleView' class="inline-block px-4 py-3 rounded-lg @if(!$showImages) text-white bg-blue-600 @else hover:text-gray-900 hover:bg-gray-100 @endif">Upload Images</a>
                        </li>
                    </ul>

                    @if ($showImages)
                    <div class="overflow-hidden border-2 rounded-lg">
                        <div class="bg-cyan-700 px-2 py-1">
                            <!-- Table header -->
                            <div class="flex w-full gap-2 font-bold justify-between items-center uppercase text-white h-8">
                                <div class="w-1/12 text-center">IMG</div>
                                <div class="truncate w-9/12 text-center">PATH</div>
                                <div class="w-1/12 text-center">Position</div>
                                <div class="w-1/12 text-center">Thumbnail</div>
                                <div class="truncate w-1/12 text-center">DELETE</div>
                            </div>
                        </div>
                        <div class="bg-white divide-y divide-gray-200">
                            <!-- Table rows -->
                            @foreach ($images->sortBy('image_order') as $index => $image)
                            <div class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200 px-2 py-1">

                                <div class="flex w-full gap-2 text-gray-800  justify-between">
                                    <div class="w-1/12 "><img src='{{asset("$image->image_path")}}' class="h-16"></div>
                                    <div class="truncate w-9/12 flex justify-center items-center">{{$image->image_path}}</div>
                                    <div class="w-1/12 flex justify-center items-center">
                                        {{-- up --}}
                                        {{$image->image_order}}
                                        @if($image->image_order != 0 )
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-8 h-8 cursor-pointer" wire:key='{{$image->id}}' wire:click.prevent='moveImagePosition("{{$image->image_order}}", "lower")' viewBox="0 0 24 24" stroke="#38A169">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg>
                                        @endif
                                        {{-- down --}}
                                        @if($image->image_order <= (count($images)-2))
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-8 h-8 cursor-pointer" wire:click.prevent='moveImagePosition("{{$image->image_order}}", "higher")' viewBox="0 0 24 24" stroke="#38A169">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="w-1/12 flex justify-center items-center">
                                        @if ($image->image_path != $inventory->thumbnail)
                                        <button wire:click.prevent='makeThumbnail("{{$image->image_path}}")'>
                                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-500 h-8">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <path d="M21 15l-5-5L5 21"/>
                                          </svg>
                                        </button>
                                        @else
                                          Current

                                        @endif
                                    </div>
                                    <div class="w-1/12 text-center flex justify-center items-center">
                                    <button wire:click.prevent='deleteImage("{{$image->id}}", "{{$image->image_path}}")' wire:confirm='Are you sure you want to delete this image?'>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500 h-8">
                                            <circle cx="12" cy="12" r="10"/>
                                            <line x1="15" y1="9" x2="9" y2="15"/>
                                            <line x1="9" y1="9" x2="15" y2="15"/>
                                        </svg>
                                    </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="block rounded-full w-1/3 mt-5 mx-auto bg-cyan-600 text-center px-4 py-2">
                        <button type="submit" name="submit" class="text-white font-bold uppercase">Save Inventory</button>
                    </div>
                </form>
                    @else
                    <div class="overflow-hidden border-2 rounded-lg">
                        <div class="bg-cyan-700">
                            <h3 class="uppercase text-white font-bold text-center">Image Upload</h3>
                            <div class="bg-white  px-2 py-1">
                                <div class="flex items-center justify-center">
                                    <label for="files" class="flex items-center justify-center w-1/5 h-40 text-white font-bold bg-cyan-600 py-2 px-4 rounded-l-md cursor-pointer hover:bg-cyan-700 ">
                                      <span class="text-lg">Choose Files</span>
                                      <input type="file" id="files" multiple wire:model="uploadImages" class="hidden">
                                    </label>
                                    {{-- {{$uploadImages }} --}}
                                    <div class="grid grid-cols-4 gap-1 w-full pl-2">
                                      @if($uploadImages)
                                        @foreach($uploadImages as $upload)
                                          <div class="min-w-fit md:w-1/4 mb-4">
                                            <img src="{{ $upload->temporaryUrl() }}" alt="Uploaded Image" class="rounded-lg w-full h-auto md:h-32 object-cover mt-2">
                                          </div>
                                        @endforeach
                                      @endif
                                    </div>
                                </div>
                                <div class="flex justify-center items-center p-3">
                                    <button wire:click='uploadImage' type="button" class="px-4 py-2 uppercase text-white bg-cyan-600 rounded-xl">Upload Images</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif


                    {{-- @dd(Storage::disk('public')->allFiles('inventory/1')) --}}

            </div>
        </div>

<div class="md:container md:mx-auto p-4">
    <livewire:count-live-views />
    <div class="p-2 relative w-full">
        {{-- Breadcrumb Navigation --}}
        <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 shadow-md drop-shadow-md"  aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('home') }}" class="hover:text-cyan-600">Home</a> > </li> 
                <li><a href="{{ route('inventory') }}" class="hover:text-cyan-600">Inventory</a> ></li>
                <li><a href="{{ route('category', ['slug' => $inventory->craneInventory->kebab_type]) }}" class="hover:text-cyan-600">{{ ucwords($inventory->craneInventory->ReadableType) }}</a> ></li>
                <li class="text-cyan-600">{{ $inventory->craneInventory->subject }}</li>
            </ol>
        </nav>

        {{-- Main Content --}}
        <div class="">
            {{-- Title Section with SOLD overlay --}}
            <div class="relative my-8">
                @if(!$inventory->is_available)
                    <div class="absolute inset-0 bg-white/80 backdrop-blur-sm rounded-lg flex items-center justify-center z-10">
                        <span class="text-6xl md:text-9xl transform -rotate-12 text-red-600 font-bold border-4 border-red-600 px-8 py-2 rounded-xl bg-white/90">
                            SOLD
                        </span>
                    </div>
                @endif
                
                <h2 class="text-3xl md:text-5xl font-bold text-cyan-800">
                    {{ $inventory->craneInventory->year }} {{ $inventory->craneInventory->subject }}
                </h2>
            </div>

            {{-- Image Gallery and Details Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Image Gallery --}}
                <x-inventory.image-gallery 
                    :images="$inventory->images" 
                    :main-image="$inventory->images->first()"
                    :alt-text="$inventory->craneInventory->subject" 
                />

                {{-- Details Panel --}}
                <div class="space-y-6 bg-white rounded-xl shadow-lg p-6">
                    {{-- Price (if available) --}}
                    @if($inventory->cost)
                        <div class="text-3xl font-bold text-cyan-800 mb-5">
                            Price: {{ $inventory->cost }}
                        </div>
                    @endif

                    {{-- Quick Stats --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">
                        <x-inventory.stat-item label="Year" :value="$inventory->craneInventory->year"/>
                        <x-inventory.stat-item label="Make" :value="$inventory->craneInventory->make"/>
                        <x-inventory.stat-item label="Model" :value="$inventory->craneInventory->model"/>
                        <x-inventory.stat-item label="Condition" :value="$inventory->craneInventory->condition"/>
                        <x-inventory.stat-item label="Capacity" :value="$inventory->craneInventory->capacity"/>
                        <x-inventory.stat-item label="Boom Length" :value="$inventory->craneInventory->boom"/>
                        <x-inventory.stat-item label="Jib Length" :value="$inventory->craneInventory->jib ?? ''"/>
                        <x-inventory.stat-item label="Jib Type" :value="$inventory->craneInventory->jibType ?? ''"/>
                    </div>

                    <div x-data="{ activeTab: 'description' }" class="mt-12">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex space-x-8">
                                <button 
                                    @click="activeTab = 'description'"
                                    class="border-b-2 border-cyan-600 my-5 px-4 py-2 text-black font-medium transition duration-300 ease-in-out border-"
                                >
                                    Details
                                </button>
                                <button 
                                    @click="activeTab = 'specs'"
                                    :class="{'border-cyan-500 text-cyan-600': activeTab === 'specs'}"
                                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                                >
                                    Specifications
                                </button>
                                
                            </nav>
                        </div>
        
                        <div class="mt-8">
                            
                            <div x-show="activeTab === 'specs'" class="prose max-w-none">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @if($inventory->customFields)
                                        @forelse($inventory->customFields as $field)
                                            <x-inventory.stat-item :label="$field->key" :value="$field->value"/>
                                        @empty
                                            <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-lg shadow-md drop-shadow-md">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    No Specifications Available
                                                </dt>
                                            </div>
                                        @endforelse
                                    @endif
                                </div>
                            </div>
        
                            <div x-show="activeTab === 'description'" class="prose max-w-none">
                                {!! nl2br($inventory->craneInventory->description) !!}
                            </div>
                        </div>
                    </div>

                    {{-- Contact Form --}}
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-4">Request More Information</h3>
                        <livewire:contact.request-crane-info :crane="$inventory" />
                    </div>
                </div>
            </div>

            {{-- Specifications Tab Panel --}}
            

            {{-- Related Items --}}
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Equipment</h2>
                <livewire:inventory.related :inventory="$inventory"/>
            </div>
        </div>
    </div>
</div>
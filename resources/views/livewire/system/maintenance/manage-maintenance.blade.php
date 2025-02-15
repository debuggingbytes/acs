<div class="flex flex-col mb-10 px-2 w-full">

    <h3 class="text-xl font-semibold">Manage Maintenance</h3>
    @if(session('status'))
        @php
            switch (session('status.type')) {
                case 'success':
                    $colour = ['bg-green-500', 'text-green-800'];
                    break;
                case 'negative':
                    $colour = ['bg-red-500', 'text-red-800'];
                    break;
                case 'warning':
                    $colour = ['bg-yellow-500', 'text-yellow-800'];
                    break;
                case 'info':
                    $colour = ['bg-blue-500', 'text-blue-800'];
                    break;
                default:
                    $colour = ['bg-gray-500', 'text-gray-800'];
                    break;
            }
        @endphp
        <x-alert title="{{session('status.title')}}" @class([$colour[0], $colour[1]])>
            <x-slot name="slot">{{ session('status.message') }}</x-slot>
        </x-alert>
    @endif

    <div class="my-10 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-slate-200 rounded-md shadow-md p-4 text-gray-700 h-full flex flex-col items-center justify-center">

            <p class="text-sm mb-2">When you want to put the website into maintenance mode, use the following button.  You will be redirected to the home page, but the website will be in maintenance mode</p>
            @if(!$maintenanceMode)
            <button wire:confirm='This will bring the website down to the public, are you sure?' wire:click="artisanDown"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Start Maintenance
            </button>
            @else
            <button wire:click="artisanUp"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Cancel Maintenance
            </button>
            @endif
        </div>
        <div class="bg-slate-200 rounded-md shadow-md p-4 text-gray-700 h-full flex flex-col items-center justify-between">
            <p class="text-sm mb-2">If you have updated the website and something is not displaying properly, clear the cache</p>
            <button  wire:click="artisanClearCache"
                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Clear Cache
            </button>
        </div>
        <div class="bg-slate-200 rounded-md shadow-md p-4 text-gray-700 h-full flex flex-col items-center justify-between">
            <p class="text-sm mb-2">If you have updated the website and something is not displaying properly, clear the cache</p>
            <button  wire:click="artisanOptimize"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Optimize Server
            </button>
        </div>
        <div class="bg-slate-200 rounded-md shadow-md p-4 text-gray-700 h-full flex flex-col items-center justify-between">
            <p class="text-sm mb-2">If you have updated the website and something is not displaying properly, clear the cache</p>
            <button  wire:click="artisanOptimize"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Debug Mode
            </button>
        </div>
    </div>
    <div class="mt-10">
        <h3 class="text-xl font-semibold">Schedule Maintenance</h3>

        <form wire:submit.prevent="saveMaintenance">
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" wire:model.live="title"
                        class="mt-1 p-2 border rounded-md w-full focus:ring focus:ring-blue-300" required>
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" wire:model.live="description"
                        class="mt-1 p-2 border rounded-md w-full focus:ring focus:ring-blue-300" rows="3"></textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="datetime-local" id="start_date" wire:model.live="start_date"
                        class="mt-1 p-2 border rounded-md w-full focus:ring focus:ring-blue-300" required>
                    @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="datetime-local" id="end_date" wire:model.live="end_date"
                        class="mt-1 p-2 border rounded-md w-full focus:ring focus:ring-blue-300" required>
                    @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="is_active" wire:model.live.live="is_active" @if($is_active) checked @endif
                        wire:key="is_active-{{ $editingMaintenance ? $editingMaintenance->id : 'new' }}"
                        class="w-4 h-4 text-blue-600 bg-gray-200 border-gray-300 rounded focus:ring-blue-500 mr-2">
                    <label for="is_active" class="block text-sm font-medium text-gray-700">Is Active</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="is_completed" wire:model.live.live="is_completed" @if($is_completed) checked
                        @endif wire:key="is_completed-{{ $editingMaintenance ? $editingMaintenance->id : 'new' }}"
                        class="w-4 h-4 text-blue-600 bg-gray-200 border-gray-300 rounded focus:ring-blue-500 mr-2">
                    <label for="is_completed" class="block text-sm font-medium text-gray-700">Is Completed</label>
                </div>

            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Save
                </button>
            </div>
        </form>

        <div class="overflow-x-auto mt-10">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Title
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Start Date
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            End Date
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Active
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Completed
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maintenances as $maintenance)
                        <tr class="@if($loop->even) bg-gray-50 @endif">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $maintenance->title }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $maintenance->description }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $maintenance->start_date }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $maintenance->end_date }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="@if($maintenance->is_active) text-green-500 @else text-red-500 @endif">
                                    {{ $maintenance->is_active ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="@if($maintenance->is_completed) text-green-500 @else text-red-500 @endif">
                                    {{ $maintenance->is_completed ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="editMaintenance({{ $maintenance->id }})"
                                    class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                <buton wire:confirm='Are you sure you want to delete this schedule?' wire:click="deleteMaintenance({{$maintenance->id}})" class="text-red-600 hover:text-red-900 ml-2">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($maintenances->isEmpty())
                <p class="text-center py-4">No maintenances scheduled.</p>
            @endif
        </div>
    </div>
</div>

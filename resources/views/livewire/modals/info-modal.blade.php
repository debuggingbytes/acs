<div>
@if($showModal)
<div x-on:show-modal class="fixed z-9992210 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" wire:ignore.self>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-80 transition-opacity" aria-hidden="true" wire:click="close"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-gray-500 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 flex w-full gap-2 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <div class="flex items-center w-1/4 ">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full">
                                @if($type === 'success')
                                    <!-- Success icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                @elseif($type === 'warning')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01"></path>
                                </svg>

                                @elseif($type === 'error')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>

                                @endif
                            </div>
                        </div>
                        <div class="mt-3 w-3/4">
                            <h1 class='text-xl uppercase font-bold text-cyan-700 block'>{{ $message['heading'] }}</h1>
                            <p class="text-sm text-gray-900">
                                {{$message['message']}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-cyan-500 px-4 py-2 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" wire:click="close" class="w-full uppercase font-bold inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endif
</div>

<div class="flex flex-col mb-10 p-2 w-full">
    <div class="hidden lg:block -my-2 overflow-x-auto sm:-mx-6 w-full">
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
                <div class="my-5">
                    <x-alert title="{{session('status.title')}}" @class([$colour[0], $colour[1]])>
                        <x-slot name="slot">{{ session('status.message') }}</x-slot>
                    </x-alert>
                </div>
        @endif
        <div class="py-2 align-middle block min-w-full sm:px-6 lg:px-6 w-full">
            <div class="overflow-hidden border-2 rounded-lg w-full">
                <div class="bg-cyan-700 px-2 py-1">
                    <div class="flex w-full gap-3 font-bold justify-between items-center uppercase text-white h-8">
                        <div class="truncate w-2/12 text-center">Quote #</div>
                        <div class="truncate w-3/12 text-center">Client Name</div>
                        <div class="truncate w-3/12 text-center">Client Email</div>
                        <div class="truncate w-2/12 text-center">Client Phone</div>
                        <div class="truncate w-1/12 text-center">Download</div>
                        <div class="truncate w-1/12 text-center">Delete</div>
                    </div>
                </div>
                <div class="bg-white divide-y divide-gray-200">
                    @forelse ($quotes as $index => $quote)
                        <div
                            class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200 cursor-pointer px-2 py-1">
                            <div class="flex w-full gap-2 text-gray-800 justify-between items-center">
                                <div class="truncate w-2/12 text-center">{{ $quote->quote_number }}</div>
                                <div class="truncate w-3/12 text-center">{{ $quote->client_name }}</div>
                                <div class="truncate w-3/12 text-center">{{ $quote->client_email }}</div>
                                <div class="truncate w-2/12 text-center">{{ $quote->client_phone }}</div>
                                <div class="truncate w-1/12 text-center">
                                    <button wire:click='streamPdf({{$quote->id}})'
                                        class="text-blue-500 hover:text-blue-700"><i class="fas fa-download"></i></button>
                                </div>

                                <div class="truncate w-1/12 text-center">
                                    <button wire:click='deleteQuote({{ $quote->id }})'
                                        wire:confirm="Are you sure you want to delete this quote?"
                                        class="text-red-500 hover:text-red-700"><i
                                            class="fa-solid fa-trash-can"></i></button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white px-2 py-1 text-gray-800 text-center">No quotes found.</div>
                    @endforelse
                </div>
            </div>
            <div class="mt-5">
                {{ $quotes->links() }}
            </div>

        </div>
    </div>

    <div class="lg:hidden">
        @foreach ($quotes as $index => $quote)
            <div class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200 cursor-pointer mb-4 px-2 py-1">
                <div class="flex flex-col gap-1 text-gray-800">
                    <div class="truncate text-center">{{ $quote->quote_number }}</div>
                    <div class="truncate text-center">{{ $quote->client_name }}</div>
                    <div class="truncate text-center">{{ $quote->client_email }}</div>
                    <div class="truncate text-center">{{ $quote->client_phone }}</div>
                    <div class="truncate text-center">
                        <div class="truncate w-1/12 text-center">
                            <button wire:click='streamPdf({{$quote->id}})' class="text-blue-500 hover:text-blue-700"><i
                                    class="fas fa-download"></i></button>
                        </div>

                        <div class="truncate w-1/12 text-center">
                            <button wire:click='deleteQuote({{ $quote->id }})'
                                wire:confirm="Are you sure you want to delete this quote?"
                                class="text-red-500 hover:text-red-700"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

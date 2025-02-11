<div>
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
</div>
<div class="w-full mt-4">
    @if(!$emailSent)
        <form class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            @csrf
            <div class="lg:col-span-2">
                <input type="email" name="email" id="email" wire:model='email' placeholder="Enter your email address"
                    class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg"
                    required>  </div>
            <input type="text" name="full name" class="hidden" id="fullName" wire:model='fullName'>
            <input type="tel" name="phone" class="hidden" id="phoneNumber" wire:model='phone'>
            <input type="hidden" name="crane" wire:model='crane' value="{{$crane}}">

            <button wire:click.prevent='requestInformation'
                class="w-full lg:w-auto px-6 py-3 rounded-lg bg-blue-500 hover:bg-blue-600 text-white font-medium transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-200">
                Request Information
            </button>
        </form>
    @else
        <p class="text-green-600 font-medium">Your request has been sent!</p>
    @endif
</div>
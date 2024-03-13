<div class=" w-full mt-4">
    @if(!$emailSent)
    <form class="grid grid-rows lg:grid-cols-3">
        @csrf
        <input type="email" name="email" id="email" wire:model='email' placeholder="YourEmail@address.com"
            class="p-2 inline-block rounded-t-xl lg:rounded-tr-none bg-gradient-to-r from-cyan-400 to-cyan-900
             placeholder:text-black placeholder:font-bold  text-lg lg:rounded-l-xl col-span-2">
        <input type="text" name="full name" class="hidden" id="fullName" wire:model='fullName'>
        <input type="tel" name="phone" class="hidden" id="phoneNumber" wire:model='phone'>
        <input type="hidden" name="crane" wire:model='crane' value="{{$crane}}">
        <button wire:click.prevent='requestInformation' class="px-2 border-t-2 border-t-cyan-400 lg:border-t-0 col-span-2 lg:col-span-1 py-1.5 rounded-b-xl lg:rounded-tl-none lg:rounded-bl-none lg:rounded-r-xl
         transition ease-in-out hover:bg-cyan-800 bg-cyan-700 font-bold text-sm
          text-white lg:inline-block">Email Me More</button>
    </form>
    @else
        <p class="text-cyan-700">Your email has been sent</p>
    @endif
</div>

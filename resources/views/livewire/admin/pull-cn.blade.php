<div>
    <button wire:click='pullAPI("crane")' class="bg-cyan-700 text-white px-4 py-2 rounded-lg text-center">Pull Crane API</button>
    <button wire:click='pullAPI("parts")' class="bg-cyan-700 text-white px-4 py-2 rounded-lg text-center">Pull Parts API</button>
    <button wire:click='pullAPI("equipment")' class="bg-cyan-700 text-white px-4 py-2 rounded-lg text-center">Pull Equipment API</button>
    <div wire:loading class="mx-auto w-1/3 bg-emerald-300 rounded-xl text-center" wire:target='pullAPI'>
        Pulling data please wait..
        <div wire:loading class="animate-spin rounded-full border-t-2 border-blue-500 border-solid border-r-2 h-6 w-6"></div>
    </div>
</div>

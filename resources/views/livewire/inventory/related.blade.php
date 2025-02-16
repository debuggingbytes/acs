<div class="w-full grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 p-2">
    @forelse ($relatedInventory as $related)
        <a href="{{ route('crane', ['id' => $related->id, 'slug' => $related->craneInventory->slugName] ) }}" class="w-full block" wire:navigate>
            <div class="w-full block">
                <img src="{{ $related->thumbnail }}" alt="{{ $related->name }}" class="w-full h-48 object-cover">
                <span class="text-center block">{{ $related->craneInventory->subject }}</span>
            </div>
        </a>
    @empty

    @endforelse
</div>

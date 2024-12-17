<div>
    @if (!empty($cranes))
    @foreach ($cranes as $crane)
        <div class="slide  @if($loop->first) current @endif">
            @php
                if($crane->craneInventory){
                    $route = "crane";
                }elseif($crane->equipmentInventory){
                    $route = "equipment";
                }else{
                    $route = "part";
                }
            @endphp
        <a href='{{ route($route, ['id' => $crane->id, 'slug' => $crane->craneInventory->slugName ?? $crane->partInventory->slugName ?? $crane->equipmentInventory->slugName]) }}'>
        <div class="w-full h-full">
            <img
            src="{{ $crane->images[0]->image_path }}"
            alt="{{ ($crane->craneInventory->year ?? $crane->equipmentInventory->year ?? $crane->partInventory->year)." ". ($crane->craneInventory->subject ?? $crane->equipmentInventory->subject ?? $crane->partInventory->make) }}"
            class="object-fit w-full h-full" loading="lazy">
        </div>
        <div class="absolute bottom-0 left-0 bg-cyan-900/90 w-full text-white h-16">
            <div class="content text-center p-0.5">
            <span class="block w-full text-white text-md uppercase font-bold">{{$crane->craneInventory->year ?? $crane->equipmentInventory->year ?? $crane->partInventory->year}}</span>
            <span class="block w-full text-white text-2xl uppercase font-medium drop-shadow-lg">{{$crane->craneInventory->subject ?? $crane->equipmentInventory->make ?? $crane->partInventory->make}}</span>
            </div>
        </div>
        </a>
        </div>
    @endforeach
    @else

    @endif

</div>

<div>
    @if (empty($inventories))
        Sorry, no inventory found.
    @else
        @foreach ($inventories as $inventory)
            @php
                $id = $inventory->id;
                if($inventory->craneinventory){
                    $route = "crane";
                    $slugName = $inventory->craneInventory->slugName;
                    $year = $inventory->craneInventory->year;
                    $subject = $inventory->craneInventory->subject;
                }elseif ($inventory->partinventory){
                    $route = "part";
                    $slugName = $inventory->partInventory->slugName;
                    $year = $inventory->partInventory->year;
                    $subject = $inventory->partInventory->subject;
                }elseif($inventory->equipmentinventory){
                    $route = "equipment";
                    $slugName = $inventory->equipmentInventory->slugName;
                    $year = $inventory->equipmentInventory->year;
                    $subject = $inventory->equipmentInventory->subject;
                }else{
                    throw new Exception("Error Processing Request", 1);
                }

            @endphp
            <div class="block uppercase py-2 md:py-0 text-white">
            <a href='{{ route($route, ['id'=> $id, 'slug' => $slugName]) }}' title="{{$year}} {{$subject}}" class="hover:text-orange-500 text-white
            py-2">{{$year}} - {{ $subject }}</a>
        </div>
        @endforeach
    @endif
</div>

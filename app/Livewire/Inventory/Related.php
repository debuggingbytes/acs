<?php

namespace App\Livewire\Inventory;

use App\Models\Inventory;
use Livewire\Component;

class Related extends Component
{

    public $relatedInventory;

    public function mount($inventory)
    {
        $this->relatedInventory = Inventory::where('id', '!=', $inventory->id)
            ->where('is_available', true)
            ->whereHas('craneInventory', function ($query) use ($inventory) {
                $query->where('type', 'LIKE', "%" . $inventory->craneInventory->type . "%");
                $query->orWhere('capacity', 'LIKE', "%" . $inventory->craneInventory->capacity . "%");
                // $query->orWhere('make', 'LIKE', "%" . $inventory->craneInventory->make . "%");
            })
            ->take(5)
            ->get();
    }
    public function render()
    {
        return view('livewire.inventory.related');
    }
}

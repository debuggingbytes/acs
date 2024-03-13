<?php

namespace App\Livewire\Templates;

use App\Models\Inventory;
use Livewire\Component;

class ScrollingInventory extends Component
{
    public $cranes;

    public function mount()
    {
        $this->cranes = Inventory::with('craneinventory', 'partinventory', 'equipmentinventory','customfields', 'images')->where('is_featured', true)->get();
    }

    public function render()
    {
        return view('livewire.templates.scrolling-inventory');
    }
}

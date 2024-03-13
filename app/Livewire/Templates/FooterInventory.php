<?php

namespace App\Livewire\Templates;

use App\Models\Inventory;
use Livewire\Component;

class FooterInventory extends Component
{
    public $inventories;

    public function mount()
    {
        $this->inventories = Inventory::with('craneinventory', 'partinventory')->inRandomOrder()->limit(5)->get();
    }

    public function render()
    {
        return view('livewire.templates.footer-inventory');
    }
}

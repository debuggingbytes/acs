<?php

namespace App\Livewire\Templates;

use App\Models\Inventory;
use Illuminate\Support\Facades\Cache; // Import Cache
use Livewire\Component;

class ScrollingInventory extends Component
{
    public $cranes;

    public function mount()
    {
        $this->cranes = Cache::remember('featured_cranes', 72000, function () { // Cache for 10 minutes (600 seconds)
            return Inventory::with([
                'craneinventory',
                'partinventory',
                'equipmentinventory',
                'customfields',
                'images'
            ])
                ->where('is_featured', true)
                ->get();
        });
    }

    public function render()
    {
        return view('livewire.templates.scrolling-inventory');
    }
}

<?php

namespace App\Livewire\Templates;

use App\Models\Inventory;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

/**
 * Class ScrollingInventory
 * Renders a scrolling inventory of featured cranes
 *
 */

class ScrollingInventory extends Component
{
    public $cranes;
    public $currentIndex = 0;
    public $autoplayInterval = 5000;

    public function mount()
    {
        $this->cranes = Cache::remember('featured_cranes', 72000, function () { // Cache for 10 minutes (600 seconds)
            return Inventory::with([
                'craneinventory',
                'customfields',
                'images'
            ])
                ->where('inventoryable_type', 'App\Models\CraneInventory')
                ->where('is_featured', true)
                ->has('images', '>=', 3)
                ->get();
        });

    }
    public function getCurrentCraneImages()
    {
        $crane = $this->cranes[$this->currentIndex];
        return [
            'main' => $crane->images[0]->image_path ?? 'path/to/fallback.jpg',
            'secondary' => $crane->images[1]->image_path ?? 'path/to/fallback.jpg',
            'tertiary' => $crane->images[3]->image_path ?? 'path/to/fallback.jpg',
        ];
    }

    public function next()
    {
        $this->currentIndex = ($this->currentIndex + 1) % count($this->cranes);
    }
    public function previous()
    {
        $this->currentIndex = ($this->currentIndex - 1 + count($this->cranes)) % count($this->cranes);
    }

    public function render()
    {
        return view('livewire.templates.scrolling-inventory');
    }
}

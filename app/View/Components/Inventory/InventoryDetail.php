<?php

namespace App\View\Components\Inventory;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InventoryDetail extends Component
{
    /**
     * Create a new component instance.
     */
    public $detailName;

    public $detailData;

    public function __construct($detailName = 'test', $detailData = 'icles')
    {
        //
        $this->detailName = $detailName;
        $this->detailData = $detailData;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inventory.inventory-detail');
    }
}

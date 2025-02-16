<?php

namespace App\View\Components\Inventory;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $label, public $value)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inventory.stat-item');
    }
}

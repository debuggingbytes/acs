<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Block extends Component
{
    /**
     * Create a new component instance.
     */
    public $blockTitle;
    public function __construct($blockTitle)
    {
        $this->blockTitle = $blockTitle;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.block');
    }
}

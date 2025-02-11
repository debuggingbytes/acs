<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Link extends Component
{
    /**
     * Create a new component instance.
     */
    public $linkName;
    public $linkRoute;
    public function __construct($linkName, $linkRoute)
    {
        $this->linkName = $linkName;
        $this->linkRoute = $linkRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.link');
    }
}

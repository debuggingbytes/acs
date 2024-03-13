<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CraneCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $crane;

    public $image;

    public $route;

    public function __construct($crane, $image, $route)
    {
        //
        $this->route = $route;
        $this->crane = $crane;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.crane-card');
    }
}

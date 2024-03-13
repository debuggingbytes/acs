<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InventoryCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $loop;

    public $category;

    public $year;

    public $subject;

    public $capacity;

    public $condition;

    public $images;

    public $id;

    public $slug;

    public $route;

    public $thumbnail;

    public function __construct($loop, $category, $year, $subject, $capacity, $condition, $images, $id, $slug, $route, $thumbnail)
    {
        //
        $this->loop = $loop;
        $this->category = $category;
        $this->year = $year;
        $this->subject = $subject;
        $this->capacity = $capacity;
        $this->condition = $condition;
        $this->images = $images;
        $this->id = $id;
        $this->slug = $slug;
        $this->route = $route;
        $this->thumbnail = $thumbnail;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inventory-card');
    }
}

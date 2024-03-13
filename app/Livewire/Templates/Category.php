<?php

namespace App\Livewire\Templates;

use Livewire\Component;

class Category extends Component
{
    public $category;

    public function __construct($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        dd($this->category);
        // return view('livewire.templates.category');
    }
}

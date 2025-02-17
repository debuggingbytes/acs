<?php

namespace App\View\Components\Inventory;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageGallery extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $images, public $mainImage = null, public $altText = '')
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inventory.image-gallery');
    }
}

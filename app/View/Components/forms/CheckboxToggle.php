<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckboxToggle extends Component
{
    /**
     * Create a new component instance.
     */
    public string $label;

    public boolean $livewire;

    public function __construct($label, $livewire)
    {
        //
        $this->label = $label;
        $this->livewire = $livewire;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.checkbox-toggle');
    }
}

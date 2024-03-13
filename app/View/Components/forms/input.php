<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;

    public $type;

    public $name;

    public $placeholder;

    public $required;

    public $value;

    public function __construct($id, $type, $name, $value, $placeholder, $required = false)
    {
        //
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}

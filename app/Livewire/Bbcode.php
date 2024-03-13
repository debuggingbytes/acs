<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Bbcode extends Component
{

    public string $bbcode;

    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.bbcode');
    }
}

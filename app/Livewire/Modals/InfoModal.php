<?php

namespace App\Livewire\Modals;

use Livewire\Attributes\On;
use Livewire\Component;

class InfoModal extends Component
{
    public $showModal = false;

    public $type = '';

    public $message = '';

    #[On('show-modal')]
    public function show($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
        $this->showModal = true;
    }

    public function close()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.modals.info-modal');
    }
}

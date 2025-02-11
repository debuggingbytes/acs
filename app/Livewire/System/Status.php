<?php

namespace App\Livewire\System;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\On;


class Status extends Component
{

    public bool $display = false;
    #[On('refresh-status')]
    public function refreshStatus()
    {
        if (Session::has('status')) {
            $this->display = true;
            dump("Refreshed Status");
        }
    }
    public function render()
    {
        return view('livewire.system.status');
    }
}

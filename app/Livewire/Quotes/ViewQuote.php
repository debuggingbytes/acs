<?php

namespace App\Livewire\Quotes;

use Livewire\Component;
use Livewire\Attributes\Layout;

class ViewQuote extends Component
{
    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.quotes.view-quote');
    }
}

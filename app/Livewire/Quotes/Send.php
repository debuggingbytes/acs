<?php

namespace App\Livewire\Quotes;

use App\Models\Inventory;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;
class Send extends Component
{
    #[Layout('dashboard.app')]
    public $todaysDate;
    public $inventory;

    public function getTodaysDateProperty()
    {
        return Carbon::today()->format('F j, Y'); // Example: October 26, 2023
    }

    public function mount(Inventory $inventory, $id = null)
    {
        $this->todaysDate = $this->getTodaysDateProperty();
        $this->inventory = $inventory::where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.quotes.send');
    }
}

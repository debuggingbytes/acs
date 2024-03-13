<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UniqueInventoryView;

class CountLiveViews extends Component
{
    public $user_ip;
    public $inventory_id;

    public function mount(){
        $this->user_ip = request()->ip();
        $this->inventory_id = request()->route('id');

        $this->addView();
    }
    public function addView(){
        if(!UniqueInventoryView::where('user_ip', $this->user_ip)->where('inventory_id', $this->inventory_id)->exists()){
            $view = new UniqueInventoryView();
            $view->user_ip = $this->user_ip;
            $view->inventory_id = $this->inventory_id;
            $view->save();
        }
        return false;

    }
    public function render()
    {
        return view('livewire.count-live-views');
    }
}

<?php

namespace App\Livewire\Inventory;

use Livewire\Component;
use App\Models\Inventory;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class DetailPage extends Component
{

    public Inventory $inventory;
    public $activeImageIndex = 0;
    public $showImageModal = false;
    public $viewCount;
    public $h1Text = '';
    public $title = '';
    public $meta = [];
    public $heroImage = 'YO';

    protected $listeners = ['imageViewed' => 'incrementImageViews'];

    public function mount($id)
    {
        $inventory = Inventory::findOrFail($id);
        $this->inventory = $inventory->load(['craneInventory', 'images', 'customFields']);
        // Share content to the layout
        view()->share([
            'title' => $this->setPageTitle(),
            'meta' => $this->getMetaTags(),
            'h1Text' => $this->inventory->craneInventory->condition." condition ". $this->inventory->craneInventory->subject ." for sale",
            'heroImage' => $this->inventory->images->first()->image_path,
            'inventory' => $this->inventory,

        ]);
    }

    private function setPageTitle(){
        return $this->inventory->craneInventory->year . " ". $this->inventory->craneInventory->subject . " for sale";
    }
    public function setActiveImage($index)
    {
        $this->activeImageIndex = $index;
        $this->showImageModal = true;
    }

    private function getMetaTags()
    {
        return [
            'title' => "Used {$this->inventory->craneInventory->year} {$this->inventory->craneInventory->subject} for sale",
            'description' => "For Sale {$this->inventory->craneInventory->year} {$this->inventory->craneInventory->subject} crane with {$this->inventory->craneInventory->capacity} ton capacity",
            // ... other meta tags
        ];
    }

    #[Layout('components.layouts.app', 'title', 'meta')]
    public function render()
    {
        return view('livewire.inventory.detail-page');
               
    }
}

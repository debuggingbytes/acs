<?php

namespace App\Livewire;

use App\Models\Inventory;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ShowInventory extends Component
{
    use WithPagination;

    public $inventories;
    public $makes;
    public $models;
    public $years;
    public $selectedMake;
    public $selectedModel;
    public $selectedYear;




    public function editInventory($id){
        $this->redirectRoute('edit.inventory', ['id' => $id]);
    }


    public function updated($propertyName){
        $this->filterInventories();
    }

    public function resetFilter(){
        $this->reset(['selectedMake','selectedModel','selectedYear']);
        return $this->filterInventories();
        // return $this->filterInventories()
    }

    public function filterInventories(){

        $query = Inventory::with('craneinventory', 'partinventory', 'images','equipmentinventory','customfields');

        if ($this->selectedMake) {
            $query->where(function ($query) {
                $query->whereHas('craneinventory', function ($query) {
                    $query->where('make', '=', $this->selectedMake);
                })->orWhereHas('partinventory', function ($query) {
                    $query->where('make', '=', $this->selectedMake);
                })->orWhereHas('equipmentInventory', function ($query) {
                    $query->where('make', '=', $this->selectedMake);
                });
            });
        }

        if ($this->selectedModel) {
            $query->whereHas('craneinventory', function ($query) {
                $query->where('model', $this->selectedModel);
            });
        }

        if ($this->selectedYear) {
            $query->where(function ($query) {
                $query->whereHas('craneinventory', function ($query) {
                    $query->where('year', $this->selectedYear);
                })->orWhereHas('partinventory', function ($query) {
                    $query->where('year', $this->selectedYear);
                })->orWhereHas('equipmentInventory', function ($query) {
                    $query->where('year', $this->selectedYear);
                });
            });
        }

        $this->inventories = $query->get();

    }

    public function mount()
    {
        $this->inventories = Inventory::with('craneinventory', 'partinventory', 'images')->get();


        $craneMakes = $this->inventories->pluck('craneInventory.make')->filter()->sort();
        $partMakes = $this->inventories->pluck('partInventory.make')->filter()->sort();
        $craneYears = $this->inventories->pluck('craneInventory.year')->filter()->sort()->reverse();
        $partYears = $this->inventories->pluck('partInventory.year')->filter()->sort()->reverse();
        $craneModels = $this->inventories->pluck('craneInventory.model')->filter()->unique()->sort();

        $this->makes = $craneMakes->concat($partMakes)->unique();
        $this->years = $craneYears->concat($partYears)->unique();
        $this->models = $craneModels;

        $this->filterInventories();
    }

    // Search Filter


    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.show-inventory');
    }

}

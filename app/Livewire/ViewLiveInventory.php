<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Inventory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ViewLiveInventory extends Component
{

    #[Url(as: 'q', except: '', history: true )]
    public $query = '';
    public $inventories;
    public $totalResults;
    public $makes;
    public $models;
    public $years;
    public $selectedMake;
    public $selectedModel;
    public $selectedYear;


    public function searchInventory()
{
    $validatedData = $this->validate([
        'query' => ['required', 'regex:/^[\pL\s\d]+$/u'],
    ]);
    $this->query = Str::replace('-', '&dash;', $this->query);

    if(isset($validatedData['query'])){
        $keywords = array_map(function($keyword) {
            return str_replace('%', '\\%', $keyword);
        }, explode(' ', $this->query));
        if(empty($keywords)){
            $this->inventories = Inventory::with('craneinventory', 'partinventory', 'equipmentinventory', 'images')->get();
            return;
        }
        $this->inventories = Inventory::when($this->query, function ($query) use ($keywords) {
            $query->where(function ($subQuery) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $subQuery->orWhereHas('craneinventory', function ($craneSubQuery) use ($keyword) {
                        $craneSubQuery->where('make', 'LIKE', "%{$keyword}%")
                            ->orWhere('model', 'LIKE', "%{$keyword}%")
                            ->orWhere('description', 'LIKE', "%{$keyword}%")
                            ->orWhere('year', 'LIKE', "%{$keyword}%")
                            ->orWhere('condition', 'LIKE', "%{$keyword}%")
                            ->orWhere('capacity', 'LIKE', "%{$keyword}%");
                    })
                    ->orWhereHas('partinventory', function ($partSubQuery) use ($keyword) {
                        $partSubQuery->where('make', 'LIKE', "%{$keyword}%")
                            ->orWhere('description', 'LIKE', "%{$keyword}%")
                            ->orWhere('year', 'LIKE', "%{$keyword}%")
                            ->orWhere('condition', 'LIKE', "%{$keyword}%");
                    })
                    ->orWhereHas('equipmentinventory', function ($partSubQuery) use ($keyword) {
                        $partSubQuery->where('make', 'LIKE', "%{$keyword}%")
                            ->orWhere('description', 'LIKE', "%{$keyword}%")
                            ->orWhere('year', 'LIKE', "%{$keyword}%")
                            ->orWhere('condition', 'LIKE', "%{$keyword}%");
                    });
                }
            });
        })
        ->where('is_available', true)
        ->orWhere(function ($query) {
            $query->orWhere('is_available', false)
                ->where('updated_at', '>=', now()->subDays(50));
        })
        ->with('craneinventory', 'partinventory', 'images', 'equipmentinventory')
        ->get();
    }else{
        $this->inventories = Inventory::with('craneinventory', 'partinventory', 'equipmentinventory', 'images')->get();
    }
    $this->totalResults = $this->inventories->count();
}

public function updated($propertyName){
    Log::info("Property {$propertyName} was updated with value: {$this->$propertyName}");
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
            })->orWhereHas('equipmentinventory', function ($query) {
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

    public function mount(){
        $this->inventories = Inventory::with('craneinventory', 'partinventory', 'images', 'equipmentinventory')->get();

        $craneMakes = $this->inventories->pluck('craneInventory.make')->filter()->sort();
        $equipmentMakes = $this->inventories->pluck('equipmentInventory.make')->filter()->sort();
        $partMakes = $this->inventories->pluck('partInventory.make')->filter()->sort();
        $craneYears = $this->inventories->pluck('craneInventory.year')->filter()->sort()->reverse();
        $equipmentYears = $this->inventories->pluck('equipmentInventory.year')->filter()->sort()->reverse();
        $partYears = $this->inventories->pluck('partInventory.year')->filter()->sort()->reverse();
        $craneModels = $this->inventories->pluck('craneInventory.model')->filter()->unique()->sort();

        $this->makes = $craneMakes->concat($partMakes)->concat($equipmentMakes)->unique();
        $this->years = $craneYears->concat($partYears)->concat($equipmentYears)->unique();
        $this->models = $craneModels;

        // dd($equipmentMakes);
        $this->filterInventories();


    }
    public function render()
    {
        return view('livewire.view-live-inventory');
    }
}

<?php

namespace App\Livewire;

use App\Models\Inventory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowInventory extends Component
{
    public $selectedMake;
    public $selectedModel;
    public $selectedYear;
    public $withInactive = false;
    public $inventories = [];
    public $makes = [];
    public $models = [];
    public $years = [];
    public $loading = true;
    

    protected $queryString = [
        'selectedMake' => ['except' => ''],
        'selectedModel' => ['except' => ''],
        'selectedYear' => ['except' => ''],
        'withInactive' => ['except' => false],
        'page' => ['except' => 1]
    ];

    public function updated($property)
    {
        // Reset dependent filters when parent filter changes
        if ($property === 'selectedMake') {
            $this->selectedModel = null;
            $this->selectedYear = null;
        } elseif ($property === 'selectedModel') {
            $this->selectedYear = null;
        }

        $this->filterInventories();
    }

    public function toggleAvailable()
    {
        $this->withInactive = ! $this->withInactive;
        $this->dispatch('refresh-inventory');
    }

    protected function getCacheKey(string $type): string
    {
        $key = $type;
        if ($type === 'models' && $this->selectedMake) {
            $key .= "_{$this->selectedMake}";
        }
        if ($type === 'years' && $this->selectedMake) {
            $key .= "_{$this->selectedMake}";
            if ($this->selectedModel) {
                $key .= "_{$this->selectedModel}";
            }
        }
        return $key;
    }

    public function getMakesProperty(): Collection
    {
        return Cache::remember('makes', 600, function () {
            $craneMakes = DB::table('crane_inventories')
                ->whereNotNull('make')
                ->select('make');

            $partMakes = DB::table('part_inventories')
                ->whereNotNull('make')
                ->select('make');

            $equipmentMakes = DB::table('equipment_inventories')
                ->whereNotNull('make')
                ->select('make');

            return $craneMakes->union($partMakes)
                ->union($equipmentMakes)
                ->distinct()
                ->pluck('make')
                ->filter()
                ->values();
        });
    }

    public function getModelsProperty(): Collection
    {
        $cacheKey = $this->getCacheKey('models');

        return Cache::remember($cacheKey, 600, function () {
            return DB::table('crane_inventories')
                ->when($this->selectedMake, fn ($q) => $q->where('make', $this->selectedMake))
                ->whereNotNull('model')
                ->select('model')
                ->distinct()
                ->pluck('model')
                ->filter()
                ->values();
        });
    }

    public function getYearsProperty(): Collection
    {
        $cacheKey = $this->getCacheKey('years');

        return Cache::remember($cacheKey, 600, function () {
            // If a model is selected, we only need to look at crane_inventories
            if ($this->selectedModel) {
                return DB::table('crane_inventories')
                    ->where('make', $this->selectedMake)
                    ->where('model', $this->selectedModel)
                    ->whereNotNull('year')
                    ->distinct()
                    ->pluck('year')
                    ->sort()
                    ->reverse()
                    ->values();
            }

            // If only make is selected or no filters, we need to check all inventory types
            $queries = [];

            // Get years from crane_inventories
            $queries[] = DB::table('crane_inventories')
                ->when($this->selectedMake, fn ($q) => $q->where('make', $this->selectedMake))
                ->whereNotNull('year')
                ->select('year');

            // Get years from part_inventories
            $queries[] = DB::table('part_inventories')
                ->when($this->selectedMake, fn ($q) => $q->where('make', $this->selectedMake))
                ->whereNotNull('year')
                ->select('year');

            // Get years from equipment_inventories
            $queries[] = DB::table('equipment_inventories')
                ->when($this->selectedMake, fn ($q) => $q->where('make', $this->selectedMake))
                ->whereNotNull('year')
                ->select('year');

            // Combine all queries with UNION
            $query = $queries[0];
            for ($i = 1; $i < count($queries); $i++) {
                $query->union($queries[$i]);
            }

            return $query->distinct()
                ->pluck('year')
                ->sort()
                ->reverse()
                ->values();
        });
    }

    #[On('refresh-inventory')]
    public function filterInventories()
    {
        $query = Inventory::query()
            ->with([
                'craneInventory',
                'partInventory',
                'equipmentInventory',
                'images',
                'customFields'
            ]);

        if ($this->selectedMake) {
            $query->where(function ($q) {
                $q->whereHas('craneInventory', fn ($q) => $q->where('make', $this->selectedMake))
                    ->orWhereHas('partInventory', fn ($q) => $q->where('make', $this->selectedMake))
                    ->orWhereHas('equipmentInventory', fn ($q) => $q->where('make', $this->selectedMake));
            });
        }

        if ($this->selectedModel) {
            $query->whereHas('craneInventory', fn ($q) => $q->where('model', $this->selectedModel));
        }

        if ($this->selectedYear) {
            $query->where(function ($q) {
                if ($this->selectedModel) {
                    $q->whereHas('craneInventory', fn ($q) => $q->where('year', $this->selectedYear));
                } else {
                    $q->whereHas('craneInventory', fn ($q) => $q->where('year', $this->selectedYear))
                        ->orWhereHas('partInventory', fn ($q) => $q->where('year', $this->selectedYear))
                        ->orWhereHas('equipmentInventory', fn ($q) => $q->where('year', $this->selectedYear));
                }
            });
        }

        if (! $this->withInactive) {
            $query->where('is_available', true);
        }

        $this->inventories = $query->get();
        $this->loadFilterOptions();
    }

    public function resetFilter()
    {
        $this->reset(['selectedMake', 'selectedModel', 'selectedYear']);
        $this->filterInventories();
    }

    public function loadFilterOptions()
    {
        $this->makes = $this->getMakesProperty();
        $this->models = $this->getModelsProperty();
        $this->years = $this->getYearsProperty();
    }

    public function mount()
    {
        $this->loadFilterOptions();
        $this->filterInventories();
        $this->loading = false;
    }
    public function editInventory($id)
    {
        $this->redirectRoute('edit.inventory', ['id' => $id]);
    }

    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.show-inventory');
    }
}

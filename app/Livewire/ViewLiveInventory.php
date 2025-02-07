<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;  // Import DB
use Illuminate\Support\Facades\Cache; // Import Cache
use Illuminate\Support\Str;

class ViewLiveInventory extends Component
{
    #[Url(as: 'q', except: '', history: true)]
    public $query = '';
    public $inventories;
    public $totalResults;
    public $makes = [];
    public $models = [];
    public $years = [];
    public $selectedMake;
    public $selectedModel;
    public $selectedYear;

    public function searchInventory()
    {
        $validatedData = $this->validate([
            'query' => ['required', 'regex:/^[\p{L}\s\d]+$/u'], // Correct regex
        ]);
        $this->query = Str::replace('-', '&dash;', $this->query);

        $this->inventories = $this->performSearch();
        $this->totalResults = $this->inventories->count();
    }

    private function performSearch()
    {
        $cacheKey = 'inventory_search:'.md5(serialize([$this->query, $this->selectedMake, $this->selectedModel, $this->selectedYear]));
        $cacheTime = now()->addHours(20); // 20-hour cache

        return Cache::remember($cacheKey, $cacheTime, function () {
            $keywords = array_map(function ($keyword) {
                return str_replace('%', '\\%', $keyword);
            }, explode(' ', $this->query));

            $query = Inventory::select(
                'inventories.*',
                'crane_inventories.readabletype as crane_readabletype',
                'crane_inventories.year as crane_year',
                'crane_inventories.subject as crane_subject',
                'crane_inventories.capacity as crane_capacity',
                'crane_inventories.condition as crane_condition',
                'crane_inventories.slug_name as crane_slug_name',
                'crane_inventories.description as crane_description',
                'part_inventories.readabletype as part_readabletype',
                'part_inventories.year as part_year',
                'part_inventories.subject as part_subject',
                'part_inventories.capacity as part_capacity',
                'part_inventories.condition as part_condition',
                'part_inventories.slug_name as part_slug_name',
                'part_inventories.description as part_description',
                'equipment_inventories.readabletype as equipment_readabletype',
                'equipment_inventories.year as equipment_year',
                'equipment_inventories.subject as equipment_subject',
                'equipment_inventories.capacity as equipment_capacity',
                'equipment_inventories.condition as equipment_condition',
                'equipment_inventories.slug_name as equipment_slug_name',
                'equipment_inventories.description as equipment_description'
            )
                ->leftJoin('crane_inventories', 'inventories.id', '=', 'crane_inventories.inventory_id')
                ->leftJoin('part_inventories', 'inventories.id', '=', 'part_inventories.inventory_id')
                ->leftJoin('equipment_inventories', 'inventories.id', '=', 'equipment_inventories.inventory_id')
                ->where(function ($query) {
                    $query->where('inventories.is_available', true)
                        ->where('inventories.is_public', true)
                        ->orWhere('inventories.updated_at', '>=', now()->subDays(30));
                });

            if (! empty($keywords)) {
                $query->where(function ($subQuery) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $subQuery->orWhere('crane_inventories.make', 'LIKE', "%{$keyword}%")
                            ->orWhere('crane_inventories.model', 'LIKE', "%{$keyword}%")
                            ->orWhere('crane_inventories.description', 'LIKE', "%{$keyword}%")
                            ->orWhere('crane_inventories.year', 'LIKE', "%{$keyword}%")
                            ->orWhere('crane_inventories.condition', 'LIKE', "%{$keyword}%")
                            ->orWhere('crane_inventories.capacity', 'LIKE', "%{$keyword}%")
                            ->orWhere('part_inventories.make', 'LIKE', "%{$keyword}%")
                            ->orWhere('part_inventories.description', 'LIKE', "%{$keyword}%")
                            ->orWhere('part_inventories.year', 'LIKE', "%{$keyword}%")
                            ->orWhere('part_inventories.condition', 'LIKE', "%{$keyword}%")
                            ->orWhere('equipment_inventories.make', 'LIKE', "%{$keyword}%")
                            ->orWhere('equipment_inventories.description', 'LIKE', "%{$keyword}%")
                            ->orWhere('equipment_inventories.year', 'LIKE', "%{$keyword}%")
                            ->orWhere('equipment_inventories.condition', 'LIKE', "%{$keyword}%");
                    }
                });
            }

            if ($this->selectedMake) {
                $query->where(function ($q) {
                    $q->where('crane_inventories.make', $this->selectedMake)
                        ->orWhere('part_inventories.make', $this->selectedMake)
                        ->orWhere('equipment_inventories.make', $this->selectedMake);
                });
            }

            if ($this->selectedModel) {
                $query->where('crane_inventories.model', $this->selectedModel);
            }

            if ($this->selectedYear) {
                $query->where(function ($q) {
                    $q->where('crane_inventories.year', $this->selectedYear)
                        ->orWhere('part_inventories.year', $this->selectedYear)
                        ->orWhere('equipment_inventories.year', $this->selectedYear);
                });
            }

            return $query->with('images')
                ->orderBy('inventories.is_featured', 'desc')
                ->orderBy('crane_inventories.readabletype', 'asc') // Or your preferred secondary sort
                ->get();
        });
    }


    public function updated($propertyName)
    {
        $this->filterInventories();
    }

    public function resetFilter()
    {
        $this->reset(['selectedMake', 'selectedModel', 'selectedYear']);
        $this->filterInventories();
    }

    public function filterInventories()
    {
        $cacheKey = 'inventory_filter:'.md5(serialize([$this->selectedMake, $this->selectedModel, $this->selectedYear]));
        $cacheTime = now()->addHours(20);

        $this->inventories = Cache::remember($cacheKey, $cacheTime, function () {
            $query = Inventory::select(
                'inventories.*',
                'crane_inventories.readabletype as crane_readabletype',
                'crane_inventories.year as crane_year',
                'crane_inventories.subject as crane_subject',
                'crane_inventories.capacity as crane_capacity',
                'crane_inventories.condition as crane_condition',
                'crane_inventories.slug_name as crane_slug_name',
                'crane_inventories.description as crane_description',
                'part_inventories.readabletype as part_readabletype',
                'part_inventories.year as part_year',
                'part_inventories.subject as part_subject',
                'part_inventories.capacity as part_capacity',
                'part_inventories.condition as part_condition',
                'part_inventories.slug_name as part_slug_name',
                'part_inventories.description as part_description',
                'equipment_inventories.readabletype as equipment_readabletype',
                'equipment_inventories.year as equipment_year',
                'equipment_inventories.subject as equipment_subject',
                'equipment_inventories.capacity as equipment_capacity',
                'equipment_inventories.condition as equipment_condition',
                'equipment_inventories.slug_name as equipment_slug_name',
                'equipment_inventories.description as equipment_description'
            )
                ->leftJoin('crane_inventories', 'inventories.id', '=', 'crane_inventories.inventory_id')
                ->leftJoin('part_inventories', 'inventories.id', '=', 'part_inventories.inventory_id')
                ->leftJoin('equipment_inventories', 'inventories.id', '=', 'equipment_inventories.inventory_id')
                ->where(function ($query) {
                    $query->where('inventories.is_available', true)
                        ->where('inventories.is_public', true)
                        ->orWhere('inventories.updated_at', '>=', now()->subDays(30));
                });

            if ($this->selectedMake) {
                $query->where(function ($q) {
                    $q->where('crane_inventories.make', $this->selectedMake)
                        ->orWhere('part_inventories.make', $this->selectedMake)
                        ->orWhere('equipment_inventories.make', $this->selectedMake);
                });
            }

            if ($this->selectedModel) {
                $query->where('crane_inventories.model', $this->selectedModel);
            }

            if ($this->selectedYear) {
                $query->where(function ($q) {
                    $q->where('crane_inventories.year', $this->selectedYear)
                        ->orWhere('part_inventories.year', $this->selectedYear)
                        ->orWhere('equipment_inventories.year', $this->selectedYear);
                });
            }

            return $query->with('images')
                ->orderBy('inventories.is_featured', 'desc')
                ->orderBy('crane_inventories.readabletype', 'asc') // Or your preferred secondary sort
                ->get();
        });

        $this->totalResults = $this->inventories->count();
    }

    public function mount()
    {
        $this->loadFilterOptions(); // New method to load filter options
        $this->inventories = $this->performSearch();
        $this->totalResults = $this->inventories->count();

    }

    private function loadFilterOptions()
    {
        $cacheKey = 'filter_options';
        $cacheTime = now()->addDay(); // Cache for 1 day

        $filterOptions = Cache::remember($cacheKey, $cacheTime, function () {
            $makes = DB::table('crane_inventories')->select('make')->distinct()->pluck('make')
                ->concat(DB::table('part_inventories')->select('make')->distinct()->pluck('make'))
                ->concat(DB::table('equipment_inventories')->select('make')->distinct()->pluck('make'))
                ->unique()->sort();

            $models = DB::table('crane_inventories')->select('model')->distinct()->pluck('model')->unique()->sort();

            $years = DB::table('crane_inventories')->select('year')->distinct()->pluck('year')
                ->concat(DB::table('part_inventories')->select('year')->distinct()->pluck('year'))
                ->concat(DB::table('equipment_inventories')->select('year')->distinct()->pluck('year'))
                ->unique()->sort()->reverse();

            return compact('makes', 'models', 'years');
        });

        $this->makes = $filterOptions['makes'];
        $this->models = $filterOptions['models'];
        $this->years = $filterOptions['years'];
    }





    public function render()
    {
        return view('livewire.view-live-inventory');
    }
}

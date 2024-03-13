<?php

namespace App\Livewire\Dashboard;

use App\Models\Inventory;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\On;

// Google Analytics
use Spatie\Analytics\Period;
use Spatie\Analytics\Facades\Analytics;
// File Storage Information
use Illuminate\Support\Facades\File;
use Illuminate\Support\Number;
use Illuminate\Support\Facades\Storage;


class AdminIndex extends Component
{
    public $inventories;
    // Google properties;
    public $googlePageVisits;
    public $googleTotalVisitorsAndPages;
    public $googleTopCountries;
    public $tempStorageSize;
    public $searchImpressions;


    // File Methods
    public function getTempStorage(){
        $this->tempStorageSize = 0;
        foreach (File::allFiles(base_path('storage/app/livewire-tmp')) as $file) {
            $this->tempStorageSize += $file->getSize();
        }
    }
    public function purgeTempStorage(){
        foreach (Storage::disk('local')->allFiles('livewire-tmp') as $file){
            Storage::disk('local')->delete($file);
        }
        $this->dispatch('updateTmpStorage');
    }
    #[On('updateTmpStorage')]
    public function updatedTempStorageSize(){
        $this->getTempStorage();
        return Number::fileSize($this->tempStorageSize);
    }

    public function mount()
    {
        $this->inventories = Inventory::with('craneinventory', 'partinventory')->get();
        $this->googlePageVisits = Analytics::fetchMostVisitedPages(Period::days(7),$maxResults=5);
        //organicGoogleSearchImpressions
        $this->searchImpressions = Analytics::get(Period::days(7), ['organicGoogleSearchImpressions'],['Country'], $maxResults=5);
        $this->googleTopCountries = Analytics::fetchTopCountries(Period::days(7),$maxResults=5);
        $this->googleTotalVisitorsAndPages = Analytics::fetchVisitorsAndPageViews(Period::days(7),$maxResults=5);
        $this->getTempStorage();
        $this->tempStorageSize = Number::fileSize($this->tempStorageSize);


    }

    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.dashboard.admin-index');
    }
}

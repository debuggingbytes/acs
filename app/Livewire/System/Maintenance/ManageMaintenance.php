<?php

namespace App\Livewire\System\Maintenance;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Maintenance\Maintenance;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Attributes\Session as AttributesSession;

class ManageMaintenance extends Component
{
    #[Layout('dashboard.app')]

    public $maintenances = [];
    public $editingMaintenance = null;
    public $title;
    public $description;
    public $start_date; // Changed to start_date
    public $end_date;   // Changed to end_date
    public $is_active;
    public $is_completed;
    #[AttributesSession]
    public bool $maintenanceMode = false;
    public bool $debugMode = false;

    public function getMaintenances()
    {
        $this->maintenances = Maintenance::all();
    }

    public function mount()
    {
        $this->getMaintenances();
        if (! app()->isDownForMaintenance()) {
            $this->maintenanceMode = false;
        }
    }

    public function editMaintenance($id)
    {
        $this->editingMaintenance = Maintenance::find($id);
        if (! $this->is_active) {
            Session::forget('maintenance_mode');
        }

        $this->title = $this->editingMaintenance->title;
        $this->description = $this->editingMaintenance->description;
        $this->start_date = $this->editingMaintenance->start_date; // Format for datetime-local
        $this->end_date = $this->editingMaintenance->end_date; // Format for datetime-local
        $this->is_active = $this->editingMaintenance->is_active;
        $this->is_completed = $this->editingMaintenance->is_completed;

    }

    public function saveMaintenance()
    {
        if ($this->editingMaintenance) {
            $this->editingMaintenance->update([
                'title' => $this->title,
                'description' => $this->description,
                'is_active' => $this->is_active,
                'is_completed' => $this->is_completed,
            ]);

            $this->editingMaintenance = null;
            $this->getMaintenances();

            if (! $this->is_completed && $this->is_active) {
                $this->dispatch('startMaintenance');
                Session::put('maintenance_mode', true);

            }
            if ($this->is_completed && ! $this->is_active) {
                Session::forget('maintenance_mode');
                $this->dispatch('endMaintenance');

            }
        } else {
            Maintenance::create([
                'title' => $this->title,
                'description' => $this->description,
                'start_date' => $this->start_date, // Changed to start_date
                'end_date' => $this->end_date, // Changed to end_date
                'is_active' => $this->is_active,
                'is_completed' => $this->is_completed,
            ]);

            $this->getMaintenances();
            // $this->dispatch('startMaintenance');
            $this->reset('title', 'description', 'start_date', 'end_date', 'is_active', 'is_completed');

            Session::put('maintenance_mode', true);
        }
    }

    public function cancelEdit()
    {
        $this->editingMaintenance = null;
        $this->reset(['title', 'description', 'start_date', 'end_date', 'is_active', 'is_completed']); // Changed to start_date and end_date
    }

    public function deleteMaintenance($id)
    {
        Maintenance::find($id)->delete();
        $this->getMaintenances();
    }

    // Artisan Commands

    public function artisanDown()
    {
        $secret = Str::random(32);

        Session::put('maintenance_secret', $secret);

        $bypassUrl = URL::signedRoute('home', [$secret]);
        Session::put('maintenance_bypass_url', $bypassUrl);


        Artisan::call('down', [
            '--secret' => $secret,
        ]);
        $this->maintenanceMode = true;

        return $this->redirect($bypassUrl);

    }
    public function artisanUp()
    {
        Artisan::call('up');
        $this->maintenanceMode = false;
        Session::forget(['maintenance_secret', 'maintenance_bypass_url']);
    }

    public function artisanClearCache()
    {
        $result = Artisan::call('optimize:clear');
        if ($result === 0) {
            session()->flash('status', ['message' => 'Cache Cleared.', 'type' => 'success', 'title' => 'Success']);
        } else {
            session()->flash('status', ['message' => 'Cache Clear Failed.', 'type' => 'negative', 'title' => 'Error']);
        }
    }

    public function artisanOptimize()
    {
        $result = Artisan::call('optimize');

        if ($result === 0) {
            session()->flash('status', ['message' => 'Application Optimized.', 'type' => 'success', 'title' => 'Success']);
        } else {
            session()->flash('status', ['message' => 'Application Optimization Failed.', 'type' => 'negative', 'title' => 'Error']);
        }
    }

    public function debugMode()
    {
        $this->debugMode = ! $this->debugMode;
        if ($this->debugMode) {
            config(['app.debug' => true]);
        } else {
            config(['app.debug' => false]);
        }

    }

    public function render()
    {
        return view('livewire.system.maintenance.manage-maintenance', [
            'bypassUrl' => Session::get('maintenance_bypass_url')
        ]);
    }
}

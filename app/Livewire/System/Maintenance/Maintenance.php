<?php

namespace App\Livewire\System\Maintenance;

use App\Models\Maintenance\Maintenance as MaintenanceModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class Maintenance extends Component
{
    public bool $maintenance = false;
    public $maintenanceData;
    public MaintenanceModel $maintenanceModel;

    public function mount()
    {
        $this->maintenanceData = MaintenanceModel::where('is_active', true)
            ->where('start_date', '>=', Carbon::now())
            ->first();

        if ($this->maintenanceData) {
            // For new visitors (no session), set maintenance to true
            if (! Session::has('maintenance_mode')) {
                $this->maintenance = true;
                Session::put('maintenance_mode', true);
            } else {
                // For returning visitors, use their session value
                $this->maintenance = Session::get('maintenance_mode');
            }
        }
    }

    #[On('startMaintenance')]
    public function startMaintenance()
    {
        $this->maintenance = true;
        Session::put('maintenance_mode', true);
    }

    #[On('endMaintenance')]
    public function endMaintenance()
    {
        $this->maintenance = false;
        Session::forget('maintenance_mode');
    }

    public function closeMaintenanceBanner()
    {
        $this->maintenance = false;
        Session::put('maintenance_mode', false);
    }

    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.system.maintenance.maintenance', [
            'maintenanceData' => $this->maintenanceData,
            'maintenance' => $this->maintenance
        ]);
    }
}

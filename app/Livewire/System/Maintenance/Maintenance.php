<?php

namespace App\Livewire\System\Maintenance;

use App\Models\Maintenance\Maintenance as MaintenanceModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Session; // Import Session
use Carbon\Carbon;


class Maintenance extends Component
{

    public bool $maintenance = false;
    public $maintenanceData;
    public MaintenanceModel $maintenanceModel;

    public function mount()
    {

        $now = Carbon::now();
        $twentyFourHoursAgo = $now->copy()->subHours(24);

        $this->maintenanceData = MaintenanceModel::where('start_date', '>=', $twentyFourHoursAgo)
            ->where('is_active', true)
            ->where('is_completed', false)
            ->first();

        if ($this->maintenanceData) {
            $this->maintenance = true;
            Session::put('maintenance_mode', $this->maintenance); // Store in session
        }
        $this->maintenance = Session::get('maintenance_mode');


    }

    #[On('startMaintenance')]
    public function startMaintenance()
    {
        $this->maintenance = true;
        Session::put('maintenance_mode', $this->maintenance); // Store in session
    }

    #[On('endMaintenance')]
    public function endMaintenance()
    {
        $this->maintenance = false;
        Session::forget('maintenance_mode'); // Store in session
    }

    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.system.maintenance.maintenance', [
            'maintenance' => $this->maintenanceData
        ]);
    }
}

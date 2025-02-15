<?php

namespace App\Livewire\System;

use App\Models\System\SiteConfiguration;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SiteSettings extends Component
{
    public $configs = []; // Store the actual model instances
    public $inputs = []; // Store the input values

    public function mount()
    {
        $this->getSiteConfigs();
    }

    private function getSiteConfigs()
    {
        $this->configs = SiteConfiguration::all(); // Store the entire collection

        foreach ($this->configs as $config) {
            $this->inputs[$config->key] = $config->value; // Initialize inputs
        }
    }

    public function updateConfig($key)
    {
        $config = SiteConfiguration::where('key', $key)->first();
        if ($config) {
            $config->value = $this->inputs[$key];
            $config->save();

            session()->flash('message', 'Configuration updated successfully.');
            $this->emit('configUpdated');
        }
    }

    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.system.site-settings'); // No need to pass configs as it's a public property
    }
}

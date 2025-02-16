<div>
  @if($maintenance === true && $maintenanceData)
    <div x-data="{ showModal: true }" class="sticky top-0 z-50 bg-yellow-700 p-2 h-12 flex items-center justify-center"
    x-show="showModal">
    <div class="w-full text-center flex flex-col items-center"> {{-- Flex column for vertical centering --}}
      <div class="flex-grow"></div> {{-- Push content to center vertically --}}
      <div class="flex-shrink">
      <p class="text-white text-sm md:text-base"> {{-- Smaller text, responsive sizing --}}
        Maintenance from {{ Carbon\Carbon::parse($maintenanceData->start_date)->format('M d, Y H:i') }}
        (Estimated return: <span id="maintenanceTime">
        {{ Carbon\Carbon::parse($maintenanceData->end_date)->diffForHumans() }}
        </span>)
      </p>
      <button wire:click="closeMaintenanceBanner" @click="showModal = false" class="hidden"> {{-- Keep button, but
        hide it --}}
        Close
      </button>
      </div>
      <div class="flex-grow"></div> {{-- Push content to center vertically --}}
    </div>
    </div>
  @endif
</div>
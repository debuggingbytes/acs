<div>
    @if($maintenance === true && $maintenanceData)
        <div x-data="{ showModal: true }"
            class="absolute top-0 left-0 right-0 flex items-center justify-center bg-yellow-700 z-50 p-2"
            x-show="showModal">
            <div class="w-full text-center">
                <h2 class="text-2xl font-bold mb-4">Site Maintenance</h2>
                <p class="text-white mb-3">
                    Our website will be down for maintenance around
                    {{ Carbon\Carbon::parse($maintenanceData->start_date)->diffForHumans() }} to provide you with a better
                    experience. We apologize for any inconvenience this may cause.
                </p>
                <p class="text-white">Estimated return time: <span
                        id="maintenanceTime">{{ Carbon\Carbon::parse($maintenanceData->end_date)->diffForHumans() }}</span>
                </p>
                <button wire:click="closeMaintenanceBanner" @click="showModal = false"
                    class="my-4 bg-white hover:bg-gray-100 text-gray-800 font-bold py-2 px-4 rounded">
                    Close
                </button>
            </div>
        </div>
    @endif
</div>
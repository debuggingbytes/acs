<div>
    @if($maintenance === true)
        <div x-data="{ showModal: true }" {{-- Alpine data --}}
            class="absolute top-0 left-0 right-0 flex items-center justify-center bg-yellow-700 z-50" x-show="showModal"
            {{-- Show/hide with Alpine --}}>
            <div class="w-full text-center">
                <h2 class="text-2xl font-bold mb-4">Site Maintenance {{ $maintenanceData->title ?? NULL }}</h2>
                <p class="text-white mb-3">
                    Our website will be down for maintenance around
                    {{ Carbon\Carbon::parse($maintenanceData->start_date)->diffForHumans() }} to provide you with a better
                    experience. We apologize
                    for any inconvenience this may cause.
                </p>
                <p class="text-white">Estimated return time: <span
                        id="maintenanceTime">{{ Carbon\Carbon::parse($maintenanceData->end_date)->diffForHumans() }}</span>
                </p>
                {{-- Close button using Alpine --}}
                <button @click="showModal = false"
                    class="mt-4 bg-white hover:bg-gray-100 text-gray-800 font-bold py-2 px-4 rounded">
                    Close
                </button>
            </div>
        </div>
    @endif
</div>
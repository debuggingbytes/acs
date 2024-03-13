<div>
    <div class="bg-slate-100 shadow-md rounded-md p-4 w-full">
        <h2 class="text-xl font-bold mb-4">Dashboard Overview</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-gradient-to-tr from-emerald-50 to-emerald-500 ring-1 ring-emerald-500 shadow-md rounded-md p-4">
                <h3 class="text-xl font-semibold mb-3">Inventory Information</h3>
                <div class="bg-white rounded-lg p-2">
                    <p>Total Inventories: {{ $inventories->count() }}</p>
                    <p class="py-2 px-3">
                        More Features to be added to dashboard at a later date
                    </p>
                </div>

            </div>

            <div class="bg-gradient-to-tr from-amber-50 to-yellow-500 shadow-md rounded-md p-4 lg:row-span-2 ring-1 ring-yellow-500">
                <h3 class="text-xl font-semibold mb-3">Site Traffic</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                    <div class="bg-white shadow-md rounded-md">
                        <span class="block uppercase bg-cyan-600 text-white text-lg rounded-t-md font-bold px-2 py-1 text-center">Countries last 7 days</span>
                        @foreach ($googleTopCountries as $country)
                            <span class="block px-2 border-b"><span class="w-32 text-center inline-block">{{$country['country']}}</span> with {{$country['screenPageViews']}} page views</span>
                        @endforeach
                    </div>
                    <div class="shadow-md bg-white rounded-md">
                        <span class="block uppercase bg-cyan-600 text-white text-lg rounded-t-md font-bold px-2 py-1 text-center">Search Impressions</span>
                        @foreach ($searchImpressions as $result)
                            <span class="block px-2 border-b"><span class="w-32 text-center inline-block">{{$result['Country']}}</span> with {{$result['organicGoogleSearchImpressions']}} impressions</span>
                        @endforeach
                    </div>
                    <div class="shadow-md bg-white rounded-md lg:col-span-2">
                        <span class="block uppercase bg-cyan-600 text-white text-lg rounded-t-md font-bold px-2 py-1 text-center">Pages last 7 days</span>
                        @foreach ($googlePageVisits as $page)
                            <div class="px-2 border-b flex">
                                <span class="w-2/3 truncate font-bold">{{Str::replace('www.albertacraneservice.com', 'acs.com', $page['fullPageUrl'])}}</span>
                                <span class="w-1/3 inline-block text-end">with {{$page['screenPageViews']}} page views</span></div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="bg-gradient-to-tr from-sky-50 to-cyan-500 shadow-md rounded-md p-4 ring-1 ring-cyan-600">
                <h3 class="text-xl font-semibold mb-3">Web Server Information</h3>
                    <div class="bg-white p-1 rounded-lg border-b flex justify-center items-center">
                        <div class="w-1/3 text-center">Temporary Upload Size</div>
                        <div class="w-1/3 text-center font-bold">{{$tempStorageSize}}</div>
                        <div class="w-1/3 text-end"><button wire:click.prevent='purgeTempStorage' wire:confirm='Are you sure you want to purge all temporary uploads?' class="bg-red-500 px-3 py-1.5 text-white text-semibold rounded-md">Purge</button></div>
                        <div role="status" wire:target='purgeTempStorage' wire:loading>
                            <svg aria-hidden="true" class="px-1 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>

                    </div>
            </div>

        </div>
        <div class="mt-6 bg-white shadow-md rounded-md p-4">
            <h3 class="text-lg font-semibold mb-3">Recent Orders</h3>
            <div class="overflow-x-auto">
                {{-- <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Loop through recent orders and display in rows -->
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">ORDER_ID_123</td>
                            <td class="px-6 py-4 whitespace-nowrap">Customer Name</td>
                            <td class="px-6 py-4 whitespace-nowrap">$XXX.XX</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Shipped
                                </span>
                            </td>
                        </tr>
                        <!-- Repeat rows for additional recent orders -->
                    </tbody>
                </table> --}}
                <p class="py-2 px-3">
                    More Features to be added to dashboard at a later date
                </p>
            </div>
        </div>
    </div>
    {{-- <livewire:admin.pull-cn/> --}}
</div>

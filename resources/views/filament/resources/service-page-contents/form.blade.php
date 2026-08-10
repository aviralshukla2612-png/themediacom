<div class="p-6 bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="mb-6 border-b border-gray-200 pb-4">
        <h2 class="text-lg font-medium text-gray-900 flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            BTL Metrics
        </h2>
        <p class="text-sm text-gray-500 mt-1">Statistics shown prominently on the Services page.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label for="btl_metric_reached" class="block text-sm font-medium text-gray-700 mb-1">People Reached</label>
            <input type="text" id="btl_metric_reached" wire:model="data.btl_metric_reached" placeholder="e.g. 5M+" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
            <p class="mt-1 text-xs text-gray-500">Total consumers activated / reached</p>
        </div>

        <div>
            <label for="btl_metric_malls" class="block text-sm font-medium text-gray-700 mb-1">Malls Reached</label>
            <input type="text" id="btl_metric_malls" wire:model="data.btl_metric_malls" placeholder="e.g. 200+" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
            <p class="mt-1 text-xs text-gray-500">Number of malls activated in</p>
        </div>

        <div>
            <label for="btl_metric_locations" class="block text-sm font-medium text-gray-700 mb-1">Locations</label>
            <input type="text" id="btl_metric_locations" wire:model="data.btl_metric_locations" placeholder="e.g. 50+" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
            <p class="mt-1 text-xs text-gray-500">Cities / locations covered</p>
        </div>
    </div>
</div>

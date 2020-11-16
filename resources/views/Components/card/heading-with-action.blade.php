<div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
    <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-no-wrap">
        <div class="ml-4 mt-2">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $slot }}
            </h3>
        </div>
        <div class="ml-4 mt-2 flex-shrink-0">
            <span class="inline-flex rounded-md shadow-sm">
              {{ $action }}
            </span>
        </div>
    </div>
</div>


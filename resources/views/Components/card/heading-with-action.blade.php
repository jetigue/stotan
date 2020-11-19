<div class="bg-white sm:px-6">
    <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-no-wrap">
        <div class="ml-4 mt-2">
            <h3 class="text-lg leading-6 font-medium text-cool-gray-800">
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


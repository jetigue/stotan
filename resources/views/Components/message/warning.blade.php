<div class="rounded-md bg-yellow-200 px-4 items-center pt-3 pb-2 mb-4">
    <div class="flex">
        <div class="flex-shrink-0">
            <x-icon.exclamation></x-icon.exclamation>
        </div>
        <div class="ml-3 flex-1 md:flex md:justify-between">
            <p class="text-sm text-blue-700">
                {{ $slot }}
            </p>
        </div>
    </div>
</div>

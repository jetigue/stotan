@props([
    'leadingAddOn' => false
])

<div class="mt-1 flex rounded-md shadow-sm">
    @if ($leadingAddOn)
        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            {{ $leadingAddOn }}
        </span>
    @endif


    <input {{ $attributes }}
           class="{{ $leadingAddOn ? 'rounded-none rounded-r-md' : '' }} form-input flex-1 block w-full px-3 py-2 sm:text-sm sm:leading-5">
</div>
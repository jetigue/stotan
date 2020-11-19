@props([
    'label',
    'for',
    'error' => false,
    'helpText' => false
])

<div>
    <label for="{{ $for }}" class="block text-sm font-medium leading-5 text-gray-700">
        {{ $label }}
    </label>
    <div class="mt-1 relative rounded-md shadow-sm">
        {{ $slot }}
    </div>
    @if ($error)
        <p class="mt-2 text-sm text-red-600">{{ $error }}</p>
    @endif

    @if ($helpText)
        <p class="mt-2 text-sm text-gray-500"> {{ $helpText }}</p>
    @endif

</div>

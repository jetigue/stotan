@props([
    'href',
    'leadingArrow' => true

])

<li>
    <div class="flex items-center">
        @if($leadingArrow)
            <x-icon.chevron-right class="text-blue-400"/>
        @endif

        <a href="{{ $href }}"
           class="{{ $leadingArrow ? 'ml-4 ' : '' }} text-sm font-medium text-blue-400 hover:text-blue-800">
            {{ $slot }}
        </a>
    </div>
</li>

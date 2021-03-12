<x-dropdown.dropdown>
    <x-slot name="trigger">
        <x-icon.dots-vertical class="text-gray-400"/>
    </x-slot>

    <x-slot name="content">
        <div class="text-gray-400">
            <x-dropdown.link wire:click="showWarmUpForm({{ $loop->index }})">
                <x-icon.plus class="inline"/>
                Warm-up
            </x-dropdown.link>
            <x-dropdown.link wire:click="showSteadyRunForm({{ $loop->index }})">
                <x-icon.plus class="inline"/>
                Steady Run
            </x-dropdown.link>
            <x-dropdown.link wire:click="showIntermittentRunForm({{ $loop->index }})">
                <x-icon.plus class="inline"/>
                Intermittent Run
            </x-dropdown.link>
            <x-dropdown.link wire:click="showProgressiveRunForm({{ $loop->index }})">
                <x-icon.plus class="inline"/>
                Progressive Run
            </x-dropdown.link>
            <x-dropdown.link wire:click="showCoolDownForm({{ $loop->index }})">
                <x-icon.plus class="inline"/>
                Cool-down
            </x-dropdown.link>
        </div>
    </x-slot>
</x-dropdown.dropdown>

<div class="relative w-full bg-white rounded-md shadow-sm">
    <div class="flex absolute top-1 right-1 z-10">
        <div class="p-1">
            <x-dropdown.dropdown>
                <x-slot name="trigger">
                    <x-icon.dots-vertical class="text-gray-400 hover:text-indigo-500"/>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown.link wire:click="goToMesocycle">
                        Go To Mesocycle
                    </x-dropdown.link>
                    <div class="px-2">
                        <hr>
                    </div>
                    <x-dropdown.link wire:click="editMesocycle({{$mesocycle->id}})">
                        Edit
                    </x-dropdown.link>
                    <x-dropdown.link wire:click="confirmDelete({{ $mesocycle->id }})">
                        Delete
                    </x-dropdown.link>
                </x-slot>
            </x-dropdown.dropdown>
        </div>
    </div>

    <div class="flex">
        <div
            class="flex flex-shrink-0 w-2 rounded-l-md"
            style="background: {{$mesocycle->color->hex_code}}"
        >
        </div>
        <div class="flex items-start justify-between w-full rounded-r-md"
             style="border: 1px solid {{$mesocycle->color->hex_code}}">
            <div class="w-3/4 px-4 py-2">
                <div class="flex-col">
                    <div wire:click="goToMesocycle" class="flex cursor-pointer text-gray-800 hover:text-indigo-500 font-medium">
                        {{ $mesocycle->name }}
                    </div>
                    <div class="flex pl-4 text-sm text-gray-400 space-x-4">
                        <div>{{ $mesocycle->number_of_training_days }} Days</div>
                        <div>{{ $mesocycle->number_of_microcycles }} Microcycles</div>
                        <div>{{ $mesocycle->number_of_runs }} Runs</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

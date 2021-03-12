<div
    x-data="{show: false}"
    @mouseover="show = true"
    @mouseleave="show = false"
    class="relative w-full bg-white rounded-md shadow-sm">

    <div x-show="show" class="flex absolute items-center justify-between top-1 right-1 z-10 space-x-2">

        <a href="/training/macrocycles/{{ $macrocycle->id }}/mesocycles/{{ $mesocycle->slug }}" class="text-sm p-1 text-gray-400 hover:text-indigo-500">
            Go to Mesocycle
        </a>

        <div class="p-1">
            <x-dropdown.dropdown>
                <x-slot name="trigger">
                    <x-icon.dots-vertical class="text-gray-400 hover:text-indigo-500"/>
                </x-slot>
                <x-slot name="content">
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
                    <div class="flex">
                        <a
                            href="/training/macrocycles/{{ $macrocycle->id }}/mesocycles/{{ $mesocycle->slug}}"
                            class="mr-4 font-medium">{{ $mesocycle->name }}
                        </a>

                    </div>
                    <div class="flex pl-4 text-sm text-gray-400">
                        {{ $mesocycle->number_of_weeks }} Weeks {{ $mesocycle->number_of_remainder_days }} Days
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

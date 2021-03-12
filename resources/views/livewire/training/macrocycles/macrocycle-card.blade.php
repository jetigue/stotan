<li x-data="{show: false}"
    @mouseover="show = true"
    @mouseleave="show = false"
    class="relative col-span-1 bg-white rounded-lg shadow border-2 border-white hover:border-indigo-500">
    <div x-show="show" class="flex absolute justify-between top-1 right-1 z-10 space-x-2">

        <a href="/training/macrocycles/{{ $macrocycle->id }}" class="p-1 text-sm text-gray-400 hover:text-indigo-500">
            Go to Macrocycle
        </a>

        <div class="p-1">
            <x-dropdown.dropdown>
                <x-slot name="trigger">
                        <x-icon.dots-vertical class="text-gray-300 hover:text-indigo-500" />
                </x-slot>
                <x-slot name="content">
                    <x-dropdown.link wire:click="editMacrocycle({{$macrocycle->id}})">
                        Edit
                    </x-dropdown.link>
                    <x-dropdown.link wire:click="confirmDelete({{ $macrocycle->id }})">
                        Delete
                    </x-dropdown.link>
                </x-slot>
            </x-dropdown.dropdown>
        </div>

    </div>


    <div class="w-full flex items-center p-6">
        <div class="flex-1 truncate">
            <div class="flex items-center">
                <h3 class="text-gray-900 font-medium truncate">{{ $macrocycle->name }}</h3>
            </div>

            <div class="text-xs text-gray-400">
                {{ $macrocycle->begin_date_for_humans }}
                <span class="px-1 text-gray-300">-></span>
                {{ $macrocycle->end_date_for_humans }}
            </div>
        </div>
    </div>
    <div>
        <div class="flex px-4 space-x-2 pb-4">

            <div class="w-1/3 flex items-center text-gray-800 flex-wrap px-2">
                <div class="text-3xl text-indigo-500 font-semibold italic mr-2">
                    {{ $macrocycle->number_of_weeks }}
                </div>
                <div class="flex flex-col leading-4 text-sm">
                    <div>{{ $this->weeksLabel }}</div>
                    @if ($this->days > 0)
                        <div>{{ $this->days }}</div>
                    @endif
                </div>
            </div>

            <div class="w-1/3 flex items-center text-gray-800 flex-wrap px-2">
                <div class="text-3xl text-indigo-500 font-semibold italic mr-2">
                    {{ count($macrocycle->mesocycles) }}
                </div>
                <div class="flex flex-col text-sm leading-4">
                    <div>Training</div>
                    <div>Phases</div>
                </div>
            </div>

            <div class="w-1/3 flex items-center text-gray-800 flex-wrap px-2">
                <div class="text-3xl text-indigo-500 font-semibold italic mr-1">
                    {{ count($macrocycle->mesocycles) }}
                </div>
                <div class="flex flex-col leading-5">
                    <div>Training</div>
                    <div class="text-sm">Phases</div>
                </div>
            </div>

        </div>
    </div>
</li>

<li class="flex flex-col col-span-1 text-center bg-white divide-y divide-gray-200 rounded-lg shadow">
    <div class="relative flex flex-col flex-1 p-8">
{{--        <div class="absolute top-4 left-4 z-10">--}}
{{--            <x-dropdown.dropdown align="left">--}}
{{--                <x-slot name="trigger">--}}
{{--                    <div class="text-gray-300">--}}
{{--                        <x-icon.dots-vertical class="w-5 h-5"/>--}}
{{--                    </div>--}}
{{--                </x-slot>--}}
{{--                <x-slot name="content">--}}
{{--                    <x-dropdown.link wire:click="edit({{$macrocycle->id}})">--}}
{{--                        Edit--}}
{{--                    </x-dropdown.link>--}}
{{--                    <x-dropdown.link wire:click="confirmDelete({{ $macrocycle->id }})">--}}
{{--                        Delete--}}
{{--                    </x-dropdown.link>--}}
{{--                </x-slot>--}}
{{--            </x-dropdown.dropdown>--}}
{{--        </div>--}}
        <div class="absolute top-4 left-20 text-center mx-auto items-center">
            @if($macrocycle->number_of_unassigned_days !== 0)
                <span class="text-xs font-semibold text-yellow-500">{{ $macrocycle->number_of_unassigned_days }} unassigned days!</span>
            @endif
        </div>

        <h3 class="mt-5 text-lg font-medium text-gray-700">{{ $name }}</h3>
        <div class="flex flex-col justify-start flex-grow mt-1">
            <div class="text-sm text-gray-500">
                {{ $macrocycle->begin_date_for_humans }}
                <span class="px-1 text-gray-300">-></span>
                {{ $macrocycle->end_date_for_humans }}
            </div>

            <div class="my-6">
                <div class="flex justify-center w-full text-sm font-medium text-gray-500">
                    <h5>Training Phases</h5>
                </div>
                <div class="flex w-full mx-auto lg:w-3/4">
                    @if(count($macrocycle->mesocycles) > 0)
                        <ul class="w-full text-xs text-medium text-gray-400">
                            @foreach($macrocycle->mesocycles as $mesocycle)
                                <li class="flex flex w-full leading-6 items-center">
                                    <div class="w-2 h-2 mr-2" style="background-color: {{$mesocycle->color}} "></div>
                                    <div class="flex">{{ $mesocycle->name }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-xs text-gray-400">None</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="flex -mt-px divide-x divide-gray-200">
            <div class="flex flex-1 w-0">
                <a href="/training/macrocycles/{{ $macrocycle->id }}"
                   class="relative justify-center flex-1 w-0 py-4 -mr-px text-xs font-medium text-gray-600 hover:text-indigo-500 border border-transparent rounded-bl-lg hover:text-gray-500">
                    <p>Add or View</p>
                    <p>Training Phases</p>
                </a>
            </div>
            <div class="flex flex-1 w-0 -ml-px">

                <div x-data="{ isOn: false } " class="flex w-full items-center text-gray-300 text-sm px-4">
                    <div class="flex w-full text-left font-medium ">
                        <span x-show="isOn" :class="{'text-green-500': isOn}">Active</span>
                        <span x-show="!isOn" :class="{'text-gray-500': !isOn}">Inactive</span>
                    </div>

                    <button
                            type="button"
                            @click="isOn = !isOn"
                            aria-pressed="false"
                            :class="{'bg-green-500': isOn}"
                            class="flex relative inline-flex flex-shrink-0 w-5 h-9 mx-2 transition-colors duration-200 ease-in-out bg-gray-300 border-2 border-transparent rounded-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <span class="sr-only">Use setting</span>
                        <span
                                :class="{'translate-y-4': !isOn, 'translate-y-0': isOn}"
                                aria-hidden="true"
                                class="inline-block w-4 h-4 transition duration-200 ease-in-out transform translate-y-0 bg-white rounded-full shadow ring-0"></span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</li>


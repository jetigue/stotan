<div class="w-full">
    <x-slot name="breadcrumbs">
        <x-breadcrumb.back href="/planner"/>
        <x-breadcrumb.menu>
            <x-breadcrumb.item href="/planner" :leadingArrow="false">Training</x-breadcrumb.item>
            <x-breadcrumb.item href="/planner">Macrocycles</x-breadcrumb.item>
        </x-breadcrumb.menu>
    </x-slot>

    <x-slot name="header">
        {{ $mesocycle->name }}
    </x-slot>
    <div x-data="{ isOn: @entangle('showCalendar') }">
        <div class="flex justify-between p-6">
            <div class="flex items-center space-x-2 text-cool-gray-400 hover:text-blue-700">
                <x-icon.arrow-left />
                <a href="/training/macrocycles/{{$mesocycle->macrocycle->id}}">
                    Back to {{$mesocycle->macrocycle->name}}
                </a>
            </div>
            <div  class="flex justify-end text-cool-gray-300">
                <span :class="{'text-cool-gray-700': !isOn}">Table View</span>
                <button
                    type="button"
                    @click="isOn = !isOn"
                    aria-pressed="false"
                    class="relative inline-flex flex-shrink-0 w-10 h-5 mx-2 transition-colors duration-200 ease-in-out bg-black border-2 border-transparent rounded-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                  <span class="sr-only">Use setting</span>
                  <span
                      :class="{'translate-x-5': isOn, 'translate-x-0': !isOn}"
                      aria-hidden="true"
                      class="inline-block w-4 h-4 transition duration-200 ease-in-out transform translate-x-0 bg-white rounded-full shadow ring-0"></span>
                </button>
                <span :class="{'text-cool-gray-700': isOn}">Calendar View</span>
            </div>
        </div>


        <div x-show="!isOn" class="flex justify-between">
                <div class="hidden md:flex md:w-1/3 md:px-2 lg:px-4">
                    @include('partials.training.mesocycle-mini-calendar')
                </div>
                <div class="w-full md:w-2/3 lg:w-8/12 md:px-2 lg:px-4">
                    <x-table.table>
                        <x-slot name="head">
                            <x-table.heading
                                sortable wire:click="sortBy('training_day')"
                                :direction="$sortField === 'training_day' ? $sortDirection : null"
                            >
                                Training Day
                            </x-table.heading>
                            <x-table.heading sortable>Training Sessions</x-table.heading>
                            <x-table.heading sortable>End Date</x-table.heading>
                        </x-slot>
                        <x-slot name="body">
                            @forelse ($mesocycle->periodOfDays as $trainingDay)
                                <x-table.row>
                                    <x-table.cell>
                                        {{ $trainingDay->format('M j, Y')}}
                                    </x-table.cell>
                                    <x-table.cell>
                                        <div class="flex-col text-xs text-cool-gray-300">
                                            <div class="flex">am:</div>
                                            <div class="flex">pm:</div>
                                        </div>
                                    </x-table.cell>
                                    <x-table.cell>
                                        <div class="flex justify-end">
                                            <x-dropdown.dropdown>
                                                <x-slot name="trigger">
                                                    <div class="text-cool-gray-600-600">
                                                        <x-icon.dots-vertical></x-icon.dots-vertical>
                                                    </div>
                                                </x-slot>
                                                <x-slot name="content">
                                                    <x-dropdown.link>
                                                        Add a Workout
                                                    </x-dropdown.link>
                                                    <x-dropdown.link>
                                                        Build a Workout
                                                    </x-dropdown.link>
                                                </x-slot>
                                            </x-dropdown.dropdown>
                                        </div>

                                    </x-table.cell>
                                </x-table.row>
                            @empty
                                <x-table.row>
                                    <x-table.cell colspan="3">
                                        <div class="flex items-center justify-center">
                                            <span class="py-8 text-xl font-medium text-gray-400 ">
                                                No training days found...
                                            </span>
                                        </div>
                                    </x-table.cell>
                                </x-table.row>
                            @endforelse
                        </x-slot>
                    </x-table.table>
                    <div class="py-6">
                        {{-- {{ $trainingDays->links() }} --}}
                    </div>
                </div>
            </div>

        <div x-show="isOn" class="flex flex-wrap content-start w-full h-auto">
                @foreach ($mesocycle->months as $month)
                    <div class="flex w-full px-2 py-4">
                        <div class="flex-col w-full">
                            <div class="flex justify-center mb-2 text-center">
                                <p class="text-lg">
                                    {{ $month->format('F') }}
                                </p>
                            </div>
                            <div class="flex text-xs text-center">
                                <div class="w-1/7">S</div>
                                <div class="w-1/7">M</div>
                                <div class="w-1/7">T</div>
                                <div class="w-1/7">W</div>
                                <div class="w-1/7">T</div>
                                <div class="w-1/7">F</div>
                                <div class="w-1/7">S</div>
                            </div>
                            <div class="flex flex-wrap">
                                @switch($month->firstOfMonth()->format('l'))
                                    @case('Monday')
                                    <div class="w-1/7"></div>
                                    @break

                                    @case('Tuesday')
                                    <div class="w-2/7"></div>
                                    @break

                                    @case('Wednesday')
                                    <div class="w-3/7"></div>
                                    @break

                                    @case('Thursday')
                                    <div class="w-4/7"></div>
                                    @break

                                    @case('Friday')
                                    <div class="w-5/7"></div>
                                    @break

                                    @case('Saturday')
                                    <div class="w-6/7"></div>
                                    @break

                                    @case('Sunday')
                                    <div></div>
                                    @break
                                @endswitch
                                @foreach ($mesocycle->period_of_all_days_in_months as $date)
                                    @if ($date->format('F') === $month->format('F'))
                                        <div x-data="{ show: false}" class="relative flex h-40 border w-1/7">
                                            @if($date >= $mesocycle->begin_date && $date <= $mesocycle->end_date)
                                                <div
                                                    @mouseover="show=true"
                                                    @mouseout="show=false"
                                                    class="absolute z-10 w-full min-h-full">
                                                    <div
                                                        class="flex justify-between">
                                                        <p class="px-1 text-xs text-cool-gray-400">
                                                            {{ $date->format('j') }}
                                                        </p>
                                                        <button x-show="show" type="button" class="bg-black rounded-md p-1 text-cool-gray-100">
                                                            <x-icon.plus />
                                                        </button>
                                                    </div>
                                                </div>
                                            @else
                                                @if($date >= $mesocycle->macrocycle->begin_date && $date <= $mesocycle->macrocycle->end_date)
                                                    <div class="w-full bg-cool-gray-200">
                                                        <p class="px-1 text-xs text-gray-400">
                                                            {{ $date->format('j') }}
                                                        </p>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>

</div>

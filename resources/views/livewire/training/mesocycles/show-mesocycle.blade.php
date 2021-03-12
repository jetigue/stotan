<div class="w-full">
    <x-slot name="breadcrumbs">
        <x-breadcrumb.back href="/planner"/>
        <x-breadcrumb.menu>
            <x-breadcrumb.item href="/training" :leadingArrow="false">Training</x-breadcrumb.item>
            <x-breadcrumb.item href="/training/macrocycles">Macrocycles</x-breadcrumb.item>
            <x-breadcrumb.item
                href="/training/macrocycles/{{ $mesocycle->macrocycle->id }}">{{ $mesocycle->macrocycle->name }}</x-breadcrumb.item>
        </x-breadcrumb.menu>
    </x-slot>

    <x-slot name="header">
        <div class="flex items-baseline justify-between">
            <h1>{{ $mesocycle->name }}</h1>
{{--            <div class="mb-1 text-sm">--}}
{{--                <livewire:training.mesocycles.view-toggle :mesocycle="$mesocycle" />--}}
{{--            </div>--}}
        </div>
    </x-slot>
{{--    <div x-data="{ show: @entangle('showCalendar') }">--}}
    <div class="flex w-full">
        <aside class="hidden md:flex md:w-1/4 pr-2">
            <div class="flex-col w-full">
                <x-card.card-with-header class="min-h-full">
                    <x-slot name="header">
                        <div class="flex justify-around -my-1">
                            <div class="flex flex-col text-center">
                                <p class="text-xs text-gray-400">Begin Date</p>
                                <p class="text-sm">{{ $mesocycle->begin_date->format('M j, Y') }}</p>
                            </div>
                            <div class="flex flex-col text-center">
                                <p class="text-xs text-gray-400">End Date</p>
                                <p class="text-sm">{{ $mesocycle->end_date->format('M j, Y') }}</p>
                            </div>
                        </div>
                    </x-slot>
                    @include('partials.training.mesocycle-mini-calendar')
                </x-card.card-with-header>
            </div>
        </aside>

        <div class="w-3/4">
            <livewire:training.mesocycles.training-days-table :mesocycle="$mesocycle" />
        </div>
    </div>





{{--        <template x-if="show">--}}
{{--            <div class="w-3/4">--}}
{{--                <div class="flex flex-wrap content-start w-full h-auto">--}}
{{--                    @foreach ($mesocycle->months as $month)--}}
{{--                        <div class="flex w-full px-2 py-4">--}}
{{--                            <div class="flex-col w-full">--}}
{{--                                <div class="flex justify-center mb-2 text-center">--}}
{{--                                    <p class="text-lg">--}}
{{--                                        {{ $month->format('F') }}--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                                <div class="flex text-xs text-center">--}}
{{--                                    <div class="w-1/7">S</div>--}}
{{--                                    <div class="w-1/7">M</div>--}}
{{--                                    <div class="w-1/7">T</div>--}}
{{--                                    <div class="w-1/7">W</div>--}}
{{--                                    <div class="w-1/7">T</div>--}}
{{--                                    <div class="w-1/7">F</div>--}}
{{--                                    <div class="w-1/7">S</div>--}}
{{--                                </div>--}}
{{--                                <div class="flex flex-wrap">--}}
{{--                                    @switch($month->firstOfMonth()->format('l'))--}}
{{--                                        @case('Monday')--}}
{{--                                        <div class="w-1/7"></div>--}}
{{--                                        @break--}}

{{--                                        @case('Tuesday')--}}
{{--                                        <div class="w-2/7"></div>--}}
{{--                                        @break--}}

{{--                                        @case('Wednesday')--}}
{{--                                        <div class="w-3/7"></div>--}}
{{--                                        @break--}}

{{--                                        @case('Thursday')--}}
{{--                                        <div class="w-4/7"></div>--}}
{{--                                        @break--}}

{{--                                        @case('Friday')--}}
{{--                                        <div class="w-5/7"></div>--}}
{{--                                        @break--}}

{{--                                        @case('Saturday')--}}
{{--                                        <div class="w-6/7"></div>--}}
{{--                                        @break--}}

{{--                                        @case('Sunday')--}}
{{--                                        <div></div>--}}
{{--                                        @break--}}
{{--                                    @endswitch--}}
{{--                                    @foreach ($mesocycle->period_of_all_days_in_months as $date)--}}
{{--                                        @if ($date->format('F') === $month->format('F'))--}}
{{--                                            <div x-data="{ show: false}"--}}
{{--                                                 wire:key="{{ $loop->index }}"--}}
{{--                                                 class="relative flex h-32 border w-1/7">--}}
{{--                                                @if($date >= $mesocycle->begin_date && $date <= $mesocycle->end_date)--}}
{{--                                                    <div--}}
{{--                                                        @mouseover="show=true"--}}
{{--                                                        @mouseout="show=false"--}}
{{--                                                        class="absolute z-10 w-full min-h-full bg-white">--}}
{{--                                                        <div--}}
{{--                                                            class="flex justify-between">--}}
{{--                                                            <p class="px-1 text-xs text-gray-400">--}}
{{--                                                                {{ $date->format('j') }}--}}
{{--                                                            </p>--}}
{{--                                                            <button x-show="show" type="button"--}}
{{--                                                                    class="p-1 bg-black rounded-md text-cool-gray-100">--}}
{{--                                                                <x-icon.plus/>--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                @else--}}
{{--                                                    @if($date >= $mesocycle->macrocycle->begin_date && $date <= $mesocycle->macrocycle->end_date)--}}
{{--                                                        <div class="w-full bg-bg-gray-200 ">--}}
{{--                                                            <p class="px-1 text-xs text-gray-400">--}}
{{--                                                                {{ $date->format('j') }}--}}
{{--                                                            </p>--}}
{{--                                                        </div>--}}
{{--                                                    @endif--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </template>--}}

{{--            <template x-if="!show">--}}
{{--                <div class="flex w-full">--}}
{{--                <aside class="hidden md:flex md:w-1/4">--}}
{{--                    <div class="flex-col w-full pr-4">--}}
{{--                        <x-card.card-with-header class="min-h-full">--}}
{{--                            <x-slot name="header">--}}
{{--                                <div class="flex justify-around -my-1">--}}
{{--                                    <div class="flex flex-col text-center">--}}
{{--                                        <p class="text-xs text-gray-400">Begin Date</p>--}}
{{--                                        <p class="text-sm">{{ $mesocycle->begin_date->format('M j, Y') }}</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex flex-col text-center">--}}
{{--                                        <p class="text-xs text-gray-400">End Date</p>--}}
{{--                                        <p class="text-sm">{{ $mesocycle->end_date->format('M j, Y') }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </x-slot>--}}
{{--                            @include('partials.training.mesocycle-mini-calendar')--}}
{{--                        </x-card.card-with-header>--}}
{{--                    </div>--}}
{{--                </aside>--}}

{{--                <div class="flex w-full md:w-1/2 px-2">--}}
{{--                    <x-card.card-with-header>--}}
{{--                        <x-slot name="header">--}}
{{--                            <p class="text-lg font-medium">Training Days</p>--}}
{{--                        </x-slot>--}}
{{--                        <ul class="divide-y divide-gray-200">--}}
{{--                            @foreach ($mesocycle->periodOfDays as $trainingDay)--}}
{{--                                <li wire:key="{{ $loop->index }}" class="flex justify-between py-4">--}}
{{--                                    <div class="flex w-1/5">--}}
{{--                                        {{ $trainingDay->format('M j, Y')}}--}}
{{--                                    </div>--}}
{{--                                    <div class="flex w-1/2">--}}
{{--                                        <div class="flex flex-col w-full">--}}
{{--                                            @foreach($warmUps as $warmUp)--}}
{{--                                                @if($trainingDay->format('Y-m-d') === $warmUp->training_date)--}}
{{--                                                    <div x-data="{ show: false }"--}}
{{--                                                         class="cursor-pointer flex justify-between w-full text-sm leading-6 text-gray-600">--}}
{{--                                                        <div @click="show=true" class="flex"><span--}}
{{--                                                                class="text-gray-400 mr-2">Warm-up: </span> {{ $warmUp->duration}} {{ $warmUp->duration_unit }}--}}
{{--                                                        </div>--}}
{{--                                                        <div--}}
{{--                                                            x-show="show"--}}
{{--                                                            @click.away="show=false"--}}
{{--                                                            class="flex"--}}
{{--                                                        >--}}
{{--                                                            <button type="button"--}}
{{--                                                                    wire:click="editWarmUp({{ $warmUp->id }})"--}}
{{--                                                            >--}}
{{--                                                                <x-icon.edit class="inline mr-2"/>--}}
{{--                                                            </button>--}}

{{--                                                            <button type="button"--}}
{{--                                                                    wire:click="destroySteadyRun({{ $warmUp->id }})"--}}
{{--                                                                    class=""--}}
{{--                                                            >--}}
{{--                                                                <x-icon.trash/>--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}

{{--                                                @foreach($steadyRuns as $steadyRun)--}}
{{--                                                    @if($trainingDay->format('Y-m-d') === $steadyRun->training_date)--}}
{{--                                                        <div x-data="{ show: false }"--}}
{{--                                                             class="cursor-pointer flex justify-between w-full text-sm leading-6 text-gray-600">--}}
{{--                                                            <div @click="show=true" class="flex">--}}
{{--                                                                {{ $steadyRun->duration}} {{ $steadyRun->duration_unit }}  {{ $steadyRun->runType->name }} at {{ $steadyRun->intensity->name }} pace.--}}
{{--                                                            </div>--}}
{{--                                                            <div--}}
{{--                                                                x-show="show"--}}
{{--                                                                @click.away="show=false"--}}
{{--                                                                class="flex"--}}
{{--                                                            >--}}
{{--                                                                <button type="button"--}}
{{--                                                                        wire:click="editSteadyRun({{ $steadyRun->id }})"--}}
{{--                                                                >--}}
{{--                                                                    <x-icon.edit class="inline mr-2"/>--}}
{{--                                                                </button>--}}

{{--                                                                <button type="button"--}}
{{--                                                                        wire:click="destroySteadyRun({{ $steadyRun->id }})"--}}
{{--                                                                        class=""--}}
{{--                                                                >--}}
{{--                                                                    <x-icon.trash/>--}}
{{--                                                                </button>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    @endif--}}
{{--                                                @endforeach--}}

{{--                                            @foreach($coolDowns as $coolDown)--}}
{{--                                                @if($trainingDay->format('Y-m-d') === $coolDown->training_date)--}}
{{--                                                    <div x-data="{ show: false }"--}}
{{--                                                         class="cursor-pointer flex justify-between w-full text-sm leading-6 text-gray-600">--}}
{{--                                                        <div @click="show=true" class="flex"><span--}}
{{--                                                                class="text-gray-400 mr-2">Cool-down: </span> {{ $coolDown->duration}} {{ $coolDown->duration_unit }}--}}
{{--                                                        </div>--}}
{{--                                                        <div--}}
{{--                                                            x-show="show"--}}
{{--                                                            @click.away="show=false"--}}
{{--                                                            class="flex"--}}
{{--                                                        >--}}
{{--                                                            <button type="button"--}}
{{--                                                                    wire:click="editWarmUp({{ $coolDown->id }})"--}}
{{--                                                            >--}}
{{--                                                                <x-icon.edit class="inline mr-2"/>--}}
{{--                                                            </button>--}}

{{--                                                            <button type="button"--}}
{{--                                                                    wire:click="destroySteadyRun({{ $coolDown->id }})"--}}
{{--                                                                    class=""--}}
{{--                                                            >--}}
{{--                                                                <x-icon.trash/>--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex justify-end w-1/12">--}}
{{--                                        <x-dropdown.dropdown>--}}
{{--                                            <x-slot name="trigger">--}}
{{--                                                <x-icon.dots-vertical class="text-gray-400"/>--}}
{{--                                            </x-slot>--}}
{{--                                            <x-slot name="content">--}}
{{--                                                <div class="text-gray-400">--}}
{{--                                                    <x-dropdown.link wire:click="showWarmUpForm({{ $loop->index }})">--}}
{{--                                                        <x-icon.plus class="inline"/>--}}
{{--                                                        Warm-up--}}
{{--                                                    </x-dropdown.link>--}}
{{--                                                    <x-dropdown.link wire:click="showSteadyRunForm({{ $loop->index }})">--}}
{{--                                                        <x-icon.plus class="inline"/>--}}
{{--                                                        Steady Run--}}
{{--                                                    </x-dropdown.link>--}}
{{--                                                    <x-dropdown.link>--}}
{{--                                                        <x-icon.plus class="inline"/>--}}
{{--                                                        Intermittent Run--}}
{{--                                                    </x-dropdown.link>--}}
{{--                                                    <x-dropdown.link>--}}
{{--                                                        <x-icon.plus class="inline"/>--}}
{{--                                                        Progressive Run--}}
{{--                                                    </x-dropdown.link>--}}
{{--                                                    <x-dropdown.link wire:click="showCoolDownForm({{ $loop->index }}) ">--}}
{{--                                                        <x-icon.plus class="inline"/>--}}
{{--                                                        Cool-down--}}
{{--                                                    </x-dropdown.link>--}}
{{--                                                </div>--}}

{{--                                            </x-slot>--}}
{{--                                        </x-dropdown.dropdown>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                        <x-modal.form wire:model.defer="showWarmUpFormModal" name="Warm-up">--}}
{{--                            <livewire:training.runs.warm-up-form :mesocycle="$mesocycle"/>--}}
{{--                        </x-modal.form>--}}

{{--                        <x-modal.form wire:model.defer="showSteadyRunFormModal" name="Steady Run">--}}
{{--                            <livewire:training.runs.steady-run-form :mesocycle="$mesocycle"/>--}}
{{--                        </x-modal.form>--}}

{{--                        <x-modal.form wire:model.defer="showCoolDownFormModal" name="Cool-down">--}}
{{--                            <livewire:training.runs.cool-down-form :mesocycle="$mesocycle"/>--}}
{{--                        </x-modal.form>--}}
{{--                    </x-card.card-with-header>--}}
{{--                </div>--}}
{{--                </div>--}}
{{--            </template>--}}

{{--    </div>--}}
</div>

<div class="min-h-full">
    <x-slot name="breadcrumbs">
        <x-breadcrumb.back href="/planner" />
        <x-breadcrumb.menu>
            <x-breadcrumb.item href="/training" :leadingArrow="false">Training</x-breadcrumb.item>
            <x-breadcrumb.item href="/training/macrocycles">Training Cycles</x-breadcrumb.item>
        </x-breadcrumb.menu>
    </x-slot>
    <x-slot name="header">
        {{ $macrocycle->name }}
    </x-slot>

    <div class="flex w-full">
        <aside class="md:w-1/4">
            <div class="flex-col w-full pr-4">
                <x-card.card-with-header class="min-h-full">
                    <x-slot name="header">
                            <div class="flex justify-around -my-1">
                                <div class="flex flex-col text-center">
                                    <p class="text-sm text-cool-gray-400">Begin Date</p>
                                    <p>{{ $macrocycle->begin_date->format('M j, Y') }}</p>
                                </div>
                                <div class="flex flex-col text-center">
                                    <p class="text-sm text-cool-gray-400">End Date</p>
                                    <p>{{ $macrocycle->end_date->format('M j, Y') }}</p>
                                </div>
                            </div>
                    </x-slot>
                    <div class="relative w-full">
                        <div class="absolute -my-4 top-0 left-0 right-0 text-center mx-auto items-center">
                            @if($macrocycle->number_of_unassigned_days > 0)
                                <span class="text-xs font-semibold text-yellow-500">{{ $macrocycle->number_of_unassigned_days }} unassigned days!</span>
                            @elseif($macrocycle->number_of_unassigned_days < 0)
                                <span class="text-xs font-semibold text-yellow-500">Too many days assigned ({{ ltrim($macrocycle->number_of_unassigned_days, '-') }})</span>
                            @endif
                        </div>
                        @include('partials.training.macrocycle-mini-calendars')
                    </div>

                </x-card.card-with-header>
            </div>
        </aside>

        <div class="flex flex-col px-2 md:w-1/2">
            <x-card.card-with-header>
                <x-slot name="header">
                    <x-card.heading-with-action>
                        Training Phases
                        <x-slot name="action">
                            <x-button.primary wire:click="showCreateModal">
                                <x-icon.plus class="mr-2" />
                                Create
                            </x-button.primary>
                            <div>
                                @include('partials.training.mesocycles.form-modal')
                            </div>
                        </x-slot>
                    </x-card.heading-with-action>
                </x-slot>
                <div class="flex-col space-y-5">
                    @if(count($mesocycles) > 0)
                        @foreach($mesocycles as $mesocycle)
                            <livewire:training.mesocycles.mesocycle-card
                                :mesocycle="$mesocycle"
                                :key="$mesocycle->id" />
                        @endforeach
                        @include('partials.training.mesocycles.confirm-delete-modal')
                    @else
                        This training cycle currently does not have any training phases.
                    @endif
                </div>
            </x-card.card-with-header>
        </div>
    </div>
</div>

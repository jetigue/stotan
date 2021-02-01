<div class="min-h-full">
    <x-slot name="breadcrumbs">
        <x-breadcrumb.back href="/planner" />
        <x-breadcrumb.menu>
            <x-breadcrumb.item href="/training/planner" :leadingArrow="false">Training</x-breadcrumb.item>
            <x-breadcrumb.item href="/">Training Cycles</x-breadcrumb.item>
        </x-breadcrumb.menu>
    </x-slot>
    <x-slot name="header">
        {{ $macrocycle->name }} <span class="text-cool-gray-400">Training Cycle</span>
    </x-slot>

    <div class="flex w-full">
        <div class="md:w-1/2">
            <div class="flex-col w-full px-4">
                <x-card.card-with-header class="min-h-full">
                    <x-slot name="header">
                        @if($macrocycle->number_of_unassigned_days !== 0)
                           <x-message.warning>
                               There are {{ $macrocycle->number_of_unassigned_days }} unassigned days in this training cycle!
                           </x-message.warning>
                        @endif
                            <div class="flex justify-around -my-1">
                                <div class="flex flex-col text-center">
                                    <p class="text-sm text-cool-gray-400">Begin Date</p>
                                    <p>{{ $macrocycle->begin_date->format('F j, Y') }}</p>
                                </div>
                                <div class="flex flex-col text-center">
                                    <p class="text-sm text-cool-gray-400">End Date</p>
                                    <p>{{ $macrocycle->end_date->format('F j, Y') }}</p>
                                </div>
                            </div>
                    </x-slot>
                    @include('partials.training.macrocycle-mini-calendars')
                </x-card.card-with-header>
            </div>
        </div>
        <div class="flex flex-col md:w-1/2 px-4">
            <x-card.card-with-header>
                <x-slot name="header">
                    <x-card.heading-with-action>
                        Training Phases
                        <x-slot name="action">
                            <x-button.primary wire:click="showCreateModal">
                                <x-icon.plus></x-icon.plus>
                                Create Training Phase
                            </x-button.primary>
                            <div>
                                @include('partials.training.create-mesocycle-modal')
                            </div>
                        </x-slot>
                    </x-card.heading-with-action>
                </x-slot>
                <div class="flex-col space-y-5">
                    @if(count($macrocycle->mesocycles) > 0)
                        @foreach($mesocycles as $mesocycle)
                            <div class="w-full bg-white rounded-md shadow-sm">
                                <div class="flex">
                                    <div
                                        class="flex flex-shrink-0 w-2 rounded-l-md"
                                        style="background: {{$mesocycle->color}}"
                                    >
                                    </div>
                                    <div class="flex items-center justify-between w-full rounded-r-md" style="border: 1px solid {{$mesocycle->color}}">
                                        <div class="w-3/4 px-4 py-2">
                                            <div class="flex-col">
                                                <div class="flex">
                                                    <a
                                                        href="/training/macrocycles/{{ $macrocycle->id }}/mesocycles/{{$mesocycle->id}}"
                                                        class="font-medium mr-4">{{ $mesocycle->name }}
                                                    </a>

                                                </div>
                                                <div class="flex text-sm text-cool-gray-400">
                                                    <div class="mr-10">{{ $mesocycle->number_of_weeks }} Weeks</div>
                                                    <div>{{ $mesocycle->begin_date_for_humans }}
                                                        -> {{ $mesocycle->end_date_for_humans }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-1/12">
                                            <x-dropdown.dropdown>
                                                <x-slot name="trigger">
                                                    <div class="text-gray-600">
                                                        <x-icon.dots-vertical></x-icon.dots-vertical>
                                                    </div>
                                                </x-slot>
                                                <x-slot name="content">
                                                    <x-dropdown.link wire:click="edit({{$mesocycle->id}})">
                                                        Edit
                                                    </x-dropdown.link>
                                                    <x-dropdown.link wire:click="confirmDelete({{ $mesocycle->id }})">
                                                        Delete
                                                    </x-dropdown.link>
                                                </x-slot>
                                            </x-dropdown.dropdown>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @include('partials.training.confirm-mesocycle-delete-modal')
                    @else
                        This training cycle currently does not have any training phases.
                    @endif
                </div>
            </x-card.card-with-header>
        </div>
    </div>
</div>

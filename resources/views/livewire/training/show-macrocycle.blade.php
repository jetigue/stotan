<div class="w-full min-h-full">
    <x-slot name="header"></x-slot>

    <div class="text-center">
        <div class="text-3xl">{{ $macrocycle->name }} Training Cycle</div>
        <div class="flex justify-center space-x-8">
            <div class="text-xl">{{ $macrocycle->number_of_weeks }} Weeks</div>
            <div class="text-xl">{{ $macrocycle->number_of_mesocycles }} Training Phases</div>
        </div>

    </div>

    <div class="flex w-full">
        <div class="md:w-1/2">
            <div class="flex-col w-full px-4">
                <x-card.basic>
                @if($macrocycle->number_of_unassigned_days !== 0)
                    <div class="rounded-md bg-yellow-100 px-4 py-3 items-center">
                      <div class="flex">
                        <div class="flex-shrink-0">
                            <x-icon.exclamation></x-icon.exclamation>
                        </div>
                        <div class="ml-3 flex-1 md:flex md:justify-between">
                          <p class="text-sm text-blue-700">
                            There are {{ $macrocycle->number_of_unassigned_days }} unassigned days in this training cycle!
                          </p>
                        </div>
                      </div>
                    </div>
                @endif


                    @include('partials.training.macrocycle-mini-calendars')
                </x-card.basic>
            </div>
        </div>
        <div class="flex md:w-1/2 px-4">
            <x-card.card-gray-body>
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
                <div class="flex-col space-y-4">
                    @if(count($macrocycle->mesocycles) > 0)
                        @foreach($mesocycles as $mesocycle)
                            <div class="w-full bg-white rounded-md shadow-sm">
                                <div class="flex">
                                    <div
                                        class="flex flex-shrink-0 w-2 rounded-l-md"
                                        style="background: {{$mesocycle->color}}"
                                    >
                                    </div>
                                    <div class="flex items-center justify-between w-full">
                                        <div class="w-3/4 px-4 py-2">
                                            <div class="flex-col">
                                                <div class="flex">
                                                    <div class="font-medium mr-4">{{ $mesocycle->name }} </div>

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
                        No Mesocycles
                    @endif
                </div>
            </x-card.card-gray-body>
        </div>
    </div>
</div>

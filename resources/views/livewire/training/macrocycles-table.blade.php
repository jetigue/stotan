<div>
    <x-card.basic>
        <div class="flex-col">
            <div class="flex justify-between items-center mb-4">
                <header class="py-2 text-xl text-gray-600 italic">Current</header>
                {{-- @include('partials.training.runTypes.messages')
                <div class="flex items-center space-x-2">
                    @include('partials.training.runTypes.messages')
                    <x-button.primary wire:click="showFormModal">
                        <x-icon.plus class="h-5 w-5 mr-2"/>
                        Create
                    </x-button.primary> --}}
{{--                </div>--}}
            </div>
            <x-table.table>
                <x-slot name="head">
                    <x-table.header-row>
                        <x-table.heading class="w-1/4">
                            Name
                        </x-table.heading>
                        <x-table.heading class="w-1/4">
                            Dates
                        </x-table.heading>
                        <x-table.heading class="w-1/6 text-center">
                            # of Weeks
                        </x-table.heading>
                        <x-table.heading class="w-1/6 text-center">
                            # of Phases
                        </x-table.heading>

                    </x-table.header-row>
                </x-slot>
                <x-slot name="body">
                    @if ($macrocycles)
                    @foreach($macrocycles as $macrocycle)
                        <x-table.row>
                            <x-table.cell>
                                <div x-data="{ expanded: @entangle('isExpanded').defer }" class="flex">
                                    <div class="flex w-full w-11/12">
                                        <div class="flex flex-col w-full">
                                            <div class="flex w-full">
                                                <div class="w-1/4">{{ $macrocycle->name }}</div>
                                                <div class="w-1/4 flex-col">
                                                    <div>
                                                        <span class="text-gray-400 mr-2">Begins</span>
                                                        {{ $macrocycle->begin_date_for_humans }}
                                                    </div>
                                                    <div>
                                                        <span class="text-gray-400 mr-5">Ends</span>
                                                        {{ $macrocycle->end_date_for_humans }}
                                                    </div>
                                                </div>
                                                <div class="w-2/12 text-center">{{ $macrocycle->number_of_weeks }}</div>
                                                <div class="w-2/12 text-center">{{ $macrocycle->number_of_mesocycles }}</div>
                                                <div class="w-2/12 text-center">Status</div>
                                            </div>

                                            <div x-show="expanded"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="transform opacity-0 scale-95"
                                                     x-transition:enter-end="transform opacity-100 scale-100"
                                                     x-transition:leave="transition ease-in duration-200"
                                                     x-transition:leave-start="transform opacity-100 scale-100"
                                                     x-transition:leave-end="transform opacity-0 scale-95"
                                                 class="bg-green-50"
                                                >


                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col w-1/12 items-end justify-start">
                                        <x-button.expand></x-button.expand>
                                        <div x-show="expanded"
                                             class="flex h-full mt-4 mb-2"
                                        >

                                            <div class="flex items-end space-x-4 mr-8">
                                                <button
                                                        wire:click="edit({{$macrocycle->id}})"
                                                        type="button"
                                                >
                                                    <x-icon.edit></x-icon.edit>
                                                </button>
                                                <button
                                                        wire:click="confirmDelete({{ $macrocycle->id }})"
                                                        type="button"
                                                >
                                                    <x-icon.trash></x-icon.trash>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                        @endif
                </x-slot>
            </x-table.table>
            <div>
                {{-- @include('partials.training.runTypes.create-intermittent-run-modal')
                @include('partials.training.runTypes.confirm-intermittent-run-delete-modal') --}}
            </div>
        </div>
    </x-card.basic>
</div>

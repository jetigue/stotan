<div>
    <x-card.basic>
        <div class="flex-col">
            <div class="flex justify-between items-center mb-4">
                <header class="py-2 text-xl text-cool-gray-600 italic">Steady Runs</header>
                <div class="flex items-center space-x-2">
                    @include('partials.training.runTypes.messages')
                    <x-button.primary wire:click="showCreateModal">
                        <x-icon.plus class="h-5 w-5 mr-2"/>
                        Create
                    </x-button.primary>
                </div>

            </div>
            <x-table.table>
                <x-slot name="head">
                    <x-table.header-row>
                        <x-table.heading>
                            Name
                        </x-table.heading>
                    </x-table.header-row>
                </x-slot>
                <x-slot name="body">
                    @foreach($steadyRuns as $steadyRun)
                        <x-table.row class="items-start">
                            <x-table.cell>
                                <div x-data="{ expanded: @entangle('isExpanded').defer }" class="flex justify-between">
                                    <div class="flex-col">
                                        <div>{{ $steadyRun->name }}</div>
                                        <div x-show="expanded"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="transform opacity-0 scale-95"
                                             x-transition:enter-end="transform opacity-100 scale-100"
                                             x-transition:leave="transition ease-in duration-200"
                                             x-transition:leave-start="transform opacity-100 scale-100"
                                             x-transition:leave-end="transform opacity-0 scale-95"
                                        >
                                            <div class="py-2">{{ $steadyRun->description }}</div>
                                            <div class="space-x-1">
                                                <button
                                                    wire:click="edit({{$steadyRun->id}})"
                                                    type="button"
                                                    class="p-1"
                                                >
                                                    <x-icon.edit></x-icon.edit>
                                                </button>
                                                <button
                                                    wire:click="confirmDelete({{ $steadyRun->id }})"
                                                    type="button"
                                                    class="p-1"
                                                >
                                                    <x-icon.trash></x-icon.trash>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <x-button.expand></x-button.expand>
                                    </div>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                        @include('partials.training.runTypes.confirm-steady-run-delete-modal')
                    @endforeach
                </x-slot>
            </x-table.table>
            <div>
                @include('partials.training.runTypes.create-steady-run-modal')

            </div>
        </div>
    </x-card.basic>
</div>

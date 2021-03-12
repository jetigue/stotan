<div class="w-full min-h-full">
    <x-slot name="breadcrumbs">
        <x-breadcrumb.back href="/planner" />
        <x-breadcrumb.menu>
            <x-breadcrumb.item href="/planner" :leadingArrow="false">Training</x-breadcrumb.item>
            <x-breadcrumb.item href="/planner">Planner</x-breadcrumb.item>
        </x-breadcrumb.menu>
    </x-slot>
    <x-slot name="header">
        Training Intensities
    </x-slot>
<div class="flex w-full ">
    <div class="flex w-3/4">
         <x-card.basic class="w-full">
            <div class="w-full border-b-2 border-blue-200">
                <div class="flex w-full border-b-2 border-blue-200 pb-1 px-2">
                    <div class="flex w-11/12">
                        <x-table.heading class="w-full lg:w-1/3"
                             sortable wire:click="sortBy('name')"
                             :direction="$sortField === 'name' ? $sortDirection : null"
                        >
                            Name
                        </x-table.heading>

                        <x-table.heading class="hidden lg:inline lg:w-1/4"
                             sortable wire:click="sortBy('percentVO2Max')"
                             :direction="$sortField === 'percentVO2Max' ? $sortDirection : null"
                        >
                            % VO2 Max
                        </x-table.heading>

                        <x-table.heading class="hidden lg:inline lg:w-1/4"
                             sortable wire:click="sortBy('percentMaxHR')"
                             :direction="$sortField === 'percentHRMax' ? $sortDirection : null"
                        >
                            % Max HR
                        </x-table.heading>

                        <x-table.heading class="hidden lg:inline lg:w-1/4"
                             sortable wire:click="sortBy('jd_points')"
                             :direction="$sortField === 'jd_points' ? $sortDirection : null"
                        >
                            Value
                        </x-table.heading>
                    </div>
                </div>
                <div class="flex flex-col w-full divide-y divide-blue-100">
                    @foreach($intensities as $intensity)
                    <div x-data="{ expanded: @entangle('expandedRow').defer }" class="flex flex-col px-2">
                        <div class="flex w-full py-2 items-center">
                            <div class="flex w-11/12">
                                <div class="w-full lg:w-1/3">{{ $intensity->name }}</div>
                                <div class="hidden lg:inline lg:w-1/4">{{ $intensity->percentVO2Max}}</div>
                                <div class="hidden lg:inline lg:w-1/4">{{ $intensity->percentMaxHR}}</div>
                                <div class="hidden lg:inline lg:w-1/4">{{ $intensity->jd_points}}</div>
                            </div>
                            <div class="flex w-1/12 justify-end pt-1">
                                <x-button.expand />
                            </div>
                        </div>
                        <div x-show="expanded" class="flex flex-col w-11/12">
                            <div class="flex w-full justify-between flex-wrap space-y-3 text-sm">
                                <div class="flex w-full lg:hidden">
                                    <div class="w-1/2 text-blue-700 font-semibold">
                                        % VO2 Max
                                    </div>
                                    <div class="text-blue-500">
                                        {{ $intensity->percentVO2Max }}
                                    </div>
                                </div>
                                <div class="flex w-full lg:hidden">
                                    <div class="w-1/2 text-blue-700 font-semibold">
                                        % HR Max
                                    </div>
                                    <div class="text-blue-500">
                                        {{ $intensity->percentMaxHR }}
                                    </div>
                                </div>
                                <div class="flex w-full lg:hidden">
                                    <div class="w-1/2 text-blue-700 font-semibold">
                                        Points
                                    </div>
                                    <div class="text-blue-500">
                                        {{ $intensity->jd_points }}
                                    </div>
                                </div>
                                <div class="flex flex-col w-full">
                                    <div class="w-full text-blue-700 font-semibold">Description</div>
                                    <div class="text-blue-500">
                                        {{ $intensity->description }}
                                    </div>
                                </div>
                                <div class="flex flex-col w-full">
                                    <div class="text-blue-700 font-semibold">Purpose</div>
                                    <div class="text-blue-500">{{ $intensity->purpose }}</div>
                                </div>
                            </div>
                            <div class="flex space-x-1 py-2 justify-end -mr-6 md:-mr-8 lg:-mr-10 xl:-mr-12">
                                <div
                                    wire:click="edit({{$intensity->id}})"
                                    type="button"
                                    class="flex p-1"
                                >
                                    <x-icon.edit />
                                </div>
                                <div
                                    wire:click="confirmDelete({{$intensity->id }})"
                                    type="button"
                                    class="flex p-1 text-red-200 hover:text-red-500"
                                >
                                    <x-icon.trash />
                                </div>

                            </div>
                        </div>
                    </div>
                        @include('partials.training.confirm-intensity-delete-modal')
                    @endforeach
                </div>
            </div>
        </x-card.basic>
    </div>

    <div class="flex w-1/4 pl-6">
        <x-button.primary type="button" wire:click="showFormModal" class="h-10 justify-center bg-blue-800 hover:bg-blue-900">
            <x-icon.plus class="mr-2"/>
            Add a Training Intensity
        </x-button.primary>
        @include('partials.training.message')
    </div>
</div>






    @include('partials.training.intensity-form-modal')
</div>

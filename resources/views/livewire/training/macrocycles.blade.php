<div class="w-full">
    <x-slot name="breadcrumbs">
        <x-breadcrumb.back href="/training"/>
        <x-breadcrumb.menu>
            <x-breadcrumb.item href="/training" :leadingArrow="false">Training</x-breadcrumb.item>
            <x-breadcrumb.item href="/training/macrocycles">Training Cycles</x-breadcrumb.item>
        </x-breadcrumb.menu>
    </x-slot>
    <x-slot name="header">Training Cycles</x-slot>


    <x-tabs.menu active="Current">
        @if($macrocycles)
        <x-tabs.tab name="Current"><livewire:training.macrocycles-table :macrocycles="$macrocycles"/></x-tabs.tab>
        @endif
        <x-tabs.tab name="Archived">@livewire('training.run-types.steady-runs-table')</x-tabs.tab>
    </x-tabs.menu>

    <div class="flex w-full mb-12">
        <ul class="w-full grid grid-cols-1 gap-6 sm:grid-cols-1 lg:grid-cols-3">
            @if ($macrocycles->isNotEmpty())
                @foreach ($macrocycles as $macrocycle)

                    <li class="col-span-1 bg-white rounded-lg shadow-2xl divide-y divide-gray-200">
                        <div class="w-full flex items-center justify-between p-6 space-x-6">
                            <div class="flex-1 truncate">
                                <div class="flex items-center space-x-3">
                                    <h3 class="text-gray-900 text-sm font-medium truncate">
                                        <a href="/training/macrocycles/{{ $macrocycle->id }}">
                                            {{ $macrocycle->name }}
                                        </a>
                                    </h3>
                                    <span
                                            class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">Admin</span>
                                </div>
                                <p class="mt-2 text-gray-500 text-sm truncate">
                                    {{ $macrocycle->begin_date_for_humans }}
                                    -> {{ $macrocycle->end_date_for_humans }}
                                </p>
                            </div>
                            <x-dropdown.dropdown>
                                <x-slot name="trigger">
                                    <div class="text-gray-600">
                                        <x-icon.dots-vertical></x-icon.dots-vertical>
                                    </div>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown.link wire:click="edit({{$macrocycle->id}})">
                                        Edit
                                    </x-dropdown.link>
                                    <x-dropdown.link wire:click="confirmDelete({{ $macrocycle->id }})">
                                        Delete
                                    </x-dropdown.link>
                                </x-slot>
                            </x-dropdown.dropdown>
                        </div>
                        <div>
                            <div class="-mt-px flex divide-x divide-gray-200">
                                <div class="w-0 flex-1 flex">
                                    <div
                                            class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-2 border border-transparent rounded-bl-lg">

                                        <div class="flex text-cool-gray-600 items-center justify-around">
                                            <div class="flex text-xl">
                                                {{ $macrocycle->number_of_mesocycles }}
                                            </div>

                                            <div class="flex w-1/2 text-cool-gray-500 text-xs">
                                                @if ($macrocycle->number_of_mesocycles === 1)
                                                    Training Phase
                                                @else
                                                    Training Phases
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="-ml-px w-0 flex-1 flex">
                                    <div
                                            class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-2 border border-transparent rounded-bl-lg">

                                        <div class="flex text-cool-gray-600 items-center itemns-center justify-around">
                                            <div class="flex text-xl">
                                                {{ $macrocycle->number_of_weeks }}
                                            </div>

                                            <div class="flex w-1/2 text-cool-gray-500 text-xs">
                                                @if ($macrocycle->number_of_weeks === 1)
                                                    Total Week
                                                @else
                                                    Total Weeks
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach

            @else
                <li class="col-span-1 bg-white rounded-lg shadow justify-center">
                    <div class="w-full flex items-center p-6 space-x-6">
                        <div class="flex-1 truncate">
                            <div class="flex justify-center space-x-3">
                                <h3 class="text-gray-900">
                                    You have no Current Training Cycles
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center pb-4">
                        <x-button.primary wire:click="showCreateModal">
                            <x-icon.plus></x-icon.plus>

                            Create a Training Cycle
                        </x-button.primary>
                    </div>
                </li>
            @endif
        </ul>
        {{-- @include('partials.training.confirm-macrocycle-delete-modal') --}}
    </div>
    <div>
        @include('partials.training.create-macrocycle-modal')
    </div>

    @if($archivedMacrocycles)
        <div class="py-5">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Archived
            </h3>
        </div>

        <ul class="w-full grid grid-cols-1 gap-6 sm:grid-cols-1 lg:grid-cols-3">
            @foreach ($archivedMacrocycles as $macrocycle)

                <li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
                    <div class="w-full flex items-center justify-between p-6 space-x-6">
                        <div class="flex-1 truncate">
                            <div class="flex items-center space-x-3">
                                <h3 class="text-gray-900 text-sm font-medium truncate">
                                    <a href="/training/macrocycles/{{ $macrocycle->id }}">
                                        {{ $macrocycle->name }}
                                    </a>
                                </h3>
                                <span
                                        class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">Admin</span>
                            </div>
                            <p class="mt-2 text-gray-500 text-sm truncate">
                                {{ $macrocycle->begin_date_for_humans }}
                                -> {{ $macrocycle->end_date_for_humans }}
                            </p>
                        </div>
                        <x-dropdown.dropdown>
                            <x-slot name="trigger">
                                <div class="text-gray-600">
                                    <x-icon.dots-vertical></x-icon.dots-vertical>
                                </div>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown.link wire:click="edit({{$macrocycle->id}})">
                                    Edit
                                </x-dropdown.link>
                                <x-dropdown.link wire:click="confirmDelete({{ $macrocycle->id }})">
                                    Delete
                                </x-dropdown.link>
                            </x-slot>
                        </x-dropdown.dropdown>
                    </div>
                    <div>
                        <div class="-mt-px flex divide-x divide-gray-200">
                            <div class="w-0 flex-1 flex">
                                <div
                                        class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-2 border border-transparent rounded-bl-lg">

                                    <div class="flex text-cool-gray-600 items-center justify-around">
                                        <div class="flex text-xl">
                                            {{ $macrocycle->number_of_mesocycles }}
                                        </div>

                                        <div class="flex w-1/2 text-cool-gray-500 text-xs">
                                            @if ($macrocycle->number_of_mesocycles === 1)
                                                Training Phase
                                            @else
                                                Training Phases
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="-ml-px w-0 flex-1 flex">
                                <div
                                        class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-2 border border-transparent rounded-bl-lg">

                                    <div class="flex text-cool-gray-600 items-center itemns-center justify-around">
                                        <div class="flex text-xl">
                                            {{ $macrocycle->number_of_weeks }}
                                        </div>

                                        <div class="flex w-1/2 text-cool-gray-500 text-xs">
                                            @if ($macrocycle->number_of_weeks === 1)
                                                Total Week
                                            @else
                                                Total Weeks
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

    @endif


    <x-slot name="aside">
    </x-slot>


</div>

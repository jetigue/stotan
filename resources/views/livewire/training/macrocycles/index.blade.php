<div class="w-full">

    <x-slot name="breadcrumbs">
        <x-breadcrumb.back href="/training"/>
        <x-breadcrumb.menu>
            <x-breadcrumb.item href="/training" :leadingArrow="false">Training</x-breadcrumb.item>
            <x-breadcrumb.item href="/training/macrocycles">Training Cycles</x-breadcrumb.item>
        </x-breadcrumb.menu>
    </x-slot>

    <x-slot name="header">Training Cycles</x-slot>

    <div class="relative w-full">

        <x-tabs.menu active="Current">
                <x-tabs.tab name="Current">
                    @if(count($macrocycles) >0)
                        <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach($macrocycles as $macrocycle)
                                    <livewire:training.macrocycles.macrocycle-card
                                        :macrocycle="$macrocycle"
                                        :key="$macrocycle->id" />
                                @endforeach

                            <li
                                wire:click="showCreateModal"
                                class="col-span-1 bg-white rounded-lg shadow border-2 border-white hover:border-indigo-500 opacity-50 hover:opacity-100">
                                <div class="flex h-full items-center text-indigo-500 space-x-6 px-6">
                                    <x-icon.plus class="w-16 h-16" />
                                    <div class="text-2xl">Add a Training Cycle</div>
                                </div>
                            </li>
                        </ul>
                    @else
                        <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            <li
                                wire:click="showCreateModal"
                                class="col-span-1 bg-white rounded-lg shadow border-2 border-white cursor-pointer hover:border-indigo-500 opacity-50 hover:opacity-100">
                                <div class="flex h-full items-center text-indigo-500 space-x-6 px-6">
                                    <x-icon.plus class="w-16 h-16" />
                                    <div class="text-2xl">Add a Training Cycle</div>
                                </div>
                            </li>
                        </ul>
                    @endif
                </x-tabs.tab>
            @if($archivedMacrocycles->isNotEmpty())
            <x-tabs.tab name="Archived">
                <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($archivedMacrocycles as $macrocycle)
                        <div>{{ $macrocycle->name }}</div>
                    @endforeach
                </ul>
            </x-tabs.tab>
            @endif
        </x-tabs.menu>
    </div>
    @include('partials.training.macrocycle-form-modal')
    @include('partials.training.macrocycles.confirm-macrocycle-delete-modal')
</div>


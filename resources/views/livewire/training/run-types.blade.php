<div class="w-full min-h-full">
    <x-slot name="breadcrumbs">
        <x-breadcrumb.back href="/training"/>
        <x-breadcrumb.menu>
            <x-breadcrumb.item href="/training" :leadingArrow="false">Training</x-breadcrumb.item>
            <x-breadcrumb.item href="/training/run-types">Run Types</x-breadcrumb.item>
        </x-breadcrumb.menu>
    </x-slot>

    <x-slot name="header">Run Types</x-slot>

    <x-tabs.menu active="Intermittent Runs">
        <x-tabs.tab name="Intermittent Runs">@livewire('training.run-types.intermittent-runs-table')</x-tabs.tab>
        <x-tabs.tab name="Steady Runs">@livewire('training.run-types.steady-runs-table')</x-tabs.tab>
        <x-tabs.tab name="Progressive Runs">@livewire('training.run-types.progressive-runs-table')</x-tabs.tab>
    </x-tabs.menu>

    <x-slot name="aside"></x-slot>

</div>

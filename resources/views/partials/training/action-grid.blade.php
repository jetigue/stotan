<x-grid.action-container>
    <x-grid.action-item
            title="Training Cycles"
            href="/training/macrocycles"
            iconBackground="green"
            class="rounded-tl-lg rounded-tr-lg sm:rounded-tr-none"
    >
        <x-slot name="icon">
            <x-icon.calendar class="text-green-100"/>
        </x-slot>

        <x-slot name="content">
            Create or view the training cycles for your team.
        </x-slot>
    </x-grid.action-item>

    <x-grid.action-item
            title="Run Types"
            href="/training/run-types"
            iconBackground="darkblue"
            class="sm:rounded-tr-lg"
    >
        <x-slot name="icon">
            <x-icon.collection class="text-blue-100" />
        </x-slot>

        <x-slot name="content">
            View, Create, and Edit the types of runs used in your training program.
        </x-slot>
    </x-grid.action-item>

    <x-grid.action-item
            title="Take Some Time"
            href="#"
            iconBackground="#73000a"
    >
        <x-slot name="icon">
            <x-icon.home class="text-blue-50"/>
        </x-slot>

        <x-slot name="content">
            This is the content for the 3rd card
        </x-slot>
    </x-grid.action-item>

    <x-grid.action-item
            title="Take Some Time"
            href="#"
            iconBackground="#73000a">

        <x-slot name="icon">
            <x-icon.home class="text-blue-50"/>
        </x-slot>

        <x-slot name="content">
            This is the content for the 4th card
        </x-slot>

    </x-grid.action-item>

    <x-grid.action-item
            title="Take Some Time"
            href="#"
            iconBackground="#73000a"
            class="sm:rounded-bl-lg">

        <x-slot name="icon">
            <x-icon.home class="text-blue-50"/>
        </x-slot>

        <x-slot name="content">
            This is the content for the 4th card
        </x-slot>

    </x-grid.action-item>

    <x-grid.action-item
            title="Take Some Time"
            href="#"
            iconBackground="#73000a"
            class="rounded-bl-lg rounded-br-lg sm:rounded-bl-none">

        <x-slot name="icon">
            <x-icon.home class="text-blue-50"/>
        </x-slot>

        <x-slot name="content">
            This is the content for the 4th card
        </x-slot>

    </x-grid.action-item>

</x-grid.action-container>

<x-modal.dialog wire:model.defer="showCreateModal">
    <x-slot name="title">
        <div x-data="{editing: @entangle('editing')}">
            <span x-show="editing === true">Edit Macrocycle</span>
            <span x-show="editing === false">Create a Macrocycle</span>
        </div>


    </x-slot>

    <x-slot name="content">
        @livewire('training.macrocycle-form')
    </x-slot>

    <x-slot name="footer">
        <div x-data="{editing: @entangle('editing')}">
            <x-button.secondary wire:click="cancel">Cancel</x-button.secondary>
            <x-button.primary wire:click="$emit('submitCreate')">
                <span x-show="editing === true">Save</span>
                <span x-show="editing === false">Create</span>
            </x-button.primary>
        </div>

    </x-slot>
</x-modal.dialog>

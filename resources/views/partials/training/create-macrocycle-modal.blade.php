<x-modal.dialog wire:model.defer="showCreateModal">
    <x-slot name="title">
        <div>
            <span>Edit Macrocycle</span>
            <span>Create a Macrocycle</span>
        </div>


    </x-slot>

    <x-slot name="content">
        @livewire('training.macrocycle-form')
    </x-slot>

    <x-slot name="footer">
        <div>
            <x-button.secondary wire:click="cancel">Cancel</x-button.secondary>
            <x-button.primary wire:click="$emit('submitCreate')">
                <span>Save</span>
                <span>Create</span>
            </x-button.primary>
        </div>

    </x-slot>
</x-modal.dialog>

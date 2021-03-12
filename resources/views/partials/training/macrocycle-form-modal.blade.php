<x-modal.dialog wire:model.defer="showFormModal">
    <x-slot name="title">
        <div x-data="{editing: @entangle('editing')}">
            <div x-show="editing">Edit Macrocycle</div>
            <div x-show="!editing">Create a Macrocycle</div>
        </div>
    </x-slot>

    <x-slot name="content">
        <livewire:training.macrocycles.macrocycle-form />
    </x-slot>

    <x-slot name="footer">
        <div x-data="{editing: @entangle('editing')}">
            <x-button.secondary wire:click="cancel">Cancel</x-button.secondary>
            <x-button.primary wire:click="$emit('submitCreate')">
                <div x-show="editing">Save</div>
                <div x-show="!editing">Create</div>
            </x-button.primary>
        </div>
    </x-slot>
</x-modal.dialog>

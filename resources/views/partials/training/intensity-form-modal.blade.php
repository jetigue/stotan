<x-modal.dialog wire:model="showFormModal">
    <x-slot name="title">
        <div x-data="{editing: @entangle('editing')}">
            <span x-show="editing === true">Edit Training Intensity</span>
            <span x-show="editing === false">Create a Training Intensity</span>
        </div>
    </x-slot>

    <x-slot name="content">
        @livewire('training.training-intensity-form')
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

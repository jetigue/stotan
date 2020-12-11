<x-modal.confirmation wire:model.defer="showConfirmModal">
    <x-slot name="title">Delete Training Cycle?</x-slot>
    <x-slot name="content">Are you sure you want to delete this training cycle This cannot be
        undone.
    </x-slot>
    <x-slot name="footer">
        <x-button.secondary wire:click="$toggle('showConfirmModal')">Cancel</x-button.secondary>
        <x-button.danger wire:click="destroy({{ $macrocycle->id }})">Yes, Delete Training Cycle
        </x-button.danger>
    </x-slot>
</x-modal.confirmation>

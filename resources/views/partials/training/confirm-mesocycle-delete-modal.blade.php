<x-modal.confirmation wire:model.defer="showConfirmModal">
    <x-slot name="title">Delete Training Phase?</x-slot>
    <x-slot name="content">Are you sure you want to delete this training phase? This cannot be
        undone.
    </x-slot>
    <x-slot name="footer">
        <x-button.secondary wire:click="$toggle('showConfirmModal')">Cancel</x-button.secondary>
        <x-button.danger wire:click="destroy({{ $mesocycle->id }})">Yes, Delete Training Phase
        </x-button.danger>
    </x-slot>
</x-modal.confirmation>

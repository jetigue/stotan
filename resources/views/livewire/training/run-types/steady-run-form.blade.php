<div>
    <x-form wire:submit.prevent="submitForm" action="/steady-runs">
            <x-input.group for="name" label="Name" :error="$errors->first('name')">
                <x-input.text wire:model.defer="name" id="name" placeholder="ex. Long Run"></x-input.text>
            </x-input.group>

            <x-input.group for="description" label="Description" :error="$errors->first('description')">
                <x-input.textarea
                    wire:model="description"
                    id="description"
                ></x-input.textarea>
            </x-input.group>
    </x-form>
</div>

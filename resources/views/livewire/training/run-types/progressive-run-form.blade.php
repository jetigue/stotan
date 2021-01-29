<div>
    <x-form wire:submit.prevent="submitForm" action="/progressive-runs">
            <x-input.group for="name" label="Name" :error="$errors->first('name')">
                <x-input.text wire:model.defer="name" id="progressiveRunName" placeholder="ex. Kenyan Fartlek"></x-input.text>
            </x-input.group>

            <x-input.group for="progressiveRunDescription" label="Description" :error="$errors->first('description')">
                <x-input.textarea
                    wire:model="description"
                    id="progressiveRunDescription"
                ></x-input.textarea>
            </x-input.group>
    </x-form>
</div>

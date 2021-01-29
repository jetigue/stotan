<div>
    <x-form wire:submit.prevent="submitForm" action="/intermittent-runs">
            <x-input.group for="intermittentRunName" label="Name" :error="$errors->first('name')">
                <x-input.text
                    wire:model.defer="name"
                    id="intermittentRunName"
                    placeholder="ex. Fartlek">
                </x-input.text>
            </x-input.group>

            <x-input.group for="intermittentRunDescription" label="Description" :error="$errors->first('description')">
                <x-input.textarea
                    wire:model="description"
                    id="intermittentRunDescription"
                ></x-input.textarea>
            </x-input.group>
    </x-form>
</div>

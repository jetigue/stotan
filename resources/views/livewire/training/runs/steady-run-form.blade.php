<div>
    <x-form wire:submit.prevent="submitForm" action="/runs/steady-runs">
            <x-input.group for="steadyRunName" label="Name" :error="$errors->first('name')">
                <x-input.text wire:model.defer="name" id="steadyRunName" placeholder="ex. Long Run"></x-input.text>
            </x-input.group>

            <x-input.group for="steadyRunDescription" label="Description" :error="$errors->first('description')">
                <x-input.textarea
                    wire:model="description"
                    id="steadyRunDescription"
                ></x-input.textarea>
            </x-input.group>
    </x-form>
</div>

<div>
    <x-form wire:submit.prevent="submitForm" action="/training/intensities">

        <x-input.group for="name" label="Name" :error="$errors->first('name')">
            <x-input.text wire:model.defer="name"></x-input.text>
        </x-input.group>

        <x-input.group for="percentVO2Max" label="Percent VO2 Max" :error="$errors->first('percentVO2Max')">
            <x-input.text wire:model.defer="percentVO2Max"></x-input.text>
        </x-input.group>

        <x-input.group for="percentMaxHR" label="Percent Max HR" :error="$errors->first('percentMaxHR')">
            <x-input.text wire:model.defer="percentMaxHR"></x-input.text>
        </x-input.group>

        <x-input.group for="jd_points" label="Daniel's Formula Points (x1000)" :error="$errors->first('jd_points')">
            <x-input.text wire:model.defer="jd_points"></x-input.text>
        </x-input.group>

        <x-input.group for="description" label="Description" :error="$errors->first('description')">
            <x-input.textarea
                wire:model="description"
                id="description"
            ></x-input.textarea>
        </x-input.group>

        <x-input.group for="purpose" label="Purpose" :error="$errors->first('purpose')">
            <x-input.textarea
                wire:model="purpose"
                id="purpose"
            ></x-input.textarea>
        </x-input.group>
    </x-form>
</div>

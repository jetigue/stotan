<div>
    <x-form wire:submit.prevent="submitForm" action="/macrocycles">
            <x-input.group for="name" label="Name" :error="$errors->first('name')">
                <x-input.text wire:model.defer="name" id="name" placeholder="ex. Cross Country 2021"></x-input.text>
            </x-input.group>

            <x-input.group for="begin_date" label="Begins" :error="$errors->first('begin_date')">
                <x-input.date
                    wire:model="begin_date"
                    id="begin_date"
                    placeholder="MM/DD/YYYY"
                ></x-input.date>
            </x-input.group>

            <x-input.group for="end_date" label="Ends" :error="$errors->first('end_date')">
                <x-input.date
                    wire:model="end_date"
                    id="end_date"
                    placeholder="MM/DD/YYYY"
                >
                </x-input.date>
            </x-input.group>
    </x-form>
</div>

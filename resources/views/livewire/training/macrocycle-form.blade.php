<div>
    <x-form wire:submit.prevent="submitForm" action="/macrocycles">
            <x-input.group for="name" label="Name" :error="$errors->first('name')">
                <x-input.text wire:model.defer="name" id="name" placeholder="ex. Cross Country 2021"></x-input.text>
            </x-input.group>

            <x-input.group for="begin_date_for_editing" label="Begins" :error="$errors->first('begin_date_for_editing')">
                <x-input.date
                    wire:model="begin_date_for_editing"
                    id="begin_date_for_editing"
                    placeholder="MM/DD/YYYY"
                ></x-input.date>
            </x-input.group>

            <x-input.group for="end_date_for_editing" label="Ends" :error="$errors->first('end_date_for_editing')">
                <x-input.date
                    wire:model="end_date_for_editing"
                    id="end_date"
                    placeholder="MM/DD/YYYY"
                >
                </x-input.date>
            </x-input.group>
    </x-form>
</div>

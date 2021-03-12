<div>
    <x-form wire:submit.prevent="submitForm" action="/runs/warm-ups">
        <div class="space-y-4">
            <x-input.group for="duration" label="Duration"
                           :error="$errors->first('duration')"
            >
                <x-input.text wire:model.defer="duration" />
                <span x-slot name="trailingDropDown">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                        <label for="duration_unit" class="sr-only">Duration Unit</label>
                        <select wire:model="duration_unit"
                                class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                        >
                            <option value="minutes">Minutes</option>
                            <option value="meters">Meters</option>
                            <option value="miles">Miles</option>
                        </select>
                    </div>
                </span>
            </x-input.group>

            <x-input.group for="training_session" label="Training Session" :error="$errors->first('training_session')">
               <x-input.select wire:model="training_session">
                   <option value="primary">Primary</option>
                   <option value="secondary">Secondary</option>
               </x-input.select>
            </x-input.group>
        </div>

    </x-form>
</div>

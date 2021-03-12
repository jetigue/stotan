<div x-data="{ showInputs: @entangle('showSetRecoveryInputs').defer }">

    <x-form wire:submit.prevent="submitForm" action="/runs/intermittent-runs">

        <x-input.group for="IntermittentRunType" label="Run Type" :error="$errors->first('intermittent_run_type_id')">
           <x-input.select wire:model="intermittent_run_type_id">
               <option value="">Choose a run type...</option>
                @foreach($intermittentRunTypes as $intermittentRunType)
                    <option value="{{ $intermittentRunType->id }}">
                        {{ $intermittentRunType->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>

        <div class="flex w-full">
            <div class="w-1/2 pr-2">
                <x-input.group for="numberSets" label="Number of Sets" :error="$errors->first('number_sets')">
                    <x-input.text wire:model="number_sets" type="number"></x-input.text>
                </x-input.group>
            </div>
            <div class="w-1/2 pl-2">
                <x-input.group for="numberReps" label="Number of Repeats" :error="$errors->first('number_repetitions')">
                    <x-input.text wire:model.defer="number_repetitions" type="number"></x-input.text>
                </x-input.group>
            </div>
        </div>

        <div class="flex w-full">
            <div class="w-1/2 pr-2">
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
                                <option value="seconds">Seconds</option>
                                <option value="meters">Meters</option>
                                <option value="miles">Miles</option>
                            </select>
                        </div>
                    </span>
                </x-input.group>
            </div>
            <div class="w-1/2 pl-2">
                <x-input.group for="trainingIntensity" label="Intensity (Pace)" :error="$errors->first('training_intensity_id')">
                   <x-input.select wire:model="training_intensity_id">
                       <option value=""></option>
                        @foreach($trainingIntensities as $intensity)
                            <option value="{{ $intensity->id }}">
                                {{ $intensity->name }}
                            </option>
                        @endforeach
                   </x-input.select>
                </x-input.group>
            </div>
        </div>

        <div class="flex w-full">
            <div class="w-1/2 pr-2">
                <x-input.group for="recovery" label="Duration of Recovery"
                               :error="$errors->first('recovery')"
                >
                    <x-input.text wire:model.defer="recovery" />
                    <span x-slot name="trailingDropDown">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <label for="recovery_unit" class="sr-only">Recovery Unit</label>
                            <select wire:model="recovery_unit"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                            >
                                <option value="minutes">Minutes</option>
                                <option value="seconds">Seconds</option>
                                <option value="meters">Meters</option>
                                <option value="miles">Miles</option>
                            </select>
                        </div>
                    </span>
                </x-input.group>
            </div>

            <div class="w-1/2 pl-2">
                <x-input.group for="recoveryType" label="Recovery Type" :error="$errors->first('recovery_type')">
                   <x-input.select wire:model="recovery_type">
                       <option value=""></option>
                       <option value="jog">Jog</option>
                       <option value="walk">Walk</option>
                       <option value="rest">Rest</option>
                   </x-input.select>
                </x-input.group>
            </div>
        </div>

        <div x-show="showInputs" class="flex w-full">
            <div class="w-1/2 pr-2">
                <x-input.group for="set_duration" label="Recovery Between Sets"
                               :error="$errors->first('set_recovery')"
                >
                    <x-input.text wire:model.defer="set_recovery" />
                    <span x-slot name="trailingDropDown">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <label for="set_recovery_unit" class="sr-only">Recovery Unit</label>
                            <select wire:model="set_recovery_unit"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                            >
                                <option value="minutes">Minutes</option>
                                <option value="seconds">Seconds</option>
                                <option value="meters">Meters</option>
                                <option value="miles">Miles</option>
                            </select>
                        </div>
                    </span>
                </x-input.group>
            </div>

            <div class="w-1/2 pl-2">
                <x-input.group for="setRecoveryType" label="Set Recovery Type" :error="$errors->first('set_recovery_type')">
                   <x-input.select wire:model="set_recovery_type">
                       <option value=""></option>
                       <option value="jog">Jog</option>
                       <option value="walk">Walk</option>
                       <option value="rest">Rest</option>
                   </x-input.select>
                </x-input.group>
            </div>
        </div>



        <x-input.group for="training_session" label="Training Session" :error="$errors->first('training_session')">
           <x-input.select wire:model="training_session">
               <option value="primary">Primary</option>
               <option value="secondary">Secondary</option>
           </x-input.select>
        </x-input.group>

        <x-input.group for="intermittentRunNotes" label="Notes (optional)" :error="$errors->first('notes')">
            <x-input.textarea
                wire:model="notes"
            ></x-input.textarea>
        </x-input.group>

    </x-form>
</div>

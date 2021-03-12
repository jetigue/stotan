<div x-data="{ reveal: @entangle('showEditAndDelete').defer }"
     class="w-full cursor-pointer flex hover:bg-gray-50 px-2 rounded items-center my-2">
<div class="flex flex-col w-full">
    <div class="flex w-full justify-between">
        <div @click="reveal=true" class="flex w-4/5">
            <div class="flex w-1/4 text-gray-600 font-medium">
                {{ $intermittentRun->runType->name }}:
            </div>
            <div class="flex flex-col font-medium">
                <div>
                    {{ $intermittentRun->number_sets }}
                    <span class="text-gray-400">
                        set(s) of
                    </span>
                </div>
                <div class="flex space-x-1">
                    <span>{{ $intermittentRun->duration }} {{ $intermittentRun->duration_unit }}</span>
                    <span class="text-gray-400">@</span>
                    <span>{{ $intermittentRun->intensity->name }}</span>
                    <span class="text-gray-400">pace</span>
                </div>
                <div class="flex space-x-1">
                    <span class="text-gray-400">with</span>
                    <span class="flex">{{ $intermittentRun->recovery }} {{ $intermittentRun->recovery_unit }} {{ $intermittentRun->recovery_type }}</span>
                    <span class="text-gray-400">recovery</span>
                </div>
                @if ($intermittentRun->number_sets > 1)
                    <div class="flex space-x-1">
                        <span class="text-gray-400">with</span>
                        <span class="flex">{{ $intermittentRun->set_recovery }} {{ $intermittentRun->set_recovery_unit }} {{ $intermittentRun->set_recovery_type }}</span>
                        <span class="text-gray-400">between sets</span>
                    </div>
                @endif
            </div>
        </div>

        <div x-show="reveal" @click.away="reveal=false"
             class="flex space-x-2">
            <div class="" wire:click="editIntermittentRun({{ $intermittentRun->id }})">
                <x-icon.edit/>
            </div>

            <div wire:click="destroyIntermittentRun({{ $intermittentRun->id }})" class="">
                <x-icon.trash/>
            </div>
        </div>
    </div>
    <div x-show="reveal" class="flex italic text-gray-500">
        <div class="w-1/5"></div>
        {{ $intermittentRun->notes }}
    </div>
    </div>
</div>

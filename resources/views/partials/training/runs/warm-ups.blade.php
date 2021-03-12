<div x-data="{ reveal: @entangle('showEditAndDelete').defer }"
     class="w-full cursor-pointer flex hover:bg-gray-50 px-2 rounded items-center my-2">
    <div class="flex flex-col w-full">
        <div class="flex w-full justify-between">
            <div @click="reveal=true" class="flex w-4/5">
                <div class="flex w-1/4 text-gray-600 font-medium">
                    Warm-up:
                </div>

                <div class="flex font-medium">
                    {{ $warmUp->duration}} {{ $warmUp->duration_unit }}
                </div>
            </div>

            <div x-show="reveal" @click.away="reveal=false"
                 class="flex items-center space-x-2">
                <div class="px-1" wire:click="editWarmUp({{ $warmUp->id }})">
                    <x-icon.edit/>
                </div>
                <div wire:click="destroySteadyRun({{ $warmUp->id }})" class="">
                    <x-icon.trash/>
                </div>
            </div>
        </div>
        <div x-show="reveal" class="flex text-xs text-indigo-500 w-full justify-end">
            <div class="flex w-4/5 px-2 space-x-4">
                <span>{{ $warmUp->duration_in_h_m }}</span>
                <span>{{ $warmUp->miles }}</span>
                <span>{{ $warmUp->points }}</span>
            </div>
        </div>
    </div>
</div>

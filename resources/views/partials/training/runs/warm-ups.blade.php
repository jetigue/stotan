<div x-data="{ reveal: @entangle('showEditAndDelete').defer }"

     class="w-full cursor-pointer flex hover:bg-gray-50 px-4 py-2 rounded items-center">
    <div class="flex flex-col w-full">
        <div class="flex w-full justify-between">
            <div @click="reveal=true" class="flex w-4/5">
                <div class="flex w-1/3 text-gray-500">
                    Warm-up:
                </div>

                <div class="flex font-medium">
                    <span>
                        @switch ($warmUp->duration_unit)
                            @case('minutes')
                            {{ $warmUp->duration }} min
                             @break;
                            @case('meters')
                             {{ $warmUp->duration }} m
                            @break;
                            @case('miles')
                            {{ $warmUp->duration }} mi
                            @break;
                            @case('seconds')
                            {{ $warmUp->duration }} sec
                            @break;
                        @endswitch
                    </span>
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
        <div x-show="reveal" class="flex w-4/5 text-xs text-indigo-500 w-full justify-end">
            <div class="flex w-3/4 space-x-4 px-2">
                @unless($warmUp->duration_unit === 'minutes')
                    <span>{{ $warmUp->duration_in_h_m }}</span>
                @endunless
                @unless($warmUp->duration_unit === 'miles')
                    <span>{{ $warmUp->miles }} mi</span>
                @endunless
                <span>{{ $warmUp->points }} pts</span>
            </div>
        </div>
    </div>
</div>

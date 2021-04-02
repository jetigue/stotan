<div x-data="{ reveal: @entangle('showEditAndDelete').defer }"

     class="w-full cursor-pointer flex hover:bg-gray-50 px-4 py-2 rounded items-center">
    <div class="flex flex-col w-full">
        <div class="flex w-full justify-between">
            <div @click="reveal=true" class="flex w-4/5">
                <div class="flex w-1/3 text-gray-600 font-medium">
                    {{ $steadyRun->runType->name }}:
                </div>
                <div class="flex font-medium">
                    <span>
                        @switch ($steadyRun->duration_unit)
                            @case('minutes')
                            {{ $steadyRun->duration }} min
                             @break;
                            @case('meters')
                             {{ $steadyRun->duration }} m
                            @break;
                            @case('miles')
                            {{ $steadyRun->duration }} mi
                            @break;
                            @case('seconds')
                            {{ $steadyRun->duration }} sec
                            @break;
                        @endswitch
                    </span>
                    <span class="text-gray-400 px-1">@</span>
                    <span>{{ $steadyRun->intensity->name }}</span>
                    <span class="text-gray-400 px-1">pace</span>
                </div>
            </div>

            <div x-show="reveal" @click.away="reveal=false"
                 class="flex items-center space-x-2">
                <div class="px-1" wire:click="editSteadyRun({{ $steadyRun->id }})">
                    <x-icon.edit/>
                </div>

                <div wire:click="destroySteadyRun({{ $steadyRun->id }})" class="">
                    <x-icon.trash/>
                </div>
            </div>
        </div>
        <div x-show="reveal" class="flex w-4/5 text-xs text-indigo-500 w-full justify-end">
            <div class="flex flex-col w-3/4 px-2">
                <div class="italic text-gray-500 pr-8">{{ $steadyRun->notes }}</div>
                <div class="flex space-x-4">
                    @unless($steadyRun->duration_unit === 'minutes')
                        <span>{{ $steadyRun->duration_in_h_m }}</span>
                    @endunless
                    @unless($steadyRun->duration_unit === 'miles')
                        <span>{{ $steadyRun->miles }} mi</span>
                    @endunless
                    <span>{{ $steadyRun->points }} pts</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div x-data="{ reveal: @entangle('showEditAndDelete').defer }"
     class="w-full cursor-pointer flex hover:bg-gray-50 px-4 py-2 rounded items-center">
<div class="flex flex-col w-full">
    <div class="flex w-full justify-between">
        <div @click="reveal=true" class="flex w-4/5">
            <div class="flex w-1/3 text-gray-600 font-medium">
                {{ $intermittentRun->runType->name }}:
            </div>
            <div class="flex flex-col font-medium">
               <div class="flex space-x-1">
                   @if ($intermittentRun->number_sets > 1)
                    <span>{{ $intermittentRun->number_sets }}</span>
                    <span class="text-gray-400">
                        @if ($intermittentRun->number_sets === 1)
                            set of
                        @else
                            sets of
                        @endif
                    </span>
                   @endif

                    <span>{{ $intermittentRun->number_repetitions }}</span>
                    <span class="text-gray-400">
                        x
                    </span>
                       <span>
                           @switch ($intermittentRun->duration_unit)
                               @case('minutes')
                               {{ $intermittentRun->duration }} min
                                @break;
                               @case('meters')
                                {{ $intermittentRun->duration }} m
                               @break;
                               @case('miles')
                               {{ $intermittentRun->duration }} mi
                               @break;
                               @case('seconds')
                               {{ $intermittentRun->duration }} sec
                               @break;
                           @endswitch
                       </span>
                    <span class="text-gray-400">@</span>
                    <span>{{ $intermittentRun->intensity->initials }}</span>
                    <span class="text-gray-400">pace</span>
                </div>
                <div class="flex space-x-1">
                    <span class="text-gray-400">with a</span>
                    <span>
                    @switch ($intermittentRun->recovery_unit)
                        @case('minutes')
                        {{ $intermittentRun->recovery }} min
                         @break;
                        @case('meters')
                         {{ $intermittentRun->recovery }} m
                        @break;
                        @case('miles')
                        {{ $intermittentRun->recovery }} mi
                        @break;
                        @case('seconds')
                        {{ $intermittentRun->recovery }} sec
                        @break;
                    @endswitch
                    </span>
                    <span class="flex">{{ $intermittentRun->recovery_type }}</span>
                    <span class="text-gray-400">recovery</span>
                </div>
                @if ($intermittentRun->number_sets > 1)
                    <div class="flex space-x-1">
                        <span class="text-gray-400">with a</span>
                        <span>
                        @switch ($intermittentRun->set_recovery_unit)
                            @case('minutes')
                            {{ $intermittentRun->set_recovery }} min
                             @break;
                            @case('meters')
                             {{ $intermittentRun->set_recovery }} m
                            @break;
                            @case('miles')
                            {{ $intermittentRun->set_recovery }} mi
                            @break;
                            @case('seconds')
                            {{ $intermittentRun->set_recovery }} sec
                            @break;
                        @endswitch
                        </span>
                        <span class="flex">{{ $intermittentRun->set_recovery_type }}</span>
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
    <div x-show="reveal" class="flex w-4/5 text-xs text-indigo-500 w-full justify-end">
        <div class="flex flex-col w-3/4 px-2">
            <div class="italic text-gray-500 pr-8">{{ $intermittentRun->notes }}</div>
            <div class="flex space-x-4">
                <span>{{ $intermittentRun->duration_in_h_m }} ({{ $intermittentRun->duration_at_target_intensity }} @ {{ $intermittentRun->intensity->initials }} pace)</span>

                <span>{{ $intermittentRun->total_miles}} mi ({{ $intermittentRun->miles_at_target_intensity }} mi @ {{ $intermittentRun->intensity->initials }} pace)</span>

                <span>{{ $intermittentRun->points }} pts</span>
            </div>
        </div>
    </div>
    </div>
</div>

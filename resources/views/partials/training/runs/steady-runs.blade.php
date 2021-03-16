<div x-data="{ reveal: @entangle('showEditAndDelete').defer }"

     class="w-full cursor-pointer flex hover:bg-gray-50 px-2 rounded items-center my-2">
    <div class="flex flex-col w-full">
        <div class="flex w-full justify-between">
            <div @click="reveal=true" class="flex w-4/5">
                <div class="flex w-1/4 text-gray-600 font-medium">
                    {{ $steadyRun->runType->name }}:
                </div>
                <div class="flex font-medium">
                    {{ $steadyRun->duration}} {{ $steadyRun->duration_unit }} <span
                        class="text-gray-400 px-1">@</span> {{ $steadyRun->intensity->name }} <span
                        class="text-gray-400 px-1">pace</span>
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
        <div x-show="reveal" class="flex flex-col text-xs text-indigo-500 w-full justify-end items-end">
            <div class="flex w-4/5 px-2 space-x-4">
                <span>{{ $steadyRun->duration_in_h_m }}</span>
                <span>{{ $steadyRun->miles }}</span>
                <span>{{ $steadyRun->points }}</span>
            </div>

            <div class="flex w-4/5 px-2 text-gray-500">
                {{ $steadyRun->notes }}
            </div>
        </div>
    </div>
</div>

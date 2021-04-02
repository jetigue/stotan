<div x-data="{ reveal: @entangle('showEditAndDelete').defer }"
     class="w-full cursor-pointer flex hover:bg-gray-50 px-2 rounded items-center my-2">
<div class="flex flex-col w-full">
    <div class="flex w-full justify-between">
        <div @click="reveal=true" class="flex w-4/5">
            <div class="flex w-1/4 text-gray-600 font-medium">
                {{ $progressiveRun->runType->name }}:
            </div>
            <div class="flex flex-col font-medium">
                <div class="flex space-x-1">
                    <span>{{ $progressiveRun->duration }} {{ $progressiveRun->duration_unit }}</span>
                    <span class="text-gray-400">Run</span>
                </div>
                <div class="flex space-x-1">
                    <span class="text-gray-400">starting @</span>
                    <span class="flex">{{ $progressiveRun->startingIntensity->name }} pace</span>
                </div>
                <div class="flex space-x-1">
                    <span class="text-gray-400">and finishing @</span>
                    <span class="flex">{{ $progressiveRun->finalIntensity->name }} pace</span>
                </div>
                <div class="flex space-x-1">
                    <span class="text-gray-400">drop the pace</span>
                    <span class="flex">every {{ $progressiveRun->progression_interval }} {{ $progressiveRun->progression_interval_unit }}</span>
                </div>
            </div>
        </div>

        <div x-show="reveal" @click.away="reveal=false" class="flex space-x-2">
            <div class="" wire:click="editProgressiveRun({{ $progressiveRun->id }})">
                <x-icon.edit/>
            </div>

            <div wire:click="destroyProgressiveRun({{ $progressiveRun->id }})" class="">
                <x-icon.trash/>
            </div>
        </div>
    </div>
    <div x-show="reveal" class="flex italic text-gray-500">
        <div class="w-1/5"></div>
        <div class="flex w-4/5 px-2 space-x-4">
            <span>{{ $progressiveRun->progression_in_h_m }}</span>
            <span>{{ $progressiveRun->starting_intensity_percentage }}</span>
            <span>{{ $progressiveRun->total_points }}</span>
        </div>
        {{ $progressiveRun->notes }}
    </div>
    </div>
</div>

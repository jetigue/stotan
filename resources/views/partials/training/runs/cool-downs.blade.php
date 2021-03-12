<div x-data="{ reveal: @entangle('showEditAndDelete').defer }"
     class="w-full cursor-pointer flex justify-between hover:bg-gray-50 px-2 rounded items-center"
>
    <div @click="reveal=true" class="flex w-4/5">
        <div class="flex w-1/4 text-gray-400">
            Cool-down:
        </div>
        <div class="flex font-medium">
            {{ $coolDown->duration}} {{ $coolDown->duration_unit }}
        </div>
    </div>

    <div x-show="reveal" @click.away="reveal=false"
         class="flex items-center space-x-2">
        <div class="px-1" wire:click="editCoolDown({{ $coolDown->id }})">
            <x-icon.edit/>
        </div>
        <div wire:click="destroySteadyRun({{ $coolDown->id }})" class="">
            <x-icon.trash/>
        </div>
    </div>
</div>

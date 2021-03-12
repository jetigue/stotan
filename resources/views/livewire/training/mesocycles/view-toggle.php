<div
    x-data="{ isOn: @entangle('showCalendar') }"
    class="flex justify-end text-gray-300"
>
    <span :class="{'text-gray-700': !isOn}">Calendar</span>
    <button
            type="button"
            wire:click="toggleView"
            @click="isOn = !isOn"
            aria-pressed="false"
            class="relative inline-flex flex-shrink-0 w-10 h-5 mx-2 transition-colors duration-200 ease-in-out bg-black border-2 border-transparent rounded-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
        <span class="sr-only">Use setting</span>
        <span
                :class="{'translate-x-5': isOn, 'translate-x-0': !isOn}"
                aria-hidden="true"
                class="inline-block w-4 h-4 transition duration-200 ease-in-out transform translate-x-0 bg-white rounded-full shadow ring-0"></span>
    </button>
    <span :class="{'text-gray-700': isOn}">Table View</span>
</div>

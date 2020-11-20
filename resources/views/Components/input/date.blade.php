
<div
        x-data="{ value: @entangle($attributes->wire('model')) }"
        x-init="new Pikaday({
            field: $refs.input,
            format: 'MM/DD/YYYY',
                toString(date, format) {
                const month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : '' + (date.getMonth() + 1);
                const day = date.getDate() < 10 ? '0' + date.getDate() : '' + date.getDate();
                const year = date.getFullYear();
                return `${month}/${day}/${year}`;
            },
            parse(dateString, format) {
                const parts = dateString.split('/');
                const day = parseInt(parts[0], 10);
                const month = parseInt(parts[1], 10) - 1;
                const year = parseInt(parts[2], 10);
                return new Date(year, month, day);
            }
        })"
        x-on:change="value = $event.target.value"
        class="mt-1 relative rounded-md shadow-sm"
>
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <x-icon.calendar></x-icon.calendar>
        </div>
    <input
        {{ $attributes->whereDoesntStartWith('wire:model') }}
        x-ref="input"
        x-bind:value="value"
        class="rounded-md form-input flex-1 block w-full pl-10 py-2 sm:text-sm sm:leading-5"
        type="text"
    >
</div>

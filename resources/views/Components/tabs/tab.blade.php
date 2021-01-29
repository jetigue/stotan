@props(['name'])

<div x-data="{
        name: '{{ $name }}',
        show: false,
        showIfActive(active) {
            this.show = (this.name === active);
        }
    }"
     X-show="show"
     class="py-6"
>
        {{ $slot }}
</div>


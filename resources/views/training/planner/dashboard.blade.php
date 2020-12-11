<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-cool-gray-800 leading-tight">
            Planner
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @livewire('training.macrocycles.show')
        </div>
    </div>
</x-app-layout>

<div>
    <x-table.table>
        <x-slot name="head">
            <x-table.heading sortable>Name</x-table.heading>
            <x-table.heading sortable>Start Date</x-table.heading>
            <x-table.heading sortable>End Date</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach ($mesocycle->period_of_days as $date)
                <x-table.row>
                    <x-table.cell class="w-10">
                        {{ $date->training_day }}
                    </x-table.cell>
                    <x-table.cell>

                    </x-table.cell>
                    <x-table.cell>

                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table.table>
</div>

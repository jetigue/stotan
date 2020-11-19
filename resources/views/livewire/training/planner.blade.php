<div>
    <x-slot name="header">
        <h2 class="text-3xl text-cool-gray-800 leading-tight">
            Planner
        </h2>
    </x-slot>

    <div class="sm:w-full md:w-2/3">
            <x-card.card-with-header-and-footer>
                <x-slot name="header">
                    <x-card.heading-with-action>
                        Macrocycles

                        <x-slot name="action">
                            <x-button.primary wire:click="showCreateModal">
                                Add a Macrocycle
                            </x-button.primary>
                            <div>
                                @include('partials.training.create-macrocycle-modal')
                            </div>

                        </x-slot>
                    </x-card.heading-with-action>
                </x-slot>
                <div class="space-y-2">
                    @foreach($macrocycles as $macrocycle)
                        <div class="w-full bg-white hover:bg-cool-gray-50 rounded-sm">
                            <div x-data="{show:false}" class="w-full flex-col">
                                <div  class="w-full flex items-center py-4">
                                    <div class="w-11/12 flex items-baseline">
                                        <div class="flex-col w-1/3 ml-6">
                                            <p class="text-md font-medium text-blue-800">
                                                {{ $macrocycle->name }}
                                            </p>
                                            <p class="text-sm font-medium text-cool-gray-400 px-2">
                                                status
                                            </p>
                                        </div>
                                        <div class="flex-col w-1/3 text-sm justify-center text-center">
                                            <p class="text-indigo-600 font-medium">
                                                {{$macrocycle->number_of_weeks}} Total Weeks
                                            </p>
                                            <p class="flex text-sm text-cool-gray-400 items-center justify-center space-x-1.5">
                                                <span>{{ $macrocycle->begin_date_for_humans }}</span>
                                                <x-icon.arrow-right></x-icon.arrow-right>
                                                <span>{{ $macrocycle->end_date_for_humans }}</span>
                                            </p>
                                        </div>
                                        <div class="flex-col w-1/3 text-sm justify-center text-center">
                                            <p class="text-indigo-600 font-medium">
                                                10
                                            </p>
                                            <p class="flex text-sm text-cool-gray-400 items-center justify-center space-x-1.5">
                                                Mesocycles
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex w-1/12 justify-center">
                                        <a x-show="show === false" @click="show = true">
                                            <x-icon.chevron-right/>
                                        </a>
                                        <a x-show="show === true" @click="show = false">
                                            <x-icon.chevron-down/>
                                        </a>
                                    </div>
                                </div>
                                <div x-show="show">
                                    <div class="flex w-full justify-end space-x-2 px-4">
                                        <button
                                            type="button"
                                            wire:click="edit({{$macrocycle->id}})"
                                        >
                                            <x-icon.edit></x-icon.edit>
                                        </button>

                                        <button
                                            type="button"
                                            wire:click="confirmDelete({{ $macrocycle->id }})"
                                        >
                                            <x-icon.trash></x-icon.trash>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <x-slot name="footer"></x-slot>
            </x-card.card-with-header-and-footer>


            @include('partials.training.confirm-macrocycle-delete-modal')


    </div>
</div>

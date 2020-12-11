<div class="w-full">
    <x-slot name="header">
        <h2 class="text-3xl text-cool-gray-800 leading-tight">
            Planner
        </h2>
    </x-slot>

    <div class="flex w-full">
        <x-card.card-gray-body>
            <x-slot name="header">
                <x-card.heading-with-action>
                    Training Cycles

                    <x-slot name="action">
                        <x-button.primary wire:click="showCreateModal">
                            <x-icon.plus></x-icon.plus>
                            Create a Training Cycle
                        </x-button.primary>
                        <div>
                            @include('partials.training.create-macrocycle-modal')
                        </div>
                    </x-slot>
                </x-card.heading-with-action>
            </x-slot>

            <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($macrocycles as $macrocycle)
                  <li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
                    <div class="w-full flex items-center justify-between p-6 space-x-6">
                      <div class="flex-1 truncate">
                        <div class="flex items-center space-x-3">
                          <h3 class="text-cool-gray-900 text-sm font-medium truncate">
                              <a href="/training/macrocycles/{{ $macrocycle->id }}">
                                  {{ $macrocycle->name }}
                              </a>

                          </h3>
                          <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">Admin</span>
                        </div>
                        <p class="mt-1 text-gray-500 text-sm truncate">Regional Paradigm Technician</p>
                      </div>
                        <x-dropdown.dropdown>
                            <x-slot name="trigger">
                                <div class="text-gray-600">
                                    <x-icon.dots-vertical></x-icon.dots-vertical>
                                </div>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown.link wire:click="edit({{$macrocycle->id}})">
                                        Edit
                                </x-dropdown.link>
                                <x-dropdown.link wire:click="confirmDelete({{ $macrocycle->id }})">
                                        Delete
                                </x-dropdown.link>
                            </x-slot>
                        </x-dropdown.dropdown>
                    </div>
                    <div>
                      <div class="-mt-px flex divide-x divide-gray-200">
                        <div class="w-0 flex-1 flex">
                          <div class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-2 border border-transparent rounded-bl-lg">

                              <div class="flex text-cool-gray-600 items-center justify-center justify-around">
                                  <div class="flex text-xl">
                                      {{ $macrocycle->number_of_mesocycles }}
                                  </div>

                                  <div class="flex w-1/2 text-cool-gray-500 text-xs">
                                      @if ($macrocycle->number_of_mesocycles === 1)
                                          Training Phase
                                      @else
                                          Training Phases
                                      @endif
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="-ml-px w-0 flex-1 flex">
                            <div class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-2 border border-transparent rounded-bl-lg">

                                <div class="flex text-cool-gray-600 items-center justify-center justify-around">
                                    <div class="flex text-xl">
                                        {{ $macrocycle->number_of_weeks}}
                                    </div>

                                    <div class="flex w-1/2 text-cool-gray-500 text-xs">
                                        @if ($macrocycle->number_of_weeks === 1)
                                            Total Week
                                        @else
                                            Total Weeks
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </li>
                @endforeach
            </ul>
        </x-card.card-gray-body>
</div>


    @include('partials.training.confirm-macrocycle-delete-modal')
</div>

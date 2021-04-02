<div class="min-h-full">
    <x-form wire:submit.prevent="submitForm" action="/mesocycles">
        <x-input.group for="name" label="Name" :error="$errors->first('name')">
            <x-input.text
                wire:model.defer="name"
                placeholder="ex. Training Phase I"
                type="text"
            ></x-input.text>
        </x-input.group>

        <x-input.group for="begin_date_for_editing" label="Begins" :error="$errors->first('begin_date_for_editing')">
            <x-input.date
                wire:model="begin_date_for_editing"
                placeholder="MM/DD/YYYY"
            ></x-input.date>
        </x-input.group>

        <x-input.group for="end_date_for_editing" label="Ends" :error="$errors->first('end_date_for_editing')">
            <x-input.date
                wire:model="end_date_for_editing"
                placeholder="MM/DD/YYYY"
            >
            </x-input.date>
        </x-input.group>

            <x-input.group for="microcycle_length" label="Microcycle Length" :error="$errors->first('microcycle_length')">
               <x-input.select wire:model="microcycle_length">
                   <option value="7">7 Days</option>
                   <option value="10">10 Days</option>
                   <option value="14">14 Days</option>
               </x-input.select>
            </x-input.group>

{{--        @if($this->extraDays !== 0)--}}
{{--            <x-input.group--}}
{{--                for="extraDays"--}}
{{--                label="Where should the {{ $this->extraDays }} extra day(s) be added?"--}}
{{--            >--}}
{{--               <x-input.select wire:model="extraDaysLocated">--}}
{{--                   <option value="first">To the first microcycle</option>--}}
{{--                   <option value="last">To the last microcycle</option>--}}
{{--                   <option value="new">Create a mini-microcycle</option>--}}
{{--               </x-input.select>--}}
{{--            </x-input.group>--}}
{{--        @endif--}}

        <div x-data="{ popover: @entangle('expand').defer} ">
            <label id="listbox-label" class="block text-sm font-medium text-gray-700">
                Color
            </label>
            <div wire:model="color_id"
                 class="mt-1 relative">
                <button
                    type="button"
                    @click="popover=true"
                    aria-haspopup="listbox"
                    aria-expanded="true"
                    aria-labelledby="listbox-label"
                    class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      <span class="flex items-center flex-shrink-0 h-6 rounded-full">
                          @if($mesocycle)
                              @foreach($selectedColor as $color)
                                  <div class="w-5 h-5 mr-3" style="background: {{ $color->hex_code }}"></div>
                                  <span class="block text-gray-900">
                                       {{$color->name}}
                                    </span>
                              @endforeach
                          @elseif($selectedColor)
                              @foreach($selectedColor as $color)
                                  <div class="w-5 h-5 mr-3" style="background: {{ $color->hex_code }}"></div>
                                  <span class="block text-gray-900">
                                       {{$color->name}}
                                    </span>
                              @endforeach
                          @else
                              <span class="block text-gray-400">
                                Choose a color...
                              </span>
                          @endif
                      </span>
                    <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <x-icon.selector class="text-gray-400"/>
                      </span>
                </button>

                <div x-show="popover"
                     class="mt-1 w-full rounded-md bg-white shadow-lg"
                     @click.away="popover=false"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                >
                    <ul

                        tabindex="-1" role="listbox"
                        aria-labelledby="listbox-label"
                        aria-activedescendant="listbox-item-3"
                        class="max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                        @foreach($colors as $color)
                            <li x-data="{ highlighted: @entangle('highlight').defer}"
                                @mouseenter="highlighted=true"
                                @mouseleave="highlighted=false"
                                wire:click="updateColor({{$color->id}})"
                                id="listbox-item-0"
                                role="option"
                                class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9"
                                :class="{ 'bg-gray-500': highlighted }"
                                value="{{ $color->id }}"
                            >
                                <div class="flex items-center">
                                    <div class="w-5 h-5" style="background: {{ $color->hex_code }}"></div>
                                    <span
                                        class="ml-3 block font-normal truncate"
                                        :class="{ 'font-semibold text-white': highlighted}"
                                    >
                                        {{ $color->name }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="py-2 text-sm text-red-500"> {{ $errors->first('color_id') }}</div>
        </div>
    </x-form>
</div>


<div>
    <x-form wire:submit.prevent="submitForm" action="/mesocycles">
            <x-input.group for="name" label="Name" :error="$errors->first('name')">
                <x-input.text
                    wire:model.defer="name"
                    id="name"
                    placeholder="ex. Training Phase I"
                    type="text"
                ></x-input.text>
            </x-input.group>

            <x-input.group for="begin_date_for_editing" label="Begins" :error="$errors->first('begin_date_for_editing')">
                <x-input.date
                    wire:model="begin_date_for_editing"
                    id="begin_date_for_editing"
                    placeholder="MM/DD/YYYY"
                ></x-input.date>
            </x-input.group>

            <x-input.group for="end_date_for_editing" label="Ends" :error="$errors->first('end_date_for_editing')">
                <x-input.date
                    wire:model="end_date_for_editing"
                    id="end_date"
                    placeholder="MM/DD/YYYY"
                >
                </x-input.date>
            </x-input.group>

        <!-- This example requires Tailwind CSS v2.0+ -->
        <!--
          Custom select controls like this require a considerable amount of JS to implement from scratch. We're planning
          to build some low-level libraries to make this easier with popular frameworks like React, Vue, and even Alpine.js
          in the near future, but in the mean time we recommend these reference guides when building your implementation:

          https://www.w3.org/TR/wai-aria-practices/#Listbox
          https://www.w3.org/TR/wai-aria-practices/examples/listbox/listbox-collapsible.html
        -->
        <div>
          <label id="listbox-label" class="block text-sm font-medium text-gray-700">
            Color
          </label>
          <div x-data="{ show:false }" class="mt-1 relative">
            <button @click="show=true" type="button" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label" class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <span class="block truncate">
                Tom Cook
              </span>
              <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <x-icon.selector />

              </span>
            </button>

            <!--
              Select popover, show/hide based on select state.

              Entering: ""
                From: ""
                To: ""
              Leaving: "transition ease-in duration-100"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="absolute mt-1 w-full rounded-md bg-white shadow-lg">
              <ul x-show="show" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-item-3" class="max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                <!--
                  Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                  Highlighted: "text-white bg-indigo-600", Not Highlighted: "text-gray-900"
                -->
                <li id="listbox-option-0" role="option" class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9 bg-red-900">
                  <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                  <span class="font-normal block truncate">
                    Wade Cooper
                  </span>

                  <!--
                    Checkmark, only display for selected option.

                    Highlighted: "text-white", Not Highlighted: "text-indigo-600"
                  -->
                  <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                    <x-icon.check />
                  </span>
                </li>

                <!-- More items... -->
              </ul>
            </div>
          </div>
        </div>


            <x-input.group for="color" label="Color" :error="$errors->first('color')">
                <input wire:model.defer="color" type="color" id="color" class="w-50 h-12 rounded-md ">
            </x-input.group>


    </x-form>
</div>


@props(['active'])

<div x-data="{
        activeTab: '{{ $active }}',
        tabs: [],
        tabHeadings: [],
        toggleTabs() {
            this.tabs.forEach(
                tab => tab.__x.$data.showIfActive(this.activeTab)
            );
        }
    }"
     x-init="() => {
        tabs = [...$refs.tabs.children];

        tabHeadings = tabs.map(tab => tab.__x.$data.name);

        toggleTabs();
     }"

>
    @if(isset($selectMenu))
        <div class="sm:hidden">
            {{ $selectMenu }}
        </div>
    @endif

    <div class="hidden sm:block">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex " aria-label="Tabs">
                <template
                    x-for="(tab, index) in tabHeadings"
                    :key="index"
                >
                    <button
                        x-text="tab"
                        @click="activeTab = tab; toggleTabs();"
                        class=" mr-8 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm focus:outline-none"
                        :class="tab === activeTab ? 'border-indigo-500 text-indigo-600 hover:border-indigo-500 hover:text-indigo-600' : 'border-transparent text-gray-500'"
                    ></button>
                </template>

            </nav>
        </div>
    </div>

    <div x-ref="tabs">
        {{ $slot }}
    </div>

</div>

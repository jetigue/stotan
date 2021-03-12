<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between items-center w-full">
            <span class="flex justify-start">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-1 py-2 bg-white cursor-default leading-5 rounded-md text-white">
                        <x-icon.chevron-left class="h-7 w-7" />
                    </span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="relative inline-flex items-center px-1 py-2 text-gray-300 hover:text-gray-600">
                        <x-icon.chevron-left class="h-7 w-7" />
                    </button>
                @endif
            </span>

            <span class="flex justify-center text-lg">Microcycle {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}</span>

            <span class="flex justify-end">
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="relative inline-flex items-center px-1 py-2 leading-5 rounded-md text-gray-300 hover:text-gray-600">
                        <x-icon.chevron-right class="h-7 w-7"/>
                    </button>
                @else
                    <span class="relative inline-flex items-center px-1 py-2 cursor-default leading-5 text-white">
                        <x-icon.chevron-right class="h-7 w-7" />
                    </span>
                @endif
            </span>
        </nav>
    @endif
</div>

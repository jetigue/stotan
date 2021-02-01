<div class="flex flex-col flex-grow border-r border-gray-200 pt-5 pb-4 bg-white overflow-y-auto">
    <div class="flex items-center flex-shrink-0 px-4 space-y-5">
        <img class="h-8 w-auto"
             src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg"
             alt="Workflow">
    </div>
    <div class="mt-5 flex-grow flex bg-white flex-col ">
        <nav class="flex-1 space-y-1" aria-label="Sidebar">
            {{ $slot }}
        </nav>
    </div>
</div>


<div class="rounded-md p-4" style="background: yellow;">
  <div class="flex">
    <div class="flex-shrink-0">
      <!-- Heroicon name: solid/exclamation -->
        <x-icon.exclamation class="text-blue-500"></x-icon.exclamation>
    </div>
    <div class="ml-3">
      <div class="text-xs text-blue-700 text-left">
        <p>
            {{ $slot }}
        </p>
      </div>
    </div>
  </div>
</div>

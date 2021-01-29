@props(['route', 'title'])

@php
    $classes = Request::routeIs($route) ? 'bg-indigo-50 border-indigo-600 text-indigo-600 border-l-4 font-medium' : 'text-gray-400 group-hover:text-gray-500 pl-4'
@endphp

<a href="{{ route($route) }}"
   {{ $attributes->merge(['class' => 'group flex items-center px-3 py-2 text-sm ' . $classes ]) }}>

    <div class="mr-4">{{ $icon }}</div>

    {{ $slot }}
</a>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
</head>
<body class="font-sans antialiased bg-white">

@livewire('navigation-dropdown')

<div x-data="{ show: false }" class="flex">

    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div x-show="show" class="lg:hidden">
        <div class="fixed inset-0 flex z-40">

            <div
                    x-show="show"
                    x-transition:enter="transition-opacity ease-linear duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-linear duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0">
                <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
            </div>

            <!-- Page Content -->
            <main>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-full">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <div class="hidden lg:flex lg:flex-shrink-0">
        <div class="flex flex-col w-64 ">
            <x-nav.sidebar-menu>
                <x-nav.sidebar-link route="dashboard" title="Dashboard">
                    <x-slot name="icon">
                        <x-icon.home/>
                    </x-slot>
                    Dashboard
                </x-nav.sidebar-link>

                <x-nav.sidebar-link route="Training Dashboard" title="Training Dashboard">
                    <x-slot name="icon">
                        <x-icon.chart-line/>
                    </x-slot>
                    Training
                </x-nav.sidebar-link>
            </x-nav.sidebar-menu>
        </div>
    </div>
    <div class="flex flex-col min-w-0 flex-1 overflow-auto min-h-screen">
        <div class="lg:hidden">
            <div class="flex items-center justify-between bg-gray-50 border-b border-gray-200 px-4 py-1.5">
                <div>
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                         alt="Workflow">
                </div>
                <div>
                    <button
                            @click="show =!show"
                            type="button"
                            class="-mr-3 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900">
                        <span class="sr-only">Open sidebar</span>

                        <x-icon.menu/>
                    </button>
                </div>
            </div>
        </div>

        <div class="px-8 py-6">
            @if (isset($breadcrumbs))
                <div>
                    {{ $breadcrumbs }}
                </div>
            @endif
            <div class="mt-2">
                <div class="flex-1 min-w-0">
                    <div class="text-2xl lg:text-3xl font-medium text-gray-700 sm:truncate">
                        {{ $header }}
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 z-0 flex overflow-hidden bg-gray-50">
            <div class="flex-1 z-0 focus:outline-none h-full" tabindex="0">
                <div class=" py-6 px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </div>
            @if (isset($aside))
                <div class="hidden xl:flex xl:flex-col flex-shrink-0 w-80 border-l border-gray-200 bg-gray-50">
                    <div class="py-6 px-4 sm:px-6 lg:px-8">
                        {{ $aside }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@stack('modals')

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
</body>
</html>


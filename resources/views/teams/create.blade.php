<x-app-sidebar-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Создание команды') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 bg-zinc-900/50 backdrop-blur-xl rounded-lg">
            @livewire('teams.create-team-form')
        </div>
    </div>
</x-app-sidebar-layout>

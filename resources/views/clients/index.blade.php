<x-app-sidebar-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Список клиентов') }}
            </h2>
        </x-slot>
    <div class="bg-white dark:bg-zinc-900/80 backdrop-blur-3xl sm:rounded-xl">
                @livewire('client.clients-list')
    </div>

</x-app-sidebar-layout>

<x-app-sidebar-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Список клиентов') }}
            </h2>
        </x-slot>

                @livewire('client.clients-list')

</x-app-sidebar-layout>

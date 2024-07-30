<x-app-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Список клиентов') }}
            </h2>
        </x-slot>

    <div class="py-12">
        <div class="flex w-full gap-6 px-8 mx-auto">
            @livewire('client.create-client')
            <div class="w-full">
                @livewire('client.clients-list')
            </div>

        </div>
    </div>

<div class="space-y-6">

</div>

</x-app-layout>

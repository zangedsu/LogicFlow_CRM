<x-app-sidebar-layout>
    <x-slot name="header">
        <div class=" sm:flex sm:items-center sm:justify-between">
            <h3 class="font-semibold leading-6 text-xl text-gray-900 dark:text-white">Проекты</h3>
            <div class="mt-3 sm:ml-4 sm:mt-0">
                <a wire:navigate href="{{route('projects.create')}}"  class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Добавить проект</a>
            </div>
        </div>
    </x-slot>


    @livewire('project.projects-list')
</x-app-sidebar-layout>

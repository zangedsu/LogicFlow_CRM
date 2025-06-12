<x-app-sidebar-layout>
    <x-slot name="header">
        <div class=" sm:flex sm:items-center sm:justify-between">
            <h3 class="font-semibold leading-6 text-xl text-gray-900 dark:text-white">Проекты</h3>
            @if(Auth::user()->hasTeamPermission(Auth::user()->currentTeam()->first(), 'create'))
            <div class="mt-3 sm:ml-4 sm:mt-0">
                <a wire:navigate href="{{route('projects.create')}}"  class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Добавить проект</a>
            </div>
            @endif
        </div>
    </x-slot>

{{--    <div class="bg-white dark:bg-zinc-900/80 backdrop-blur-3xl sm:rounded-xl">--}}
    <x-section>
    @livewire('project.projects-list')
    </x-section>
{{--    </div>--}}
</x-app-sidebar-layout>

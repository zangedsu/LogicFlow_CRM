<x-app-sidebar-layout>
    <div class="py-12">
        <div class="flex flex-col w-full gap-6 px-8 mx-auto">
            @livewire('widgets.calendar')
                            @livewire('client.clients-list', [5, false])
                            @livewire('client.create-client')
                            @livewire('widgets.tasks-total')

                            @livewire('project.create')

        </div>
    </div>

</x-app-sidebar-layout>

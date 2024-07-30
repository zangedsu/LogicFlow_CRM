<x-app-sidebar-layout>
    <div class="py-12">
        <div class="flex flex-col w-full gap-6 px-8 mx-auto">
            @livewire('client.clients-list')
                            @livewire('widgets.tasks-total')
                            @livewire('client.create-client')
                            @livewire('project.create')

        </div>
    </div>

</x-app-sidebar-layout>

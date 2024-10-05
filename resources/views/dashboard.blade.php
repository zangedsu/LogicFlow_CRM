<x-app-sidebar-layout>
    <div class="py-12">
        <div class="flex flex-col w-full gap-6 px-8 mx-auto">
            @livewire('widgets.tasks-total')

            <x-section class="w-1/2">

            </x-section>

<div class="w-full flex gap-x-3">
    <div class="w-1/2">

    </div>
    <div class="w-1/2">

    </div>
</div>


            @livewire('widgets.calendar')

                            @livewire('client.clients-list', [5, false])
                            @livewire('client.create-client')


                            @livewire('project.create')

        </div>
    </div>

</x-app-sidebar-layout>

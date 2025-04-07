<x-app-sidebar-layout>
    <div class="py-12">
        <div class="flex flex-col w-full gap-6 px-8 mx-auto">

{{--            @livewire('widgets.tasks-total')--}}
            <x-section>
                <livewire:widgets.tasks-total lazy/>
            </x-section>


            <div class="flex w-full gap-x-6">
                <x-section class="w-2/3">
                    <h2 class="text-lg font-extralight text-sky-700 py-2 leading-6 uppercase px-6">Последние задачи</h2>
                    @livewire('task.tasks-list', ['navigate_links' => false, 'per_page' => 5])
                </x-section>

                <x-section class="w-1/3">
                    @livewire('widgets.latest-notes')
                </x-section>
            </div>

            <div class="flex w-full gap-x-6">
                <x-section class="w-1/2">
                    <h2 class="text-lg font-extralight text-sky-700 py-2 leading-6 uppercase px-6">Клиенты</h2>
                    @livewire('client.clients-list', [5, false])
                </x-section>
                <x-section class="w-1/2">
                    <h2 class="text-lg font-extralight text-sky-700 py-2 leading-6 uppercase px-6">Проекты</h2>
                    @livewire('project.projects-list', ['per_page' => 5, 'navigate_links' => false])
                </x-section>
            </div>





            @livewire('widgets.calendar')


        </div>
        </div>

</x-app-sidebar-layout>

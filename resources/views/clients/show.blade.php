<x-app-sidebar-layout>
    <div class="bg-white dark:bg-zinc-800 rounded-lg p-6">
        <div class="px-4 flex sm:px-0">
            @if($client->logo()->first())
            <img class="h-16 w-16 rounded-full mr-2" src="{{asset('storage/'.$client->logo()->first()->path)}}">
            @endif
            <div>
                <h3 class="text-base font-semibold leading-7 text-white">Просмотр клиента</h3>
                <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-400">Вся информация о выбранном клиента</p>
            </div>
        </div>
        <div class="mt-6 border-t border-white/10">
            <dl class="divide-y divide-white/10">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-white">Имя</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$client->name}}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-white">Номер телефона</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$client->phone}}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-white">Email</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$client->email}}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-white">Сайт</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$client->site}}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-white">Добавлен в команду</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$client->team()->first()->name}}</dd>
                </div>
            </dl>
        </div>
    </div>



@if($client->projects()->get()->count() != 0)
    <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 mt-6">
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-white">Последние проекты клиента</h3>
        </div>
        @livewire('project.projects-list', [$client->projects()->latest()->get()])
    </div>

    @else
        <div class="text-center bg-white dark:bg-zinc-800 rounded-lg p-6 mt-6">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
            <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">Нет проектов</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">у данного клиента нет проектов, вы можете создать новый</p>
            <div class="mt-6">
                <a wire:navigate href="{{route('projects.create', ['client' => $client->id])}}" type="button" class="inline-flex items-center rounded-md bg-zinc-900/80 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:border duration-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                   Создать проект
                </a>
            </div>
        </div>

    @endif
</x-app-sidebar-layout>

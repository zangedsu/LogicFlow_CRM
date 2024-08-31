<x-app-sidebar-layout>
    <div class="bg-white dark:bg-zinc-800 rounded-lg p-6">
        <div class="px-4 flex sm:px-0">
            {{--            @if($client->logo()->first())--}}
            {{--                <img class="h-16 w-16 rounded-full mr-2" src="{{asset('storage/'.$client->logo()->first()->path)}}">--}}
            {{--            @endif--}}
            <div>
                <h3 class="text-base font-semibold leading-7 text-white">Просмотр задача</h3>
                <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-400">Вся информация о выбранной задаче</p>
            </div>
        </div>
        <div class="mt-6 border-t border-white/10">
            <dl class="divide-y divide-white/10">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-white">Название</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$task->name}}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-white">Клиент</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0"><a class="border-b" wire:navigate href="{{route('projects.show', $task->project->id)}}">{{$task->project->name}}</a></dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-white">Описание</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$task->description}}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-white">Ответственный</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$task->responsible?->name}}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-white">Статус</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$task->state->name}}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-white">Описание</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$task->description}}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-white">Задача создана</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$task->created_at}}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-white">Дедлайн</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$task->deadline}}</dd>
                </div>
            </dl>
        </div>
    </div>


    <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 mt-6">
        {{--        <a class="bg-white" wire:navigate href="{{route('projects.create', ['client' => $client->id])}}">Создать проект</a>--}}
    </div>

</x-app-sidebar-layout>

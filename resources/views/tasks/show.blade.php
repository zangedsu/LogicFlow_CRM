<x-app-sidebar-layout>
    <div class="md:flex items-stretch justify-items-stretch content-stretch md:gap-6">
        <div class="bg-white md:w-2/3 dark:bg-zinc-900/80 rounded-xl backdrop-blur-xl p-6 ">
            <div class="px-4 flex sm:px-0 justify-between">

                <div>
                    <h3 class="text-base font-semibold leading-7 text-white">Просмотр задачи</h3>
                    <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-400">Вся информация о выбранной задаче</p>
                </div>
                @livewire('components.timers.task-timer', ['task_id' => $task->id])
            </div>
            <div class="mt-6 border-t border-white/10">
                <dl class="divide-y divide-white/10">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-white">Название</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$task->name}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-white">Проект</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0"><a class="border-b" wire:navigate href="{{route('projects.show', $task->project->id)}}">{{$task->project->name}}</a></dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-white">Описание</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$task->description}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-white">Ответственные за задачу</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0 flex flex-wrap gap-6">
                            @foreach($task->responsible_users as $user)
                                <div class="flex border rounded-sm bg-gray-600/80 p-4 gap-x-2 items-center max-w-60"><img class="rounded-full h-6 w-auto" src="{{$user?->profile_photo_url}}">{{$user->name}}</div>
                            @endforeach
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-white">Статус</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{$task->state}}</dd>
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

        <div class="md:w-1/3 h-fit">
            @livewire('task.comments', ['task_id' => $task->id])
        </div>

    </div>



</x-app-sidebar-layout>

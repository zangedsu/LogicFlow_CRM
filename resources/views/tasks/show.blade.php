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
                        <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">
                            <a class="border-b" wire:navigate href="{{route('projects.show', $task->project->id)}}">
                                {{$task->project->name}}
                            </a>
                        </dd>
                    </div>

                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-white">Описание</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{!! $task->description !!}</dd>
                    </div>

                    {{-- Ответственный --}}
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-white">Ответственный</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">
                            @if($task->assignee)
                                <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-100 dark:bg-zinc-800 max-w-xs">
                                    <img class="rounded-full h-10 w-10 object-cover"
                                         src="{{ $task->assignee->profile_photo_url }}">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                            {{ $task->assignee->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $task->assignee->teamRole(Auth::user()->currentTeam)->name ?? 'Член команды' }}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <span class="text-gray-400">Не назначен</span>
                            @endif
                        </dd>
                    </div>

                    {{-- Участники --}}
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-white">Участники</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0 flex flex-wrap gap-4">
                            @forelse($task->participants as $user)
                                <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-100 dark:bg-zinc-800 max-w-xs">
                                    <img class="rounded-full h-10 w-10 object-cover"
                                         src="{{ $user->profile_photo_url }}">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{-- роль в задаче (pivot.role) --}}
                                            {{ $user->pivot->role === 'collaborator' ? 'Исполнитель' : 'Наблюдатель' }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <span class="text-gray-400">Нет участников</span>
                            @endforelse
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

            {{-- История статусов --}}
            <div class="p-2">
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-4 text-white">История изменений статуса</h3>
                    @if($task->stateLogs && $task->stateLogs->count() > 0)
                        <ol class="relative border-l border-gray-300">
                            @foreach($task->stateLogs->sortByDesc('created_at') as $log)
                                <li class="mb-8 ml-4">
                                    <div class="absolute w-3 h-3 bg-blue-500 rounded-full -left-1.5 border border-white"></div>
                                    <time class="mb-1 text-sm font-normal leading-none text-gray-500">
                                        {{ $log->created_at->format('d.m.Y H:i') }}
                                    </time>
                                    <h3 class="text-lg font-semibold text-gray-100 ">
                                        {{ $log->state }}
                                    </h3>
                                    <p class="mb-2 text-sm text-gray-600">
                                        Изменил: {{ $log->statusChangedBy->name ?? 'Система' }}
                                    </p>
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <div class="p-4 bg-gray-50 text-gray-500 text-sm rounded-md border border-gray-200">
                            История изменений пока отсутствует
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="md:w-1/3 h-fit">
            @livewire('task.comments', ['task_id' => $task->id])
        </div>
    </div>
</x-app-sidebar-layout>

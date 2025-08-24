@php use Illuminate\Support\Carbon; @endphp
<x-app-sidebar-layout>
    <div class="flex flex-col gap-6">

        <div class="md:flex w-full md:gap-6">
            {{-- Левая колонка (основная инфа) --}}
            <div class="bg-white md:w-2/3 dark:bg-zinc-900/80 rounded-xl backdrop-blur-xl p-6 space-y-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Задача: {{ $task->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Информация о задаче</p>
                    </div>
                    @can('changeStatus', $task)
                        @livewire('components.timers.task-timer', ['task_id' => $task->id])
                    @endcan
                </div>

                <dl class="divide-y divide-gray-200 dark:divide-white/10">
                    {{-- Проект --}}
                    <div class="py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-700 dark:text-gray-300">Проект</dt>
                        <dd class="col-span-2">
                            <a class="text-blue-600 hover:underline"
                               wire:navigate href="{{ route('projects.show', $task->project->id) }}">
                                {{ $task->project->name }}
                            </a>
                        </dd>
                    </div>

                    {{-- Ответственный --}}
                    <div class="py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-700 dark:text-gray-300">Ответственный</dt>
                        <dd class="col-span-2">
                            @if($task->assignee)
                                <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 dark:bg-zinc-800">
                                    <img class="rounded-full h-10 w-10 object-cover"
                                         src="{{ $task->assignee->profile_photo_path ? asset('storage/'.$task->assignee->profile_photo_path) : $task->assignee->profile_photo_url }}">
                                    <div>
                                        <div class="font-medium text-gray-900 dark:text-gray-200">
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
                    <div class="py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-700 dark:text-gray-300">Участники</dt>
                        <dd class="col-span-2 flex flex-wrap gap-3">
                            @forelse($task->participants as $user)
                                <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 dark:bg-zinc-800">
                                    <img class="rounded-full h-9 w-9 object-cover"src="{{ $user->profile_photo_path ? asset('storage/'.$user->profile_photo_path) : $user->profile_photo_url }}">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $user->pivot->role === 'collaborator' ? 'Исполнитель' : 'Наблюдатель' }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <span class="text-gray-400">Нет участников</span>
                            @endforelse
                        </dd>
                    </div>

                    {{-- Статус --}}
                    <div class="py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-700 dark:text-gray-300">Статус</dt>
                        <dd class="col-span-2">
                            <x-badge :state="$task->state">{{$task->state}}</x-badge>
                        </dd>
                    </div>

                    {{-- Даты --}}
                    <div class="py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-700 dark:text-gray-300">Создана</dt>
                        <dd class="col-span-2 text-gray-500">{{ $task->created_at->format('d.m.Y H:i') }}</dd>
                    </div>

                    <div class="py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-700 dark:text-gray-300">Дедлайн</dt>
                        <dd class="col-span-2 text-gray-500">
                            {{ $task->deadline ? $task->deadline->format('d.m.Y H:i') : '—' }}
                        </dd>
                    </div>
                </dl>
{{--                Визуализация дедлайна--}}
                @php
//                    use Carbon\Carbon;

                    $created = Carbon::parse($task->created_at);
                    $deadline = Carbon::parse($task->deadline);
                    $today = Carbon::today();

                    $totalDays = max(1, $created->diffInDays($deadline));
                    $passedDays = $created->diffInDays($today, false);

                    // Позиция текущей даты в %
                    $position = $passedDays > 0
                        ? min(100, max(0, ($passedDays / $totalDays) * 100))
                        : 0;

                    $isDeadlineToday = $today->equalTo($deadline);
                    $isDeadlinePassed = $today->greaterThan($deadline);
                @endphp

                <div class="w-full flex flex-col items-center">
                    {{-- Даты начала и конца --}}
                    <div class="w-full flex justify-between text-xs text-gray-600 mb-1">
                        <span>{{ $created->format('d.m.Y') }}</span>
                        <span>{{ $deadline->format('d.m.Y') }}</span>
                    </div>

                    {{-- Линия прогресса --}}
                    <div class="relative w-full h-3 rounded-full bg-gradient-to-r from-blue-500 to-red-500 overflow-hidden">

                        {{-- Шкала по дням --}}
                        @for ($i = 0; $i <= $totalDays; $i++)
                            @php
                                $tickPos = ($i / $totalDays) * 100;
                            @endphp
                            <div class="absolute top-0 h-full border-l border-white/40" style="left: {{ $tickPos }}%"></div>
                        @endfor

                        {{-- Пульсация всей полоски если дедлайн сегодня --}}
                        @if($isDeadlineToday)
                            <div class="absolute inset-0 rounded-full animate-pulse bg-red-500/30"></div>
                        @endif

                        {{-- Точка текущей даты --}}
                        @if(!$isDeadlinePassed && !$isDeadlineToday)
                            <div class="absolute top-1/2 -translate-y-1/2" style="left: {{ $position }}%">
                                <div class="relative flex items-center justify-center">
                                    <div class="w-3 h-3 bg-white rounded-full border-2 border-black"></div>
                                    <div class="absolute w-6 h-6 rounded-full border-2 border-blue-400 animate-ping"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                {{--               ! Визуализация дедлайна--}}

            </div>

            {{-- Правая колонка (комменты / история) --}}
            <div class="md:w-1/3 flex flex-col gap-6">
                <div x-data="{ tab: 'comments' }" class="bg-white dark:bg-zinc-900/80 rounded-xl p-4">
                    {{-- Вкладки --}}
                    <div class="flex border-b border-gray-200 dark:border-gray-700 mb-4">
                        <button @click="tab = 'comments'"
                                :class="tab === 'comments' ? 'border-b-2 border-green-500 text-green-600' : 'text-gray-500'"
                                class="px-4 py-2 text-sm font-medium">Комментарии</button>
                        <button @click="tab = 'history'"
                                :class="tab === 'history' ? 'border-b-2 border-green-500 text-green-600' : 'text-gray-500'"
                                class="px-4 py-2 text-sm font-medium">История</button>
                    </div>

                    {{-- Комментарии --}}
                    <div x-show="tab === 'comments'" x-cloak>
                        @livewire('task.comments', ['task_id' => $task->id])
                    </div>

                    {{-- История --}}
                    <div x-show="tab === 'history'" x-cloak>
                        @if($task->stateLogs && $task->stateLogs->count() > 0)
                            <ol class="relative border-l border-gray-300 dark:border-gray-700">
                                @foreach($task->stateLogs->sortByDesc('created_at') as $log)
                                    <li class="mb-6 ml-4">
                                        <div class="absolute w-3 h-3 bg-green-500 rounded-full -left-1.5 border border-white"></div>
                                        <time class="text-xs text-gray-500 block">
                                            {{ $log->created_at->format('d.m.Y H:i') }}
                                        </time>
                                        <div class="font-medium text-gray-900 dark:text-gray-100">
                                            {{ $log->state }}
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            Изменил: {{ $log->statusChangedBy->name ?? 'Система' }}
                                        </p>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <div class="p-3 text-sm text-gray-500 bg-gray-50 dark:bg-zinc-800 rounded">
                                История изменений пока отсутствует
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Описание задачи (внизу) --}}
        <div class="bg-white dark:bg-zinc-900/80 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Описание</h3>
            <div class="prose dark:prose-invert max-w-none">
                {!! $task->description !!}
            </div>
        </div>

    </div>
</x-app-sidebar-layout>

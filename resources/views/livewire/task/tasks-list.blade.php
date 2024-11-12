<div>
    {{--    <div class="border-b px-2 items-center min-h-16 dark:bg-zinc-900/80 backdrop-blur-3xl flex space-x-6">--}}
    {{--        <label class="text-gray-400 text-sm">--}}
    {{--            <input  type="checkbox"  placeholder="Только новые">--}}
    {{--           Только новые задачи--}}
    {{--        </label>--}}
    {{--    </div>--}}
    <ul role="list"
        class="divide-y divide-gray-100 overflow-hidden  shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
        @if($paginated_tasks)
            @foreach($paginated_tasks as $task)
                <li class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 dark:hover:bg-gray-900 duration-300 sm:px-6">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">
                                <a href="{{route('tasks.show', $task->id)}}">
                                    <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                    {{$task->name}}
                                </a>
                            </p>
                            <div class="text-sm font-mono font-extralight text-gray-400">
                                Дедлайн: {{$task->deadline}}</div>
                        </div>
                    </div>

                    <div class="flex shrink-0 items-center gap-x-4">

                        <!-- if expired -->
                        @if($task->deadline < now() && $task->state != 'completed')
                            <x-badge state="failed">Просрочена</x-badge>
                        @endif
                        <x-dropdown>
                            <x-slot:trigger>
                                <x-badge :state="$task->state">{{$states[$task->state] }}</x-badge>
                            </x-slot:trigger>
                            <x-slot:content>
                                <x-dropdown-link wire:click="changeTaskState({{$task->id}}, 'in_process')">В работе
                                </x-dropdown-link>
                                <x-dropdown-link wire:click="changeTaskState({{$task->id}}, 'completed')">Завершена
                                </x-dropdown-link>
                                <x-dropdown-link wire:click="changeTaskState({{$task->id}}, 'failed')">Не удалась
                                </x-dropdown-link>
                            </x-slot:content>
                        </x-dropdown>

                        <button @if($this->is_user_has_active_timer && !$task->timers()->where('state','=', 'started')->first()) disabled
                                @endif wire:click="startTimer({{$task->id}})"
                                class="relative inline-flex disabled:opacity-50 disabled:contrast-50 items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                <span class="flex px-2 py-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                     @if($task->timers()->where('state', '=', 'started')->first())
                                        <svg @click="$dispatch('show_timers')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 animate-pulse">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>

                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"/>
                                    </svg>
                                    @endif
                                </span>

                        </button>


                        <div class="hidden sm:flex sm:flex-col sm:items-end">
                            <div class="mt-1 flex items-center gap-x-1.5">
                                <!-- comments -->
                                <div class="flex w-12 gap-x-2.5">
                                    <dt>
                                        <span class="sr-only">Total comments</span>
                                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"></path>
                                        </svg>
                                    </dt>
                                    <dd class="text-sm leading-6 text-gray-100">{{$task->notes()->count()}}</dd>
                                </div>
                                <x-dropdown>
                                    <x-slot:trigger>
                                        <button data-dropdown-toggle="dropdownDots"
                                                class="inline-flex items-center px-4 text-sm font-medium text-center rounded-lg hover:text-white focus:ring-4 text-gray-400 focus:outline-none focus:ring-gray-50"
                                                type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                 fill="currentColor" viewBox="0 0 4 15">
                                                <path
                                                    d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                            </svg>
                                        </button>


                                    </x-slot:trigger>
                                    <x-slot:content>
                                        <x-dropdown-link href="{{route('tasks.show', $task->id)}}">
                                            Просмотреть
                                        </x-dropdown-link>
                                        @if(Auth::user()->hasTeamPermission(Auth::user()->currentTeam()->first(), 'update'))
                                            <x-dropdown-link href="{{route('tasks.edit', $task->id)}}">
                                                Редактировать
                                            </x-dropdown-link>
                                        @endif
                                        @if(Auth::user()->hasTeamPermission(Auth::user()->currentTeam()->first(), 'delete'))
                                            <x-dropdown-link disabled
                                                             wire:confirm="Вы уверены, что хотите удалить эту задачу?"
                                                             wire:click="deleteTask({{$task->id}})">
                                                Удалить
                                            </x-dropdown-link>
                                        @endif
                                    </x-slot:content>
                                </x-dropdown>


                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        @else
            <div class="text-center  rounded-lg p-6 mt-6">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">Нет задач</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">У вас совсем нет задач, стоит их
                    создать для начала работы</p>
                <div class="mt-6">
                    <a wire:navigate href="{{route('tasks.create')}}" type="button"
                       class="inline-flex items-center rounded-md bg-zinc-900/80 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:border duration-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"/>
                        </svg>
                        Создать задачу
                    </a>
                </div>
            </div>

        @endif
            @if($navigate_links)

                {{ $paginated_tasks?->links() }}
            @endif
    </ul>
</div>


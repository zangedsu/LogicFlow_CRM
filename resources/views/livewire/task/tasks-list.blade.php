<ul role="list"
    class="divide-y divide-gray-100 overflow-hidden bg-white dark:bg-zinc-900/80 backdrop-blur-3xl shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
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
                    </div>
                </div>
                <div class="flex shrink-0 items-center gap-x-4">

                    <x-dropdown>
                        <x-slot:trigger>
                            <x-badge :state="$task->state">{{$states[$task->state] }}</x-badge>
                        </x-slot:trigger>
                        <x-slot:content>
                            <x-dropdown-link wire:click="changeTaskState({{$task->id}}, 'in_process')">В работе</x-dropdown-link>
                            <x-dropdown-link wire:click="changeTaskState({{$task->id}}, 'completed')">Завершена</x-dropdown-link>
                            <x-dropdown-link wire:click="changeTaskState({{$task->id}}, 'failed')">Не удалась</x-dropdown-link>
                        </x-slot:content>
                    </x-dropdown>

                    <button class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
<span
    class="flex px-2 py-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">

    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="size-4">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"/>
</svg>


</span>
                    </button>
                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                        <div class="mt-1 flex items-center gap-x-1.5">

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
                                    <x-dropdown-link href="{{route('tasks.edit', $task->id)}}">
                                        Редактировать
                                    </x-dropdown-link>
                                </x-slot:content>
                            </x-dropdown>


                        </div>
                    </div>
                </div>
            </li>
        @endforeach

        @if($navigate_links)
            {{ $paginated_tasks->links() }}
        @endif

    @endif
</ul>

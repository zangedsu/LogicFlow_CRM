<div x-data="{ isOpen : false }" class="bg-white dark:bg-zinc-900/80 backdrop-blur-3xl overflow-hidden shadow-xl sm:rounded-lg p-6">

    <form class="flex flex-col space-y-2" wire:submit="createOrUpdate">

        <input class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" name="name" wire:model.blur="name" placeholder="Название спринта">
        @error('name')<div class="bg-red-900">{{ $message }}</div>@enderror

        <textarea type="text" class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" name="description" wire:model.blur="description" placeholder="Описание"></textarea>
        @error('description')<div class="bg-red-900">{{ $message }}</div>@enderror

{{--        DATES--}}
        <div class="flex space-x-2">
            <input aria-placeholder="Start" type="date" class="border-gray-200 border-b w-1/2 border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" name="description" wire:model.blur="start_date" placeholder="Описание проекта"></input>
            @error('start_date')<div class="bg-red-900">{{ $message }}</div>@enderror

            <input type="date" class="border-gray-200 border-b w-1/2 border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" name="description" wire:model.blur="end_date" placeholder="Описание проекта"></input>
            @error('end_date')<div class="bg-red-900">{{ $message }}</div>@enderror
        </div>

        <button @click="isOpen = true" type="button" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v20c0 4.418 7.163 8 16 8 1.381 0 2.721-.087 4-.252M8 14c0 4.418 7.163 8 16 8s16-3.582 16-8M8 14c0-4.418 7.163-8 16-8s16 3.582 16 8m0 0v14m0-4c0 4.418-7.163 8-16 8S8 28.418 8 24m32 10v6m0 0v6m0-6h6m-6 0h-6" />
            </svg>
            <span class="mt-2 block text-sm font-semibold text-gray-100">Добавить задачи в этот спринт</span>
        </button>






        <button class="text-white max-w-72 bg-gradient-to-l from-zinc-500 to-zinc-800 rounded-lg my-4 p-2 hover:shadow-blue-400" type="submit">Сохранить спринт</button>
    </form>

    @teleport('body')
    <div x-show="isOpen" class="relative z-50" role="dialog" aria-modal="true">

        <div class="fixed inset-0 bg-zinc-800/40 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto p-4 sm:p-6 md:p-20">
            <!--
              Command palette, show/hide based on modal state.
            -->
            <div x-show="isOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"

                @click.away="isOpen = false" @close.stop="isOpen = false" @keyup.escape="isOpen = false" class="mx-auto my-auto max-w-3xl transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-zinc-900/80 backdrop-blur-3xl shadow-2xl ring-1 ring-black ring-opacity-5 transition-all">
                <div class="relative">
                    <svg class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                    <input type="text" class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-white placeholder:text-gray-400 focus:ring-0 sm:text-sm" placeholder="Поиск задач..." role="combobox" aria-expanded="false" aria-controls="options">
                </div>

                <!-- Results, show/hide based on command palette state -->
                <ul class="max-h-screen min-h-72 scroll-py-2 overflow-y-auto py-2 text-sm text-white" id="options" role="listbox">
                    <!-- Active: "bg-indigo-600 text-white" -->
                    @foreach($project_tasks as $task)
                        <li class="cursor-default select-none px-4 py-2" wire:key="{{$task->id}}" role="option">{{$task->name}}</li>
                    @endforeach

                </ul>

                <!-- Empty state, show/hide based on command palette state -->
                <p class="p-4 text-sm text-gray-500">Нет добавленных задач</p>
            </div>
        </div>
    </div>
    @endteleport

</div>



<div class="relative flex flex-1" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false" @keyup.escape="open = false">
    <form class="w-full"  action="#" method="GET">
        <label for="search-field" class="sr-only">Search</label>
        <svg class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
        </svg>
        <input @click="open = true" wire:model.live="searchText" wire:change="search" id="search-field" class="block h-full w-full border-0 bg-transparent py-0 pr-0 pl-8 placeholder:text-gray-400 text-gray-900 focus:ring-0 dark:text-gray-200 sm:text-sm" placeholder="Искать..." type="search" name="search">
    </form>




        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="transform opacity-100 scale-100"
             x-transition:leave-end="transform opacity-0 scale-95"
             class="absolute top-20 left-0 z-50 mt-2 w-full rounded-md shadow-lg"
             style="display: none;">

            <div class="rounded-md z-30 ring-1 ring-black ring-opacity-5 bg-zinc-900/80 backdrop-blur-3xl min-h-28">


                @if($searchText === '?')
                    <div wire:transition.duration.300ms class="flex w-full px-6 py-14 text-center sm:px-14">


                        <div class="md:w-5/12">
                            <h2 class="text-xl font-bold text-white">О поиске</h2>
                            <p class="mt-4 text-left text-sm text-gray-200">Модуль поиска может не только искать проекты или задачи внутри
                                вашей команды, но и упростить навигацию в приложении. Вы можете ввести название быстрой команды, и вам
                                будет сразу предложено перейти к ее выполнению</p>
                        </div>

                        <div class="md:w-7/12">
                            <div class="my-6 flex flex-wrap gap-6">
                                <div x-transition:enter="transition ease-out duration-600" wire:click="clickToHint('Создать задачу')" class="rounded-lg bg-gradient-to-r from-violet-900 to-zinc-800 px-6 py-2 text-white">Создать задачу</div>
                                <div wire:click="clickToHint('Перейти на главную')" class="rounded-lg bg-gradient-to-r from-violet-900 to-zinc-800 px-6 py-2 text-white">Перейти на главную</div>
                                <div wire:click="clickToHint('Клиенты')" class="rounded-lg bg-gradient-to-r from-violet-900 to-zinc-800 px-6 py-2 text-white">Клиенты</div>
                                <div wire:click="clickToHint('Задачи')" class="rounded-lg bg-gradient-to-r from-violet-900 to-zinc-800 px-6 py-2 text-white">Задачи</div>
                                <div wire:click="clickToHint('Просмотр проектов')" class="rounded-lg bg-gradient-to-r from-violet-900 to-zinc-800 px-6 py-2 text-white">Все проекты</div>
                                <div wire:click="clickToHint('Мои задачи')" class="rounded-lg bg-gradient-to-r from-violet-900 to-zinc-800 px-6 py-2 text-white">Мои задачи</div>
                                <div wire:click="clickToHint('Перейти в настройки')" class="rounded-lg bg-gradient-to-r from-violet-900 to-zinc-800 px-6 py-2 text-white">Перейти в настройки</div>
                            </div>
                        </div>


                    </div>
                @endif

                @if($searchText != '' && $searchText != '?' && count($actions) == 0)
                    <!-- Empty state -->
                    <div wire:transition.duration.300ms class="px-6 py-14 text-center sm:px-14">
                        <svg class="mx-auto h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                        </svg>
                        <p class="mt-4 text-sm text-gray-200">Упс, ничего не нашлось. Попробуйте перефразировать запрос, это может помочь.</p>
                    </div>
                @endif

                <!-- Default state, show/hide based on command palette state. -->
                <ul class="scroll-py-2 overflow-y-auto border-b border-gray-200 divide-y divide-gray-500 divide-opacity-20">

                    @if($actions)
                    <li class="p-2">
                        <div class="flex py-4">
                        <svg class="h-6 w-6 flex-none text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                        </svg>
                        <h2 class="ml-2 font-bold dark:text-gray-200">Быстрые действия</h2>
                            </div>
                        <ul class="max-h-32 overflow-y-auto scroll-auto text-sm text-gray-400">
                            <!-- Active: "bg-gray-800 text-white" -->
                            @foreach($actions as $action)
                                <li class="">
                                    <a wire:navigate href="{{route($action['route'])}}" class="flex cursor-default select-none items-center rounded-md border border-transparent px-3 py-2 duration-300 group hover:border hover:border-gray-300">
                                                                    <span class="rounded-lg border px-2 font-light text-gray-300">{{$action['symbol']}}</span>
                                                                    <span class="ml-3 flex-auto truncate">{{$action['text']}}</span>
                                                                    <span class="ml-3 flex-none text-xs font-semibold text-gray-400"><kbd class="font-sans">/</kbd><kbd class="font-sans">></kbd></span>
                                    </a>
                                                                </li>
                                                            @endforeach

{{--                                                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group">--}}
{{--                                <svg class="h-6 w-6 flex-none text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />--}}
{{--                                </svg>--}}
{{--                                <span class="ml-3 flex-auto truncate">Add new folder...</span>--}}
{{--                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400"><kbd class="font-sans">⌘</kbd><kbd class="font-sans">F</kbd></span>--}}
{{--                            </li>--}}
{{--                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group">--}}
{{--                                <svg class="h-6 w-6 flex-none text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />--}}
{{--                                </svg>--}}
{{--                                <span class="ml-3 flex-auto truncate">Add hashtag...</span>--}}
{{--                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400"><kbd class="font-sans">⌘</kbd><kbd class="font-sans">H</kbd></span>--}}
{{--                            </li>--}}
{{--                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group">--}}
{{--                                <svg class="h-6 w-6 flex-none text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />--}}
{{--                                </svg>--}}
{{--                                <span class="ml-3 flex-auto truncate">Add label...</span>--}}
{{--                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400"><kbd class="font-sans">⌘</kbd><kbd class="font-sans">L</kbd></span>--}}
{{--                            </li>--}}
                        </ul>
                    </li>
                    @endif
                    @if($clients)
                    <li class="p-2">
                                <div class="flex py-4">
                                    <svg class="h-6 w-6 flex-none text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                                     </svg>
                            <h2 class="ml-2 font-bold dark:text-gray-200">Клиенты</h2>
                        </div>
                        <ul class="text-sm text-gray-400">
                            <!-- Active: "bg-gray-800 text-white" -->
                            @foreach($clients as $client)
                                <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group">
                                    <!-- Active: "text-white", Not Active: "text-gray-500" -->
                                    <span class="ml-3 flex-auto truncate">{{$client['name']}}</span>
                                    <span class="ml-3 flex-none text-xs font-semibold text-gray-400"><kbd class="font-sans">></kbd></span>
                                </li>
                            @endforeach

                            {{--                                                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group">--}}
                                    {{--                                <svg class="h-6 w-6 flex-none text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
                                    {{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />--}}
                                    {{--                                </svg>--}}
                                    {{--                                <span class="ml-3 flex-auto truncate">Add new folder...</span>--}}
                                    {{--                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400"><kbd class="font-sans">⌘</kbd><kbd class="font-sans">F</kbd></span>--}}
                                    {{--                            </li>--}}
                                    {{--                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group">--}}
                                    {{--                                <svg class="h-6 w-6 flex-none text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
                                    {{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />--}}
                                    {{--                                </svg>--}}
                                    {{--                                <span class="ml-3 flex-auto truncate">Add hashtag...</span>--}}
                                    {{--                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400"><kbd class="font-sans">⌘</kbd><kbd class="font-sans">H</kbd></span>--}}
                                    {{--                            </li>--}}
                                    {{--                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group">--}}
                                    {{--                                <svg class="h-6 w-6 flex-none text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
                                    {{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />--}}
                                    {{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />--}}
                                    {{--                                </svg>--}}
                                    {{--                                <span class="ml-3 flex-auto truncate">Add label...</span>--}}
                                    {{--                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400"><kbd class="font-sans">⌘</kbd><kbd class="font-sans">L</kbd></span>--}}
                                    {{--                            </li>--}}
                                </ul>
                            </li>
                        @endif
                        @if($clients)
                            <li class="p-2">
                                <div class="flex py-4">
                                    <svg class="h-6 w-6 flex-none text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                                                        </svg>
                                    <h2 class="ml-2 font-bold dark:text-gray-200">Проекты</h2>
                                </div>
                                <ul class="text-sm text-gray-400">
                                    <!-- Active: "bg-gray-800 text-white" -->
                                    @foreach($clients as $client)
                                        <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group">
                                            <!-- Active: "text-white", Not Active: "text-gray-500" -->
                                            <span class="ml-3 flex-auto truncate">{{$client['name']}}</span>
                                            <span class="ml-3 flex-none text-xs font-semibold text-gray-400"><kbd class="font-sans">></kbd></span>
                                        </li>
                                    @endforeach

                                    {{--                                                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group">--}}
                                    {{--                                <svg class="h-6 w-6 flex-none text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
                                    {{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />--}}
                                    {{--                                </svg>--}}
                                    {{--                                <span class="ml-3 flex-auto truncate">Add new folder...</span>--}}
                                    {{--                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400"><kbd class="font-sans">⌘</kbd><kbd class="font-sans">F</kbd></span>--}}
                                    {{--                            </li>--}}
                                    {{--                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group">--}}
                                    {{--                                <svg class="h-6 w-6 flex-none text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
                                    {{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />--}}
                                    {{--                                </svg>--}}
                                    {{--                                <span class="ml-3 flex-auto truncate">Add hashtag...</span>--}}
                                    {{--                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400"><kbd class="font-sans">⌘</kbd><kbd class="font-sans">H</kbd></span>--}}
                                    {{--                            </li>--}}
                                    {{--                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group">--}}
                                    {{--                                <svg class="h-6 w-6 flex-none text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
                                    {{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />--}}
                                    {{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />--}}
                                    {{--                                </svg>--}}
                                    {{--                                <span class="ml-3 flex-auto truncate">Add label...</span>--}}
                                    {{--                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400"><kbd class="font-sans">⌘</kbd><kbd class="font-sans">L</kbd></span>--}}
                                    {{--                            </li>--}}
                                </ul>
                            </li>
                        @endif
                </ul>


                <div class="flex flex-wrap items-center px-4 text-xs text-gray-300 py-2.5">Введите <kbd class="mx-1 flex h-5 w-5 items-center justify-center rounded border border-gray-400 bg-white font-semibold text-gray-900 sm:mx-2">?</kbd><span class="hidden sm:inline">для просмотра справки по поиску</span> </div>

            </div>

<!-- -->

    </div>
</div>


<div class="lg:flex lg:h-full lg:flex-col bg-zinc-900/80 backdrop-blur-lg rounded-xl">
    <header class="flex items-center justify-between border-b border-white px-6 py-4 lg:flex-none">
        <div class="flex space-x-6 text-gray-300">
            <div class="flex items-center">
                <div class="w-2 h-2 mr-1 rounded-full  bg-blue-500"></div>
                <div class="text-sm">задачи</div>
            </div>

            <div class="flex items-center">
                <div class="w-2 h-2 mr-1 rounded-full  bg-yellow-500"></div>
                <div class="text-sm">спринты</div>
            </div>

            <div class="flex items-center">
                <div class="w-2 h-2 mr-1 rounded-full  bg-violet-500"></div>
                <div class="text-sm">запланированные события</div>
            </div>

        </div>
        <div class="flex items-center">
            <div x-data="{ open:false }" class="hidden md:ml-4 md:flex md:items-center">
                <div class="relative">
                    <div x-show="open"
                         class="absolute right-0 z-10 mt-3 w-36 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-hidden"
                         role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                            <button @click="open = !open" wire:click="changeViewType('day')"
                                    class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                    id="menu-item-0">День
                            </button>
                            <button @click="open = !open" wire:click="changeViewType('week')"
                                    class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                    id="menu-item-1">Неделя
                            </button>
                            <button @click="open = !open" wire:click="changeViewType('month')"
                                    class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                    id="menu-item-2">Месяц
                            </button>
                            <button @click="open = !open" wire:click="changeViewType('year')"
                                    class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                    id="menu-item-3">Год
                            </button>
                        </div>
                    </div>
                </div>
                <div class="ml-6 h-6 w-px bg-gray-300"></div>
                <a href="{{ route('event.create') }}" wire:navigate
                   class="ml-6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Добавить
                    событие</a>
            </div>
            <div class="relative ml-6 md:hidden">
                <button type="button"
                        class="-mx-2 flex items-center rounded-full border border-transparent p-2 text-gray-400 hover:text-gray-500"
                        id="menu-0-button" aria-expanded="false" aria-haspopup="true">
                    <span class="sr-only">Open menu</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path
                            d="M3 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM8.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15.5 8.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z"/>
                    </svg>
                </button>
                <div
                    class="absolute right-0 z-10 mt-3 w-36 origin-top-right divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-hidden"
                    role="menu" aria-orientation="vertical" aria-labelledby="menu-0-button" tabindex="-1">
                    <div class="py-1" role="none">
                        <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                           id="menu-0-item-0">Create event</a>
                    </div>
                    <div class="py-1" role="none">
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                           id="menu-0-item-1">Go to today</a>
                    </div>
                    <div class="py-1" role="none">
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                           id="menu-0-item-2">Day view</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                           id="menu-0-item-3">Week view</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                           id="menu-0-item-4">Month view</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                           id="menu-0-item-5">Year view</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="shadow-sm ring-1 ring-black ring-opacity-5 lg:flex lg:flex-auto lg:flex-col">
        <div
            class="grid grid-cols-7 gap-px border-b border-white  text-center text-xs font-semibold leading-6 text-white lg:flex-none">
            <div class="flex justify-center  py-2">
                <span>П</span>
                <span class="sr-only sm:not-sr-only">н</span>
            </div>
            <div class="flex justify-center  py-2">
                <span>В</span>
                <span class="sr-only sm:not-sr-only">т</span>
            </div>
            <div class="flex justify-center py-2">
                <span>С</span>
                <span class="sr-only sm:not-sr-only">р</span>
            </div>
            <div class="flex justify-center py-2">
                <span>Ч</span>
                <span class="sr-only sm:not-sr-only">т</span>
            </div>
            <div class="flex justify-center py-2">
                <span>П</span>
                <span class="sr-only sm:not-sr-only">т</span>
            </div>
            <div class="flex justify-center py-2">
                <span>С</span>
                <span class="sr-only sm:not-sr-only">б</span>
            </div>
            <div class="flex justify-center py-2">
                <span>В</span>
                <span class="sr-only sm:not-sr-only">с</span>
            </div>
        </div>
        <div class="flex backdrop-blur-xl  text-xs leading-6 text-white lg:flex-auto">

            {{--            lg:gap-px--}}
            <div class="hidden w-full lg:grid lg:grid-cols-7 lg:grid-rows-6  min-h-96">

                @foreach($calendar_data as $data)
                    <div
                        class="relative  px-3 py-2 border border-zinc-950 duration-300 hover:shadow-xl hover:shadow-white/20  @if($data->month == now()->month) bg-zinc-900/80 @else bg-zinc-800/80 text-gray-50 @endif">
                        <time
                            @if($data->day == now()->day) class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white"
                            @endif datetime="2022-01-01">{{$data->day}}</time>

                        <!-- sprints -->
                        <ol class="mt-2 space-y-1">
                            @foreach($this->getSprintsForDate($data) as $sprint)
                                @php
                                    $isDeadline = $data->toDateString() == $sprint->end_date->toDateString();
                                    $isStart = $data->toDateString() == $sprint->start_date->toDateString();
                                    $isMiddle = !$isStart && !$isDeadline;

                                    // Цвета для полос
                                    $colors = [
                                        'from-pink-400 to-pink-600',
                                        'from-blue-400 to-blue-600',
                                        'from-green-400 to-green-600',
                                        'from-yellow-400 to-yellow-600',
                                        'from-purple-400 to-purple-600',
                                        'from-rose-400 to-rose-600',
                                    ];
                                    $color = $colors[$sprint->id % count($colors)];
                                @endphp

                                <li>
                                    {{-- Полоса спринта --}}
                                   <div class="flex items-center">
                                    <div class="
                h-2 w-full
                {{ $isStart ? 'rounded-l-full' : '' }}
                {{ $isDeadline ? 'rounded-r-full' : '' }}
                {{ $isMiddle ? 'rounded-none' : '' }}
                bg-gradient-to-r {{ $color }}
            ">
                                    </div>
                                    @if($isDeadline)
                                        <span class="text-red-400 font-semibold">🚩</span>
                                    @endif
                                   </div>
                                    {{-- Название (только в начале) + метка дедлайна --}}
                                    <div class="mt-1 text-xs text-gray-300 flex justify-between items-center">
                                        @if($isStart)
                                            <span class="truncate font-medium">{{$sprint->name}}</span>
                                        @else
                                            <span></span>
                                        @endif

                                    </div>
                                </li>
                            @endforeach
                        </ol>

                        <!-- tasks -->
                        <ol class="mt-2">
                            @foreach($this->getTasksDeadlines($data) as $event)
                                <li>
                                    <a href="{{route('tasks.show', $event->id)}}" class="group flex items-center">
                                        <div class="w-2 h-2 mr-1 rounded-full  bg-blue-500"></div>
                                        <p class="flex-auto truncate font-medium text-gray-50 group-hover:text-indigo-600">{{$event->name}}</p>
                                        <time datetime="2022-02-04T21:00"
                                              class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">{{$this->getTime($event->deadline)}}</time>
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                        <!-- events -->
                        <ol class="mt-2">
                            @foreach($this->getEvents($data) as $event)
                                <li>
                                    <a href="{{route('tasks.show', $event->id)}}" class="group flex items-center">
                                        <div class="w-2 h-2 mr-1 rounded-full  bg-violet-500"></div>
                                        <p class="flex-auto truncate font-medium text-gray-50 group-hover:text-indigo-600">{{$event->name}}</p>
                                        <time datetime="2022-02-04T21:00"
                                              class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">{{$this->getTime($event->date_time)}}</time>
                                    </a>
                                </li>
                            @endforeach
                        </ol>

                    </div>
                @endforeach

            </div>
            <div class="isolate grid w-full grid-cols-7 grid-rows-6 gap-px lg:hidden">

                <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">

                    <time datetime="2021-12-27" class="ml-auto">27</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                    <time datetime="2021-12-28" class="ml-auto">28</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                    <time datetime="2021-12-29" class="ml-auto">29</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                    <time datetime="2021-12-30" class="ml-auto">30</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                    <time datetime="2021-12-31" class="ml-auto">31</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-01" class="ml-auto">1</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-02" class="ml-auto">2</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-03" class="ml-auto">3</time>
                    <span class="sr-only">2 events</span>
                    <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
          </span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-04" class="ml-auto">4</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-05" class="ml-auto">5</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-06" class="ml-auto">6</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-07" class="ml-auto">7</time>
                    <span class="sr-only">1 event</span>
                    <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
          </span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-08" class="ml-auto">8</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-09" class="ml-auto">9</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-10" class="ml-auto">10</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-11" class="ml-auto">11</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 font-semibold text-indigo-600 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-12" class="ml-auto">12</time>
                    <span class="sr-only">1 event</span>
                    <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
          </span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-13" class="ml-auto">13</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-14" class="ml-auto">14</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-15" class="ml-auto">15</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-16" class="ml-auto">16</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-17" class="ml-auto">17</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-18" class="ml-auto">18</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-19" class="ml-auto">19</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-20" class="ml-auto">20</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-21" class="ml-auto">21</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 font-semibold text-white hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-22"
                          class="ml-auto flex h-6 w-6 items-center justify-center rounded-full bg-gray-900">22
                    </time>
                    <span class="sr-only">2 events</span>
                    <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
          </span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-23" class="ml-auto">23</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-24" class="ml-auto">24</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-25" class="ml-auto">25</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-26" class="ml-auto">26</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-27" class="ml-auto">27</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-28" class="ml-auto">28</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-29" class="ml-auto">29</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-30" class="ml-auto">30</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-01-31" class="ml-auto">31</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-02-01" class="ml-auto">1</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-02-02" class="ml-auto">2</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-02-03" class="ml-auto">3</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-02-04" class="ml-auto">4</time>
                    <span class="sr-only">1 event</span>
                    <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
          </span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-02-05" class="ml-auto">5</time>
                    <span class="sr-only">0 events</span>
                </button>
                <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                    <time datetime="2022-02-06" class="ml-auto">6</time>
                    <span class="sr-only">0 events</span>
                </button>
            </div>
        </div>
    </div>
    <div class="px-4 py-10 sm:px-6 lg:hidden">
        <ol class="divide-y divide-gray-100 overflow-hidden rounded-lg bg-white text-sm shadow-sm ring-1 ring-black ring-opacity-5">
            <li class="group flex p-4 pr-6 focus-within:bg-gray-50 hover:bg-gray-50">
                <div class="flex-auto">
                    <p class="font-semibold text-gray-900">Maple syrup museum</p>
                    <time datetime="2022-01-15T09:00" class="mt-2 flex items-center text-gray-700">
                        <svg class="mr-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z"
                                  clip-rule="evenodd"/>
                        </svg>
                        3PM
                    </time>
                </div>
                <a href="#"
                   class="ml-6 flex-none self-center rounded-md bg-white px-3 py-2 font-semibold text-gray-900 opacity-0 shadow-xs ring-1 ring-inset ring-gray-300 hover:ring-gray-400 focus:opacity-100 group-hover:opacity-100">Edit<span
                        class="sr-only">, Maple syrup museum</span></a>
            </li>
            <li class="group flex p-4 pr-6 focus-within:bg-gray-50 hover:bg-gray-50">
                <div class="flex-auto">
                    <p class="font-semibold text-gray-900">Hockey game</p>
                    <time datetime="2022-01-22T19:00" class="mt-2 flex items-center text-gray-700">
                        <svg class="mr-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z"
                                  clip-rule="evenodd"/>
                        </svg>
                        7PM
                    </time>
                </div>
                <a href="#"
                   class="ml-6 flex-none self-center rounded-md bg-white px-3 py-2 font-semibold text-gray-900 opacity-0 shadow-xs ring-1 ring-inset ring-gray-300 hover:ring-gray-400 focus:opacity-100 group-hover:opacity-100">Edit<span
                        class="sr-only">, Hockey game</span></a>
            </li>
        </ol>
    </div>
</div>

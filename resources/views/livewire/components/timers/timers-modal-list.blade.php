<div x-data="{ open_timers:false}"
     @show_timers.window="open_timers = true"
>
    <button @click="open_timers = true" type="button" class="relative z-30 rounded-full text-gray-400 -m-2.5 p-2.5 hover:text-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="grey"
             class="rounded-full shadow shadow-sky-700/40 size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        @if($active_timer)
        <div class="absolute inset-2 z-20 animate-ping rounded-full shadow-md shadow-sky-700/80"></div>
        @endif
    </button>

    <!-- вот тут начинается модалка -->
    @teleport('body')
    <div x-show="open_timers"
         class="fixed left-0 z-40">
        <div class="fixed inset-0 bg-zinc-900/60 backdrop-blur-sm transition-opacity"></div>

        {{--            <div class="fixed inset-0 h-screen w-screen bg-zinc-800/80 backdrop-blur-lg transition-opacity"></div>--}}

        <div class="overflow-hidden">

            <div class="inset-0 overflow-hidden">

                <div class="pointer-events-none fixed inset-y-0 right-0 flex h-screen max-w-full pl-10">

                    <div class="pointer-events-auto w-screen max-w-md">
                        <div x-show="open_timers"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0"
                             x-transition:enter-end="transform opacity-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="transform opacity-100"
                             x-transition:leave-end="transform opacity-0"
                             @click.away="open_timers = false" @close.stop="open_timers = false"
                             @keyup.escape="open_timers = false"
                             class="flex h-full flex-col overflow-y-scroll bg-zinc-900/60 py-6 backdrop-blur">
                            <div class="px-4 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-base leading-6 text-sky-700 uppercase font-light" id="slide-over-title">Тайм-менеджмент</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button @click="open_timers = !open_timers" type="button"
                                                class="relative rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            <span class="absolute -inset-2.5"></span>
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                 stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="relative mt-6 flex-1 px-4 space-y-6 sm:px-6">
                                <!-- timers -->
<style>
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .animate-gradient {
        background-size: 400% 400%;
        animation: gradient 10s ease infinite;
    }
    @keyframes fade-in {
        0% { opacity: 0; transform: translateY(10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.8s ease-out forwards;
    }


    @keyframes slow-spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .animate-slow-spin {
        animation: slow-spin 60s linear infinite;
    }

</style>
                                <!-- active timer -->

                                <div class="h-1/3" x-data="{ show: true }" x-show="show" x-transition>
                                    <div class="relative h-full w-auto rounded-3xl overflow-hidden shadow-xl border-2 border-white/5 @if(!$active_timer) border-red-600 @endif">

                                        <!-- Animated background -->
{{--                                        <div class="absolute inset-0 @if($active_timer) animate-gradient @endif bg-gradient-to-br from-teal-700 via-cyan-600 to-indigo-700 opacity-80 blur-sm"></div>--}}
                                        <div class="absolute inset-0 @if($active_timer) animate-gradient @endif bg-gradient-to-br from-zinc-900/20 via-gray-700/20 to-zinc-600 opacity-80 blur-sm"></div>

                                        <!-- Foreground content -->
                                        <div class="relative z-10 h-full w-full flex items-center justify-center p-6 bg-zinc-900/70 backdrop-blur-xl rounded-3xl">

                                            <div wire:poll.30s.visible class="w-full text-white">
                                                @if($active_timer)
                                                    <div class="mb-4 text-center opacity-0 animate-fade-in delay-100">
                                                        <a wire:navigate href="{{ route('tasks.show', $active_timer->task?->id) }}"
                                                           class="flex items-center justify-center space-x-2 text-base font-medium text-white hover:text-opacity-75 transition">
                                                            <span>{{ $active_timer->task?->name }}</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24"
                                                                 stroke="currentColor" stroke-width="1.5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                            </svg>
                                                        </a>
                                                    </div>

                                                    <div class="relative flex justify-center gap-6 mt-2 opacity-0 animate-fade-in delay-200"
                                                         x-data="{ h: '{{ $active_timer->getDurationString()['h'] }}', m: '{{ $active_timer->getDurationString()['m'] }}' }"
                                                         x-init="
                            setInterval(() => {
                                h = '{{ $active_timer->getDurationString()['h'] }}';
                                m = '{{ $active_timer->getDurationString()['m'] }}';
                            }, 30000);
                         ">

                                                        <!-- Clockwork Gear Background -->
                                                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none blur-sm z-0 opacity-40">
                                                            <svg class="w-72 h-72 animate-slow-spin text-white/10" viewBox="0 0 100 100" fill="none">
                                                                <g transform="translate(50,50)">
                                                                    <circle r="30" stroke="currentColor" stroke-width="4" fill="none" />
                                                                    <g stroke="currentColor" stroke-width="2">
                                                                        @for($i = 0; $i < 12; $i++)
                                                                            <line x1="0" y1="-20" x2="0" y2="-27" transform="rotate({{ $i * 30 }})" />
                                                                        @endfor
                                                                    </g>
                                                                    <line x1="0" y1="0" x2="0" y2="-20" stroke="currentColor" stroke-width="2" />
                                                                    <line x1="0" y1="0" x2="12" y2="0" stroke="currentColor" stroke-width="2" />
                                                                </g>
                                                            </svg>
                                                        </div>



{{--                                                        <div class="z-10 bg-zinc-100/90 backdrop-blur-md p-4 rounded-xl shadow-inner shadow-zinc-300">--}}
{{--                                                            <div class="text-4xl font-mono font-bold text-black transition-all duration-300 ease-out" x-text="h"></div>--}}
{{--                                                            <div class="text-sm text-center text-gray-700">часов</div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="z-10 bg-zinc-100/90 backdrop-blur-md p-4 rounded-xl shadow-inner shadow-zinc-300">--}}
{{--                                                            <div class="text-4xl font-mono font-bold text-black transition-all duration-300 ease-out" x-text="m"></div>--}}
{{--                                                            <div class="text-sm text-center text-gray-700">минут</div>--}}
{{--                                                        </div>--}}


                                                        <div class="z-10 bg-zinc-500/10 border-2 border-white/5 backdrop-blur-md p-4 rounded-xl">
                                                            <div class="text-4xl font-mono font-bold text-white transition-all duration-300 ease-out" x-text="h"></div>
                                                            <div class="text-sm text-center text-gray-500">часов</div>
                                                        </div>
                                                        <div class="z-10 bg-zinc-500/10 border-2 border-white/5 backdrop-blur-md p-4 rounded-xl">
                                                            <div class="text-4xl font-mono font-bold text-white transition-all duration-300 ease-out" x-text="m"></div>
                                                            <div class="text-sm text-center text-gray-500">минут</div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-6 flex justify-center gap-6 opacity-0 animate-fade-in delay-300">
{{--                                                        <button wire:confirm="Вы уверены, что хотите остановить этот таймер?"--}}
{{--                                                                wire:click="stop({{ $active_timer->id }})"--}}
{{--                                                                class="rounded-full p-3 bg-red-600 hover:bg-red-700 transition shadow-lg border-4 border-transparent hover:border-red-600">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-white" fill="none"--}}
{{--                                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">--}}
{{--                                                                <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                                      d="M5.25 7.5A2.25 2.25 0 0 1 7.5 5.25h9a2.25 2.25 0 0 1 2.25 2.25v9a2.25 2.25 0 0 1-2.25 2.25h-9a2.25 2.25 0 0 1-2.25-2.25v-9Z"/>--}}
{{--                                                            </svg>--}}
{{--                                                        </button>--}}

{{--                                                        <button wire:click="pauseActiveTimer"--}}
{{--                                                                class="rounded-full p-3 bg-yellow-500 hover:bg-yellow-600 transition shadow-lg border-4 border-transparent hover:border-yellow-500">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-white" fill="none"--}}
{{--                                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">--}}
{{--                                                                <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                                      d="M15.75 5.25v13.5m-7.5-13.5v13.5"/>--}}
{{--                                                            </svg>--}}
{{--                                                        </button>--}}

                                                        <button wire:confirm="Вы уверены, что хотите остановить этот таймер?"
                                                                wire:click="stop({{ $active_timer->id }})"
                                                                class="rounded-full p-3 bg-zinc-500/10 shadow-red-600/40 hover:bg-red-700 transition shadow-md border-4 border-transparent hover:border-red-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-white" fill="none"
                                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M5.25 7.5A2.25 2.25 0 0 1 7.5 5.25h9a2.25 2.25 0 0 1 2.25 2.25v9a2.25 2.25 0 0 1-2.25 2.25h-9a2.25 2.25 0 0 1-2.25-2.25v-9Z"/>
                                                            </svg>
                                                        </button>

                                                        <button wire:click="pauseActiveTimer"
                                                                class="rounded-full p-3 bg-zinc-500/10 shadow-yellow-500/40 hover:bg-yellow-600 transition shadow-md border-4 border-transparent hover:border-yellow-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-white" fill="none"
                                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M15.75 5.25v13.5m-7.5-13.5v13.5"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="text-center space-y-4 opacity-0 animate-fade-in delay-100">
                                                        <p class="text-lg font-medium text-white">Нет активных таймеров 😢</p>
                                                        <a wire:navigate href="{{ route('tasks') }}"
                                                           class="inline-flex items-center justify-center rounded-full bg-green-600 hover:bg-green-700 transition p-3 shadow-lg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-white" fill="none"
                                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{--                                <div class="h-1/3">--}}
{{--                                    <div class="h-full w-auto rounded-full border @if(!$active_timer) border-red-700 @endif bg-gradient-to-r from-teal-700 to-cyan-700 p-6">--}}
{{--                                        <div class="flex h-full w-full items-center justify-center rounded-full bg-zinc-900  p-6">--}}
{{--                                            <div wire:poll.30s.visible class="">--}}
{{--                                                @if($active_timer)--}}
{{--                                                    <div class="mb-2 flex w-full">--}}
{{--                                                        <a wire:navigate href="{{route('tasks.show',  $active_timer->task?->id)}}"  class="mx-auto flex items-center text-center text-sm text-white space-x-1 hover:text-opacity-75">--}}
{{--                                                            <span>--}}
{{--                                                                 {{$active_timer->task?->name}}--}}
{{--                                                            </span>--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">--}}
{{--                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />--}}
{{--                                                            </svg>--}}
{{--                                                        </a>--}}

{{--                                                    </div>--}}

{{--                                                    <div class="mx-auto my-auto items-center justify-center flex text-3xl font-bold text-white space-x-2">--}}
{{--                                                      <div class="rounded-lg bg-gradient-to-b from-white to-zinc-300 p-2">--}}
{{--                                                          <div class="animate-pulse text-center font-mono text-black">--}}
{{--                                                              {{  $active_timer->getDurationString()['h'] }}--}}
{{--                                                          </div>--}}
{{--                                                         <p class="text-sm text-gray-600">часов</p>--}}
{{--                                                      </div>--}}
{{--                                                      <div class="rounded-lg bg-gradient-to-b from-white to-zinc-300 p-2">--}}
{{--                                                            <div class="animate-pulse text-center font-mono text-black">--}}
{{--                                                                {{  $active_timer->getDurationString()['m'] }}--}}
{{--                                                            </div>--}}
{{--                                                            <p class="text-sm text-gray-600">минут</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="mx-auto mt-2 flex w-full justify-center space-x-2">--}}

{{--                                                        <button wire:confirm="Вы уверены, что хотите остановить этот таймер?" wire:click="stop({{$active_timer->id}})">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                                                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="red"--}}
{{--                                                                 class="size-6">--}}
{{--                                                                <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                                      d="M5.25 7.5A2.25 2.25 0 0 1 7.5 5.25h9a2.25 2.25 0 0 1 2.25 2.25v9a2.25 2.25 0 0 1-2.25 2.25h-9a2.25 2.25 0 0 1-2.25-2.25v-9Z"/>--}}
{{--                                                            </svg>--}}
{{--                                                        </button>--}}
{{--                                                        <button wire:click="pauseActiveTimer">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                                                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="yellow"--}}
{{--                                                                 class="size-6">--}}
{{--                                                                <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                                      d="M15.75 5.25v13.5m-7.5-13.5v13.5"/>--}}
{{--                                                            </svg>--}}
{{--                                                        </button>--}}

{{--                                                    </div>--}}
{{--                                                @else--}}
{{--                                                    <div class="mx-auto my-auto text-center text-white text-sm">--}}
{{--                                                    Нет активных таймеров 😢--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mx-auto flex w-full justify-center space-x-2">--}}

{{--                                                        <a wire:navigate href="{{route('tasks')}}">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                                                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="green"--}}
{{--                                                                 class="size-6">--}}
{{--                                                                <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                                      d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"/>--}}
{{--                                                            </svg>--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}


                                <!-- paused timers -->
                                @if($paused_timers?->count() > 0)
                                <div>
                                <div class="font-light text-sm uppercase text-gray-100 my-4">
                                    Приостановленные таймеры:
                                </div>
                                @foreach($paused_timers as $timer)
                                    <div wire:key="{{uuid_create()}}"
                                         class="my-2 flex w-full justify-between rounded-xl border border-white/5 px-4 py-2 space-x-2 bg-gradient-to-r from-zinc-900/20 via-zinc-700/20 to-gray-800/20">

                                        <div class="flex space-x-2">
                                            <!-- buttons -->
                                            <div class="flex space-x-2">

                                                <button class="disabled:opacity-25" wire:click="continue({{$timer->id}})" @if($active_timer) disabled @endif>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="green"
                                                         class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"/>
                                                    </svg>
                                                </button>

                                                <button wire:click="stop({{$timer->id}})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                                         class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M5.25 7.5A2.25 2.25 0 0 1 7.5 5.25h9a2.25 2.25 0 0 1 2.25 2.25v9a2.25 2.25 0 0 1-2.25 2.25h-9a2.25 2.25 0 0 1-2.25-2.25v-9Z"/>
                                                    </svg>
                                                </button>

                                            </div>

                                            <div class="text-white font-mono">{{ implode(':', $timer->getDurationString()) }}</div>
                                        </div>


                                        <a wire:navigate href="{{route('tasks.show', $timer->task?->id )}}" class="text-gray-400 text-sm underline">{{$timer->task?->name}}</a>
                                    </div>
                                @endforeach
                                </div>
                                @endif
                                <!-- stopped timers -->
                                @if($stopped_timers?->count() > 0)
                                <div>

                                <div  class="font-light text-sm uppercase text-gray-100 my-4">
                                    Завершенные таймеры:
                                </div>
                                @foreach($stopped_timers as $timer)
                                        <div wire:key="{{uuid_create()}}"
                                             class="my-2 flex w-full justify-between rounded-xl border border-white/5 px-4 py-2 space-x-2">



                                                <div class="text-white font-mono">{{ implode(':', $timer->getDurationString()) }}</div>


                                            <a wire wire:navigate href="{{route('tasks.show', $timer->task?->id )}}" class="text-gray-400 text-sm underline">{{$timer->task?->name}}</a>
                                        </div>
                                @endforeach
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endteleport
</div>


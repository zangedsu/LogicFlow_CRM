<div x-data="{ open_timers:false}">
    <button @click="open_timers = true" type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
        <span class="sr-only">View notifications</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="grey" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    </button>

    <!-- вот тут начинается модалка -->
        <div x-show="open_timers"
             class="relative z-50 " >

            <div class="fixed inset-0 bg-zinc-800 bg-opacity-75 transition-opacity"></div>

            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">

                        <div class="pointer-events-auto w-screen max-w-md">
                            <div x-show="open_timers"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0"
                                 x-transition:enter-end="transform opacity-100"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="transform opacity-100"
                                 x-transition:leave-end="transform opacity-0"
                                @click.away="open_timers = false" @close.stop="open_timers = false" @keyup.escape="open_timers = false"
                                class="flex h-full flex-col overflow-y-scroll bg-zinc-900/80 backdrop-blur-lg py-6 shadow-xl">
                                <div class="px-4 sm:px-6">
                                    <div class="flex items-start justify-between">
                                        <h2 class="text-base font-semibold leading-6 text-white" id="slide-over-title">Ваши таймеры</h2>
                                        <div class="ml-3 flex h-7 items-center">
                                            <button @click="open_timers = !open_timers"  type="button" class="relative rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                <span class="absolute -inset-2.5"></span>
                                                <span class="sr-only">Close panel</span>
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative mt-6 flex-1 px-4 sm:px-6">
                                    <!-- timers -->

                                    <!-- active timer -->

                <div class="h-1/3">
                    <div class="border rounded-full h-full p-6 ">
                        <div class="border border-dashed  rounded-full w-full h-full p-6 flex justify-center items-center">
                            <div class="text-3xl animate-none font-bold text-white">
                                {{$active_timer?->getDurationString()}}
                                {{$test}}
                                <button wire:click="plus">+++</button>
                                <div class="flex space-x-2">

                                        <button  wire:click="start">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                            </svg>
                                        </button>

                                        <button wire:click="stop">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 7.5A2.25 2.25 0 0 1 7.5 5.25h9a2.25 2.25 0 0 1 2.25 2.25v9a2.25 2.25 0 0 1-2.25 2.25h-9a2.25 2.25 0 0 1-2.25-2.25v-9Z" />
                                            </svg>
                                        </button>
                                        <button wire:click="pauseActiveTimer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="yellow" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
                                            </svg>
                                        </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                                    <div class="font-bold text-white">
                                        Приостановленные таймеры:
                                    </div>
                                    @foreach($paused_timers as $timer)
                                        <div wire:key="{{uuid_create()}}" class="w-full justify-between flex space-x-2 py-2 px-4 rounded-xl border my-2">
                                            <div class="text-white">{{$timer->getDurationString()}}</div>
                                            <div class="text-white">{{$timer->task?->name}}</div>
                                        </div>
                                    @endforeach

                                    <div wire:poll class="font-bold text-white">
                                        Завершенные таймеры:
                                    </div>
                                    @foreach($stopped_timers as $timer)
                                        <div  wire:key="{{uuid_create()}}" class="w-full flex space-x-2 py-2 px-4 rounded-xl border my-2">
                                            <div class="text-white">{{$timer->getDurationString()}}</div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>


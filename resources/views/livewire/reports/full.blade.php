<div class="flex flex-wrap md:grid-cols-3 md:grid gap-4 ">
    <!-- filter -->
    <x-section class="w-full z-30 flex md:col-span-3 justify-between">

        <!-- selects -->
        <div class="flex space-x-4 ">
            <!-- select project -->
            <div x-data="{ open : false }" @click.away="open = false" @close.stop="open = false"
                 @keyup.escape="open = false">

                <div class="relative">
                    <input wire:model.live="search_project_input" @click="open = true " id="combobox" type="text"
                           placeholder="Все проекты"
                           class="w-full rounded-md border-0 bg-transparent py-1.5 pl-3 pr-12 text-gray-100 shadow-xs ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                           role="combobox" aria-controls="options" aria-expanded="false">
                    <button @click="open = ! open" type="button"
                            class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-hidden">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <ul x-transition x-show="open"
                        class="absolute z-20 mt-1 max-h-60 w-full overflow-auto rounded-md bg-zinc-900 backdrop-blur-xl py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-hidden sm:text-sm"
                        id="options" role="listbox">
                        <!--
                          Combobox option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                          Active: "text-white bg-indigo-600", Not Active: "text-gray-900"-->
                        @if($found_projects?->count() > 0)
                            <li wire:click="selectProject(null)"
                                class="relative cursor-pointer select-none py-2 pl-3 pr-9 text-gray-100" role="option">
                                <!-- Selected: "font-semibold" -->
                                <span class="block truncate">Все проекты</span>

                                <!--
                                  Checkmark, only display for selected option.

                                  Active: "text-white", Not Active: "text-indigo-600"
                                -->
                                @if(!$selected_project)
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
          <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd"
                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                  clip-rule="evenodd"/>
          </svg>
        </span>
                                @endif

                            </li>
                            @foreach($found_projects as $project)
                                <li wire:click="selectProject({{$project->id}})"
                                    class="relative cursor-pointer hover:bg-zinc-800 select-none py-2 pl-3 pr-9 text-gray-100"
                                    role="option">
                                    <!-- Selected: "font-semibold" -->
                                    <span class="block truncate">{{$project->name}}</span>

                                    <!--
                                      Checkmark, only display for selected option.

                                      Active: "text-white", Not Active: "text-indigo-600"
                                    -->
                                    @if($project = $selected_project)
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                         <path fill-rule="evenodd"
                                               d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                               clip-rule="evenodd"/>
                                    </svg>
                                </span>
                                    @endif

                                </li>
                            @endforeach
                        @endif

                        <!-- More items... -->
                    </ul>
                </div>
            </div>

            <!-- date -->
            <div>
{{--                <label for="datepicker-range-start" class="block text-sm font-medium leading-6 text-white">Дата</label>--}}
                <div class="flex items-center space-x-2 ">
                    <!-- from -->
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input wire:model.live="date_from" id="datepicker-range-start"  type="date" class="w-full rounded-md border-0 bg-transparent py-1.5 pl-3 pr-12 text-gray-100 shadow-xs ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 ps-10" placeholder="Select date start">
                    </div>
                    <span class="mx-4 text-gray-500">по</span>
                    <!-- to -->
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input wire:model.live="date_to" id="datepicker-range-end"  type="date"  class="w-full rounded-md border-0 bg-transparent py-1.5 pl-3 pr-12 text-gray-100 shadow-xs ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 ps-10" placeholder="Select date end">
                    </div>
                </div>
            </div>
        </div>


        <button wire:click="exportToCsv" class="rounded-lg px-2 bg-linear-to-r from-teal-400 to-blue-500 text-white self-end align-bottom h-10">Экспорт отчета</button>
    </x-section>


    <!-- widgets -->
    <x-section class="w-full  md:col-span-1">
{{--        @livewire('components.stat-chart',['data' => $taskStatData, 'params' => $taskStatParams])--}}
        <livewire:components.stat-chart :data="$taskStatData" :params="$taskStatParams" wire:key="{{uuid_create()}}" />
    </x-section>

    <x-section class="w-full space-y-6 md:col-span-2">
        <h2 class="font-bold text-white text-3xl">Итого времени отработано вами:</h2>
        <div class="mx-auto my-auto flex text-3xl font-bold text-white space-x-2">
            <div class="rounded-lg bg-white p-2">
                <div class="animate-pulse text-center font-mono text-black">
                    {{$time_total['h']}}
                </div>
                <p class="text-sm text-center text-gray-600">часов</p>
            </div>
            <div class="rounded-lg bg-white p-2">
                <div class="animate-pulse text-center font-mono text-black">
                    {{$time_total['m']}}
                </div>
                <p class="text-sm text-center text-gray-600">минут</p>
            </div>
            <div class="rounded-lg bg-white p-2">
                <div class="animate-pulse text-center font-mono text-black">
                    {{$time_total['s']}}
                </div>
                <p class="text-sm text-center text-gray-600">секунд</p>
            </div>
        </div>
        <!-- timers -->
        <div>
            <div  class="font-bold text-white">
                Завершенные таймеры:
            </div>
            <div class="overflow-y-auto scroll-auto max-h-32 border-b">


                @foreach($timers as $timer)
                    <div wire:key="{{uuid_create()}}" class="my-2 flex w-full justify-between rounded-xl border px-4 py-2 space-x-2">



                        <div class="text-white font-mono">{{ implode(':', $timer->getDurationString()) }}</div>


                        <a wire wire:navigate href="{{route('tasks.show', $timer->task?->id )}}" class="text-gray-400 underline">{{$timer->task?->name}}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </x-section>



</div>

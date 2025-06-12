<div class="flex flex-wrap md:grid-cols-3 md:grid gap-4 ">
    <!-- В layout-файле -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ru.js"></script>


    <!-- filter -->
    <x-section class="w-full z-30 flex flex-wrap md:col-span-3 justify-between gap-4">

        <!-- Фильтры -->
        <div class="flex flex-wrap gap-4 items-end">

            <!-- Выбор проекта -->
            <div x-data="{ open : false }" class="relative w-64">
                <input
                    wire:model.live="search_project_input"
                    @click="open = true"
                    type="text"
                    placeholder="Все проекты"
                    class="w-full rounded-lg border border-gray-700 bg-zinc-900 text-white placeholder-gray-400 pl-10 pr-10 py-2 text-sm shadow focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                />
                <button @click="open = !open" type="button" class="absolute right-2 top-2.5 text-gray-400">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.85 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.9 2.7-2.9a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>

                <!-- Список проектов -->
                <ul x-show="open"
                    x-transition
                    @click.away="open = false"
                    class="absolute z-30 w-full mt-2 bg-zinc-800 text-white rounded-md shadow-lg max-h-60 overflow-auto text-sm ring-1 ring-gray-700">

                    <li wire:click="selectProject(null)"
                        class="cursor-pointer px-4 py-2 hover:bg-zinc-700 {{ !$selected_project ? 'bg-zinc-700 text-indigo-400' : '' }}">
                        Все проекты
                    </li>

                    @foreach($found_projects as $project)
                        <li wire:click="selectProject({{ $project->id }})"
                            class="cursor-pointer px-4 py-2 hover:bg-zinc-700 {{ $selected_project && $selected_project->id === $project->id ? 'bg-zinc-700 text-indigo-400' : '' }}">
                            {{ $project->name }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Выбор даты -->
            <div class="relative w-[280px]"
                 x-data="{
                 dateRange: @entangle('date_range'),
                 setRange() {
                     if (this.dateRange && this.dateRange.includes('—')) {
                         const [from, to] = this.dateRange.split('—').map(s => s.trim());
                         $wire.set('date_from', from);
                         $wire.set('date_to', to);
                     }
                 }
             }"
                 x-init="$watch('dateRange', () => setRange())"
            >
                <input
                    wire:model.live="date_range"
                    x-ref="rangeInput"
                    x-init="flatpickr($refs.rangeInput, { mode: 'range', dateFormat: 'Y-m-d', locale: 'ru' })"
                    class="w-full rounded-lg border border-gray-700 bg-zinc-900 text-white placeholder-gray-400 pl-10 pr-4 py-2 text-sm shadow focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Выберите период"
                />
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H9V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zM2 9v8a2 2 0 002 2h12a2 2 0 002-2V9H2zm3 3h10a1 1 0 110 2H5a1 1 0 110-2z"/>
                    </svg>
                </div>
            </div>

        </div>

        <!-- Кнопка экспорта -->
        <div>
            <button
                wire:click="exportToCsv"
                class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-teal-500 to-blue-600 text-white rounded-lg text-sm font-semibold shadow hover:from-teal-600 hover:to-blue-700 transition">
                📤 Экспорт отчета
            </button>
        </div>

        <!-- Шкала года -->
        <div x-data="{
        open: false,
        from: @entangle('date_from'),
        to: @entangle('date_to'),
        yearStart: new Date(new Date().getFullYear(), 0, 1),
        yearEnd: new Date(new Date().getFullYear(), 11, 31),

        daysBetween(start, end) {
            return Math.floor((end - start) / (1000 * 60 * 60 * 24));
        },
        offsetPercent(date) {
            const total = this.daysBetween(this.yearStart, this.yearEnd);
            const offset = this.daysBetween(this.yearStart, new Date(date));
            return (offset / total) * 100;
        },
        get fromOffset() {
            return this.from ? this.offsetPercent(this.from) : 0;
        },
        get toOffset() {
            return this.to ? this.offsetPercent(this.to) : 0;
        },
        get widthOffset() {
            return this.toOffset - this.fromOffset;
        },
    }" class="w-full">

            <div class="overflow-hidden">
            <div class="relative h-7 border-t border-gray-600 mt-4">
                <!-- деления по неделям -->
                <template x-for="i in 52" :key="i">
                    <div class="absolute top-0 h-2 border-l border-gray-500" :style="`left: ${(i - 1) * (100 / 52)}%`"></div>
                </template>

                <!-- метки месяцев -->
                <template x-for="(month, index) in ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек']">
                    <div class="absolute top-2 text-xs text-gray-400" :style="`left: ${index * (100 / 12)}%`" x-text="month"></div>
                </template>

                <!-- выделение выбранного диапазона -->
                <div class="absolute top-0 h-full bg-gradient-to-r from-blue-600/60 via-teal-500/40 to-blue-600/70 animate-pulse border-l border-r  transition-all"
                     x-show="from && to"
                     :style="`left: ${fromOffset}%; width: ${widthOffset}%;`">
                </div>
            </div>
            </div>
        </div>
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

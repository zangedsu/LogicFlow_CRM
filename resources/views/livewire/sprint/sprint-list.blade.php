<div x-data="{ view: 'grid', status: 'all' }" class="space-y-4">
    {{-- Header: фильтры и переключатель видов --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-2">
            <label class="text-sm font-medium text-gray-600">Статус:</label>
            <select x-model="status" class="text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                <option value="all">Все</option>
                <option value="planned">Запланированные</option>
                <option value="active">Активные</option>
                <option value="completed">Завершённые</option>
            </select>
        </div>

        <div class="flex items-center gap-2">
            <button @click="view = 'grid'" :class="view === 'grid' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700'" class="px-3 py-1 rounded-md text-sm font-medium">Сетка</button>
            <button @click="view = 'list'" :class="view === 'list' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700'" class="px-3 py-1 rounded-md text-sm font-medium">Список</button>
        </div>
    </div>

    {{-- Контент --}}
    <div>
        {{-- GRID VIEW --}}
        <div x-show="view === 'grid'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
{{--        <div x-show="view === 'grid'" class="flex flex-wrap gap-4">--}}
            @foreach ($sprints as $sprint)
                <template x-if="status === 'all' || '{{ $sprint->status }}' === status">
                    <div x-data="{ open: false }"
                         class="border rounded-xl shadow-sm p-4 transition hover:shadow-md flex flex-col justify-between"
                         :class="{
                             'bg-red-50/80 border-red-300': '{{ $sprint->deadline_status }}' === 'overdue',
                             'bg-yellow-50/80 border-yellow-300': '{{ $sprint->deadline_status }}' === 'soon',
                             'bg-gray-50/80 border-gray-200': '{{ $sprint->deadline_status }}' === 'ok',
                         }"
                    >
                        {{-- Header --}}
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 cursor-pointer" @click="open = !open">
                                    {{ $sprint->name }}
                                </h3>
                                <a href="{{ route('sprints.show', $sprint->id) }}">VIEW</a>

                                <div class="text-sm text-gray-500">
                                    Проект: {{ $sprint->project->name ?? 'Без проекта' }}
                                </div>
                            </div>
                            <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold"
                                  :class="{
                                      'bg-blue-100 text-blue-800': '{{ $sprint->status }}' === 'planned',
                                      'bg-green-100 text-green-800': '{{ $sprint->status }}' === 'active',
                                      'bg-gray-200 text-gray-800': '{{ $sprint->status }}' === 'completed'
                                  }">
                                {{ ucfirst($sprint->status) }}
                            </span>
                        </div>

                        {{-- Dates --}}
                        <div class="text-sm text-gray-600 mt-2">
                            Завершение: {{ \Carbon\Carbon::parse($sprint->end_date)->format('d.m.Y') }}
                            @if ($sprint->deadline_status === 'overdue')
                                <span class="ml-2 text-red-600 font-semibold text-xs">⏰ Просрочен</span>
                            @elseif ($sprint->deadline_status === 'soon')
                                <span class="ml-2 text-yellow-600 font-semibold text-xs">⚠ Скоро дедлайн</span>
                            @endif
                        </div>

                        {{-- Progress --}}
                        <div class="mt-4">
                            <div class="text-xs text-gray-500 mb-1">Прогресс: {{ $sprint->progress }}%</div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="bg-indigo-500 h-full transition-all" style="width: {{ $sprint->progress }}%"></div>
                            </div>
                        </div>

                        {{-- Expanded View --}}
                        <div x-show="open" class="mt-4 text-sm text-gray-700 space-y-2">
                            @if($editingSprintId === $sprint->id)
                                <div class="space-y-2">
                                    <input type="text" wire:model.defer="editData.name" class="w-full border rounded-md px-3 py-1 text-sm" placeholder="Название">
                                    <textarea wire:model.defer="editData.description" class="w-full border rounded-md px-3 py-1 text-sm" rows="3" placeholder="Описание"></textarea>
                                    <input type="date" wire:model.defer="editData.end_date" class="w-full border rounded-md px-3 py-1 text-sm">

                                    <div class="flex gap-2">
                                        <button wire:click="updateSprint" class="px-3 py-1 bg-green-500 text-white text-xs rounded-md hover:bg-green-600">Сохранить</button>
                                        <button wire:click="cancelEditing" class="px-3 py-1 bg-gray-300 text-xs rounded-md hover:bg-gray-400">Отмена</button>
                                    </div>
                                </div>
                            @else
                                <div>
                                    <strong>Описание:</strong>
                                    <p class="mt-1">{{ $sprint->description ?: 'Нет описания' }}</p>
                                </div>

                                <div class="flex gap-2 pt-2">
                                    <button wire:click="startEditing({{ $sprint->id }})" class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-md hover:bg-blue-200 transition">Редактировать</button>
                                    <button class="px-3 py-1 bg-red-100 text-red-700 text-xs rounded-md hover:bg-red-200 transition">Удалить</button>
                                    <a wire:navigate href="{{ route('sprints.show', $sprint->id) }}" class="px-3 py-1 bg-gray-300 text-xs rounded-md hover:bg-gray-400">Просмотр</a>
                                </div>
                            @endif
                        </div>

                    </div>
                </template>
            @endforeach
        </div>

        {{-- LIST VIEW --}}
        <div x-show="view === 'list'" class="space-y-2">
            @foreach ($sprints as $sprint)
                <template x-if="status === 'all' || '{{ $sprint->status }}' === status">
                    <div x-data="{ open: false }"
                         class="border rounded-lg p-3 flex flex-col gap-2 transition hover:shadow-md"
                         :class="{
                             'bg-red-50 border-red-300': '{{ $sprint->deadline_status }}' === 'overdue',
                             'bg-yellow-50 border-yellow-300': '{{ $sprint->deadline_status }}' === 'soon',
                             'bg-white border-gray-200': '{{ $sprint->deadline_status }}' === 'ok',
                         }"
                    >
                        <div class="flex justify-between items-center">
                            <div class="flex flex-col">
                                <h3 class="font-medium text-gray-800 cursor-pointer" @click="open = !open">{{ $sprint->name }}</h3>
                                <div class="text-xs text-gray-500">Проект: {{ $sprint->project->name ?? 'Без проекта' }}</div>
                                <div class="text-sm text-gray-500">
                                    Завершение: {{ \Carbon\Carbon::parse($sprint->end_date)->format('d.m.Y') }}
                                    @if ($sprint->deadline_status === 'overdue')
                                        <span class="text-red-600 text-xs ml-2">⏰ Просрочен</span>
                                    @elseif ($sprint->deadline_status === 'soon')
                                        <span class="text-yellow-600 text-xs ml-2">⚠ Скоро дедлайн</span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-col items-end gap-1">
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold"
                                      :class="{
                                          'bg-blue-100 text-blue-800': '{{ $sprint->status }}' === 'planned',
                                          'bg-green-100 text-green-800': '{{ $sprint->status }}' === 'active',
                                          'bg-gray-200 text-gray-800': '{{ $sprint->status }}' === 'completed'
                                      }">
                                    {{ ucfirst($sprint->status) }}
                                </span>
                                <div class="w-28 bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-500 h-full" style="width: {{ $sprint->progress }}%"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Expanded --}}
                        <div x-show="open" class="text-sm text-gray-700 pt-2 space-y-2">
                            <div>
                                <strong>Описание:</strong>
                                <p class="mt-1">{{ $sprint->description ?: 'Нет описания' }}</p>
                            </div>

                            {{-- Actions --}}
                            <div class="flex gap-2">
                                <button class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-md hover:bg-blue-200 transition">Редактировать</button>
                                <button class="px-3 py-1 bg-red-100 text-red-700 text-xs rounded-md hover:bg-red-200 transition">Удалить</button>
                                <a wire:navigate href="{{ route('sprints.show', $sprint->id) }}" class="px-3 py-1 bg-gray-300 text-xs rounded-md hover:bg-gray-400">Просмотр</a>
                            </div>
                        </div>
                    </div>
                </template>
            @endforeach
        </div>
    </div>
</div>

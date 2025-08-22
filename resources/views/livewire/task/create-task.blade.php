<div class="bg-white dark:bg-zinc-900/80 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-lg p-6">
    <form class="flex flex-col" wire:submit="create">

        <input class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200"
               name="name" wire:model.blur="name" placeholder="Название задачи">
        @error('name')<div class="bg-red-900">{{ $message }}</div>@enderror

        <div>
            <div class="bg-white/20 p-2 text-white rounded-2xl" wire:ignore>
                <input id="trix-content" type="hidden" name="content" value="{{ $description }}">
                <trix-editor input="trix-content"></trix-editor>
            </div>
            <script>
                document.addEventListener('trix-change', function (event) {
                    @this.set('description', document.querySelector("input[name='content']").value);
                });
            </script>
        </div>
        @error('description')<div class="bg-red-900">{{ $message }}</div>@enderror

        <input type="datetime-local"
               class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200"
               wire:model.blur="deadline" placeholder="Дедлайн">
        @error('deadline')<div class="bg-red-900">{{ $message }}</div>@enderror

        <select class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200"
                wire:model="selected_project_id" @if($is_edit) disabled @endif>
            <option value="">Выберите проект...</option>
            @foreach($projects as $project)
                <option wire:key="{{$project->id}}" value="{{$project->id}}">
                    {{$project->name}}
                </option>
            @endforeach
        </select>
        @error('selected_project_id')<div class="bg-red-900">{{ $message }}</div>@enderror

        <div class="space-y-6">
            {{-- Ответственный --}}
            <div>
                <label class="block text-sm font-medium text-gray-900 dark:text-gray-200 mb-2">
                    Ответственный
                </label>
                <div class="flex items-center space-x-3 overflow-x-auto p-3 border rounded-xl bg-white dark:bg-zinc-900">
                    {{-- Поиск --}}
                    <input type="text" wire:model="searchResponsible"
                           placeholder="Поиск..."
                           class="flex-shrink-0 w-44 border rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-blue-500"/>

                    {{-- Список участников --}}
                    @foreach($team_users as $user)
                        <div wire:click="setResponsible({{ $user->id }})"
                             class="flex items-center gap-2 px-3 py-2 rounded-lg cursor-pointer transition
                            {{ $assignee_id === $user->id ? 'bg-blue-100 dark:bg-blue-900/40 ring-2 ring-blue-400' : 'hover:bg-gray-100 dark:hover:bg-zinc-800' }}">
                            <img  src="{{ $user->profile_photo_path ? asset('storage/'.$user->profile_photo_path) : $user->profile_photo_url }}"
                                 class="w-10 h-10 rounded-full object-cover">
                            <span class="text-sm text-gray-900 dark:text-gray-200 font-medium whitespace-nowrap">
                        {{ $user->name }}
                    </span>
                            @if($assignee_id === $user->id)
                                <span class="ml-1 text-blue-600">✓</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Участники --}}
            <div x-data="{ open: false, search: '' }">
                <button type="button" @click="open = !open"
                        class="text-sm font-medium text-blue-600 hover:underline">
                    Добавить участников
                </button>

                <div x-show="open" x-transition
                     class="mt-3 border rounded-xl p-3 bg-white dark:bg-zinc-900">
                    {{-- Поиск --}}
                    <input type="text" x-model="search"
                           placeholder="Поиск участников..."
                           class="w-full border rounded-lg px-3 py-1.5 text-sm mb-3 focus:ring-2 focus:ring-green-500"/>

                    {{-- Горизонтальный список участников --}}
                    <div class="flex space-x-3 overflow-x-auto p-2">
                        @foreach($team_users as $user)
                            @php
                                $isSelected = isset($participants[$user->id]);
                            @endphp

                            <div
                                x-show="'{{ Str::lower($user->name) }}'.includes(search.toLowerCase())"
                                x-transition
                                wire:click="toggleParticipant({{ $user->id }})"
                                class="flex flex-col items-center px-3 py-2 space-y-1 rounded-lg cursor-pointer transition relative
                       {{ $isSelected ? 'bg-green-100 dark:bg-green-900/40 ring-2 ring-green-400' : 'hover:bg-gray-100 dark:hover:bg-zinc-800' }}">

                                {{-- Аватар --}}
                                <img src="{{ $user->profile_photo_path ? asset('storage/'.$user->profile_photo_path) : $user->profile_photo_url }}"
                                     class="w-12 h-12 rounded-full object-cover">

                                {{-- Имя --}}
                                <span class="mt-1 text-xs text-gray-900 dark:text-gray-400 font-medium whitespace-nowrap">
                        {{ $user->name }}
                    </span>

                                {{-- Роль в команде --}}
                                <span class="mt-0.5 text-[10px] px-2 py-0.5 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        {{ $user->teamRole(Auth::user()->currentTeam)->name ?? 'Член команды' }}
                    </span>

                                {{-- Если выбран, показываем селект роли в задаче --}}
                                @if($isSelected)
                                    <div class="mt-1 w-full">
                                        <select wire:change="updateRole({{ $user->id }}, $event.target.value)"
                                                class="w-full text-[11px] px-1.5 py-0.5 rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-800 text-gray-700 dark:text-gray-200 focus:ring-green-500">
                                            <option value="collaborator" @selected($participants[$user->id] === 'collaborator')>Исполнитель</option>
                                            <option value="watcher" @selected($participants[$user->id] === 'watcher')>Наблюдатель</option>
                                        </select>
                                    </div>

                                    <span class="absolute top-1 right-1 bg-green-500 text-white text-xs rounded-full px-1">✓</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>




        <button class="text-white max-w-72 bg-linear-to-l from-zinc-500 to-zinc-800 rounded-lg my-4 p-2 hover:shadow-blue-400"
                type="submit">
            @if($is_edit) Обновить @else Создать @endif
        </button>
    </form>
</div>

<div class="bg-white dark:bg-zinc-900/80 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-lg p-6">

    <form class="flex flex-col" wire:submit="create">

{{--        <select class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" wire:model="selected_client_id" @if($is_edit) disabled @endif>--}}
{{--            @if($clients)--}}
{{--                @foreach($clients as $client)--}}
{{--                    <option wire:key="{{$client->id}}" value="{{$client->id}}">--}}
{{--                        {{$client->name}}--}}
{{--                    </option>--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--        </select>--}}

        <input class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" name="name" wire:model.blur="name" placeholder="Название задачи">
        @error('name')<div class="bg-red-900">{{ $message }}</div>@enderror

        <textarea type="text" class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" name="description" wire:model.blur="description" placeholder="Описание задачи"></textarea>
        @error('description')<div class="bg-red-900">{{ $message }}</div>@enderror

        <input type="datetime-local" class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" name="description" wire:model.blur="deadline" placeholder="Дедлайн"></input>
        @error('description')<div class="bg-red-900">{{ $message }}</div>@enderror

        <select class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" wire:model="selected_project_id" @if($is_edit) disabled @endif>
            @if($projects)
                @foreach($projects as $project)
                    <option wire:key="{{$project->id}}" value="{{$project->id}}">
                        {{$project->name}}
                    </option>
                @endforeach
            @endif
        </select>

        <div>

            <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Ответственныe за задачу</label>
            @if($team_users->count() != 0)
            <select wire:change="add_responsible" wire:model.live="responsible" class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200">
                <option value="null">Добавить ответственного</option>
                <option value="all_team">Вся команда</option>
                @foreach($team_users as $user)
                    <option wire:key="{{$user->id}}" value="{{$user->id }}">{{$user->name}}</option>
                @endforeach
            </select>
            @endif
            @if($responsible_users)
                <div class="flex gap-6 my-4">
                @foreach($responsible_users as $user)
                    <div class="flex border rounded bg-gray-600/80 p-4 gap-x-2 items-center"><img class="rounded-full h-8 w-8 object-cover" src="{{ $user->profile_photo_path ? asset('storage/'.$user->profile_photo_path) : $user->profile_photo_url }}">{{$user->name}}</div>
                @endforeach
                    <button type="button" wire:click="resetResponsible"  class="border rounded bg-red-600/80 p-4 items-center">Сбросить</button>
                </div>
            @else
                <div class="flex gap-6 my-4">
                    @foreach($team_users as $user)
                        <div class="flex border rounded bg-gray-600/80 p-4 gap-x-2 items-center"><img class="rounded-full h-8 w-8 object-cover" src="{{ $user->profile_photo_path ? asset('storage/'.$user->profile_photo_path) : $user->profile_photo_url }}">{{$user->name}}</div>
                    @endforeach
                    <button type="button" wire:click="resetResponsible"  class="border rounded bg-red-600/80 p-4 items-center">Сбросить</button>
                </div>
            @endif
        </div>

        {{--        <button class="text-white max-w-72 bg-gradient-to-l from-zinc-500 to-zinc-800 rounded-lg my-4 p-2 hover:shadow-blue-400" type="submit">@if($is_edit) Обновить @else Создать @endif</button>--}}
        <button class="text-white max-w-72 bg-gradient-to-l from-zinc-500 to-zinc-800 rounded-lg my-4 p-2 hover:shadow-blue-400" type="submit">  Сохранить задачу</button>
    </form>


</div>


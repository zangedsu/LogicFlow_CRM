<div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

    <form class="flex flex-col" wire:submit="createOrUpdate">

        {{--        <select class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" wire:model="selected_client_id" @if($is_edit) disabled @endif>--}}
        {{--            @if($clients)--}}
        {{--                @foreach($clients as $client)--}}
        {{--                    <option wire:key="{{$client->id}}" value="{{$client->id}}">--}}
        {{--                        {{$client->name}}--}}
        {{--                    </option>--}}
        {{--                @endforeach--}}
        {{--            @endif--}}
        {{--        </select>--}}
        <input class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" name="name" wire:model.blur="name" placeholder="Название проекта">
        @error('name')<div class="bg-red-900">{{ $message }}</div>@enderror

        <textarea type="text" class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" name="description" wire:model.blur="description" placeholder="Описание проекта"></textarea>
        @error('description')<div class="bg-red-900">{{ $message }}</div>@enderror

        <input type="date" class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" name="description" wire:model.blur="start_date" placeholder="Описание проекта"></input>
        @error('description')<div class="bg-red-900">{{ $message }}</div>@enderror

        <input type="date" class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" name="description" wire:model.blur="end_date" placeholder="Описание проекта"></input>
        @error('description')<div class="bg-red-900">{{ $message }}</div>@enderror

{{--        <select class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" wire:model="selected_project_id" >--}}
{{--            @if($projects)--}}
{{--                @foreach($projects as $project)--}}
{{--                    <option wire:key="{{$project->id}}" value="{{$project->id}}">--}}
{{--                        {{$project->name}}--}}
{{--                    </option>--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--        </select>--}}


        {{--        <button class="text-white max-w-72 bg-gradient-to-l from-zinc-500 to-zinc-800 rounded-lg my-4 p-2 hover:shadow-blue-400" type="submit">@if($is_edit) Обновить @else Создать @endif</button>--}}
        <button class="text-white max-w-72 bg-gradient-to-l from-zinc-500 to-zinc-800 rounded-lg my-4 p-2 hover:shadow-blue-400" type="submit"> Добавить задачу</button>
    </form>


</div>


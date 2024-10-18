


<div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
    <form class="flex flex-col" wire:submit="create">

        <select class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" wire:model="selected_client_id" @if($is_edit) disabled @endif>
            @if($clients)
                @foreach($clients as $client)
                    <option wire:key="{{$client->id}}" value="{{$client->id}}">
                        {{$client->name}}
                    </option>
                @endforeach
            @endif
        </select>

        <input class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" name="name" wire:model.blur="name" placeholder="Название проекта">
        @error('name')<div class="bg-red-900">{{ $message }}</div>@enderror

        <textarea type="text" class="border-gray-200 border-b border-0 bg-zinc-900 focus:ring-0 my-2 dark:text-gray-200" name="description" wire:model.blur="description" placeholder="Описание проекта"></textarea>
        @error('description')<div class="bg-red-900">{{ $message }}</div>@enderror


{{--        <label for="cover-photo" class="block text-sm font-medium leading-6 text-white">Прикрепить файлы к проекту</label>--}}
{{--        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-white/25 px-6 py-10">--}}
{{--            <div class="text-center">--}}
{{--                <svg class="mx-auto h-12 w-12 text-gray-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">--}}
{{--                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />--}}
{{--                </svg>--}}
{{--                <div class="mt-4 flex text-sm leading-6 text-gray-400">--}}
{{--                    <label for="file-upload" class="relative cursor-pointer rounded-md bg-gray-900 font-semibold text-white focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:ring-offset-gray-900 hover:text-indigo-500">--}}
{{--                        <span>Загрузить файл</span>--}}
{{--                        <input id="file-upload" wire:model="photo" name="file-upload" type="file" class="sr-only">--}}
{{--                    </label>--}}
{{--                    <p class="pl-1">или перетащите файл сюда</p>--}}
{{--                </div>--}}
{{--                <p class="text-xs leading-5 text-gray-400">Изображения и документы до 10 МБ</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        @error('photo')<div class="bg-red-900">{{ $message }}</div>@enderror--}}

{{--        <button class="text-white max-w-72 bg-gradient-to-l from-zinc-500 to-zinc-800 rounded-lg my-4 p-2 hover:shadow-blue-400" type="submit">@if($is_edit) Обновить @else Создать @endif</button>--}}
        <button class="text-white max-w-72 bg-gradient-to-l from-zinc-500 to-zinc-800 rounded-lg my-4 p-2 hover:shadow-blue-400" type="submit"> @if($is_edit) Обновить @else Создать @endif</button>
    </form>
</div>


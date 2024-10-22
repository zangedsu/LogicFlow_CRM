
<div class="h-screen p-2 w-full">

    <div wire:sortable-group="updateTaskStatus"  class="grid lg:grid-cols-4 overflow-x-auto md:grid-cols-4 sm:grid-cols-2 gap-2">
        <!-- new -->
        <div class="bg-zinc-900 border border-dashed border-yellow-700 rounded-xl px-2 py-2">
            <!-- board category header -->
            <div class="flex flex-row justify-between items-center mb-2 mx-1">
                <div class="flex items-center">
                    <h2 class="bg-cyan-100 text-sm w-max px-1 rounded mr-2 text-gray-700">Новые</h2>
                    <p class="text-gray-400 text-sm">{{$tasks->where('state', '=', 'new')?->count()}}</p>
                </div>
                <div class="flex items-center text-gray-300">
                    <p class="mr-2 text-2xl">---</p>
                    <p class="text-2xl">+</p>
                </div>
            </div>
            <!-- board card -->
            <div wire:sortable-group.item-group="new" class="grid min-h-24 gap-2 max-h-screen overflow-y-auto overscroll-auto">

                @foreach($tasks->where('state', '=', 'new') as $task)
                <div wire:key="task-{{ $task->id }}" wire:sortable-group.item="{{ $task->id }}" class="p-2 min-w-60 rounded shadow-sm bg-zinc-800 backdrop-blur">
                    <a href="{{route('tasks.show', ['id'=>$task->id])}}" class="text-sm mb-3 text-gray-100">{{$task->name}}</a>
{{--                    <p class="bg-red-100 text-xs w-max p-1 rounded mr-2 text-gray-700">To-do</p>--}}
                    <div class="flex flex-row items-center mt-2">
                        <div class="bg-gray-300 rounded-full w-4 h-4 mr-1"></div>
                        <a href="#" class="text-xs text-gray-200">{{$task->project->client->name}}/{{$task->project->name}}</a>
                    </div>
                    <p class="text-xs text-gray-500 mt-2 font-mono">Дедлайн: {{$task->deadline}}</p>
                </div>
                @endforeach
            </div>

            <div class="flex flex-row items-center text-gray-300 mt-2 px-1">
                <p class="rounded mr-2 text-2xl">+</p>
                <p class="pt-1 rounded text-sm">Добавить</p>
            </div>
        </div>
        <!-- в работе -->
        <div class="bg-zinc-900 border border-dashed border-blue-700 rounded-xl px-2 py-2">
            <!-- board category header -->
            <div class="flex flex-row justify-between items-center mb-2 mx-1">
                <div class="flex items-center">
                    <h2 class="bg-blue-100 text-sm w-max px-1 rounded mr-2 text-gray-700">В работе</h2>
                    <p class="text-gray-400 text-sm">{{$tasks->where('state', '=', 'in_process')?->count()}}</p>
                </div>
                <div class="flex items-center text-gray-300">
                    <p class="mr-2 text-2xl">---</p>
                    <p class="text-2xl">+</p>
                </div>
            </div>
            <!-- board card -->
            <div wire:sortable-group.item-group="in_process" class="grid min-h-24 gap-2 max-h-screen overflow-y-auto overscroll-auto">

                @foreach($tasks->where('state', '=', 'in_process') as $task)
                    <div wire:key="task-{{ $task->id }}" wire:sortable-group.item="{{ $task->id }}" class="p-2 min-w-60 rounded shadow-sm bg-zinc-800 backdrop-blur">
                        <a href="{{route('tasks.show', ['id'=>$task->id])}}" class="text-sm mb-3 text-gray-100">{{$task->name}}</a>
                        {{--                    <p class="bg-red-100 text-xs w-max p-1 rounded mr-2 text-gray-700">To-do</p>--}}
                        <div class="flex flex-row items-center mt-2">
                            <div class="bg-gray-300 rounded-full w-4 h-4 mr-1"></div>
                            <a href="#" class="text-xs text-gray-200">{{$task->project->client->name}}/{{$task->project->name}}</a>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 font-mono">Дедлайн: {{$task->deadline}}</p>
                    </div>
                @endforeach
            </div>

{{--            <div class="flex flex-row items-center text-gray-300 mt-2 px-1">--}}
{{--                <p class="rounded mr-2 text-2xl">+</p>--}}
{{--                <p class="pt-1 rounded text-sm">Добавить</p>--}}
{{--            </div>--}}
        </div>
        <!-- завершенные -->
        <div class="bg-zinc-900 border border-dashed border-teal-700 rounded-xl px-2 py-2">
            <!-- board category header -->
            <div class="flex flex-row justify-between items-center mb-2 mx-1">
                <div class="flex items-center">
                    <h2 class="bg-teal-100 text-sm w-max px-1 rounded mr-2 text-gray-700">Завершенные</h2>
                    <p class="text-gray-400 text-sm">{{$tasks->where('state', '=', 'completed')?->count()}}</p>
                </div>
                <div class="flex items-center text-gray-300">
                    <p class="mr-2 text-2xl">---</p>
                    <p class="text-2xl">+</p>
                </div>
            </div>
            <!-- board card -->
            <div wire:sortable-group.item-group="completed" class="grid min-h-24 gap-2 max-h-screen overflow-y-auto overscroll-auto">

                @foreach($tasks->where('state', '=', 'completed') as $task)
                    <div wire:key="task-{{ $task->id }}" wire:sortable-group.item="{{ $task->id }}" class="p-2 min-w-60 rounded shadow-sm bg-zinc-800 backdrop-blur">
                        <a href="{{route('tasks.show', ['id'=>$task->id])}}" class="text-sm mb-3 text-gray-100">{{$task->name}}</a>
                        {{--                    <p class="bg-red-100 text-xs w-max p-1 rounded mr-2 text-gray-700">To-do</p>--}}
                        <div class="flex flex-row items-center mt-2">
                            <div class="bg-gray-300 rounded-full w-4 h-4 mr-1"></div>
                            <a href="#" class="text-xs text-gray-200">{{$task->project->client->name}}/{{$task->project->name}}</a>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 font-mono">Дедлайн: {{$task->deadline}}</p>
                    </div>
                @endforeach
            </div>

{{--            <div class="flex flex-row items-center text-gray-300 mt-2 px-1">--}}
{{--                <p class="rounded mr-2 text-2xl">+</p>--}}
{{--                <p class="pt-1 rounded text-sm">Добавить</p>--}}
{{--            </div>--}}
        </div>
        <!-- не удались -->
        <div class="bg-zinc-900 border border-dashed border-red-700 rounded-xl px-2 py-2">
            <!-- board category header -->
            <div class="flex flex-row justify-between items-center mb-2 mx-1">
                <div class="flex items-center">
                    <h2 class="bg-red-100 text-sm w-max px-1 rounded mr-2 text-gray-700">Не удались</h2>
                    <p class="text-gray-400 text-sm">{{$tasks->where('state', '=', 'failed')?->count()}}</p>
                </div>
                <div class="flex items-center text-gray-300">
                    <p class="mr-2 text-2xl">---</p>
                    <p class="text-2xl">+</p>
                </div>
            </div>
            <!-- board card -->
            <div wire:sortable-group.item-group="failed" class="grid min-h-24 gap-2 max-h-screen overflow-y-auto overscroll-auto">

                @foreach($tasks->where('state', '=', 'failed') as $task)
                    <div wire:key="task-{{ $task->id }}" wire:sortable-group.item="{{ $task->id }}" class="p-2 min-w-60 rounded shadow-sm bg-zinc-800 backdrop-blur">
                        <a href="{{route('tasks.show', ['id'=>$task->id])}}" class="text-sm mb-3 text-gray-100">{{$task->name}}</a>
                        {{--                    <p class="bg-red-100 text-xs w-max p-1 rounded mr-2 text-gray-700">To-do</p>--}}
                        <div class="flex flex-row items-center mt-2">
                            <div class="bg-gray-300 rounded-full w-4 h-4 mr-1"></div>
                            <a href="#" class="text-xs text-gray-200">{{$task->project->client->name}}/{{$task->project->name}}</a>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 font-mono">Дедлайн: {{$task->deadline}}</p>
                    </div>
                @endforeach
            </div>

{{--            <div class="flex flex-row items-center text-gray-300 mt-2 px-1">--}}
{{--                <p class="rounded mr-2 text-2xl">+</p>--}}
{{--                <p class="pt-1 rounded text-sm">New</p>--}}
{{--            </div>--}}
        </div>

</div>
</div>

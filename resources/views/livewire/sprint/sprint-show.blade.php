<div class=" shadow rounded-xl space-y-6">
    <div class="flex items-start justify-between">
        <div>
            <h2 class="text-2xl font-semibold dark:text-white">{{ $sprint->name }}</h2>
            <p class="text-sm text-gray-500">{{ $sprint->description }}</p>
        </div>
        <div class="text-sm text-gray-500 dark:text-gray-300 text-right">
            <p><strong>Срок:</strong> {{ $sprint->start_date->format('d.m.Y') }} – {{ $sprint->end_date->format('d.m.Y') }}</p>
        </div>
    </div>

    <!-- Прогресс -->
    <div>
        <div class="flex justify-between items-center mb-1">
            <span class="text-sm text-gray-700 dark:text-blue-500">Прогресс</span>
            <span class="text-sm text-gray-600">{{ $progress }}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-green-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
        </div>
    </div>

    <!-- Список задач -->
    <div class="flex ">

<div class="w-full">
    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Задачи</h3>
    @livewire('task.tasks-list', ['tasks' =>$tasks])
</div>

{{--        @forelse ($tasks as $task)--}}
{{--            <div class="p-3 rounded-lg border flex items-center justify-between hover:bg-gray-50 transition">--}}
{{--                <div>--}}
{{--                    <p class="font-medium text-gray-800">{{ $task->title }}</p>--}}
{{--                    <p class="text-sm text-gray-500">{{ $task->description }}</p>--}}
{{--                    <p class="text-xs text-gray-400 mt-1">--}}
{{--                        Статус:--}}
{{--                        <span class="inline-block px-2 py-0.5 rounded-full text-gray-500 text-xs--}}
{{--                            @class([--}}
{{--                                'bg-gray-400' => $task->state === 'new',--}}
{{--                                'bg-yellow-500' => $task->state === 'in_progress',--}}
{{--                                'bg-green-500' => $task->state === 'completed',--}}
{{--                            ])">--}}
{{--                            {{ __('statuses.'.$task->state) }}--}}
{{--                            {{$task->state}}--}}
{{--                        </span>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                @if($task->assignee)--}}
{{--                    <div class="flex items-center gap-2">--}}
{{--                        <img src="{{ $task->assignee->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($task->assignee->name) }}" class="w-8 h-8 rounded-full border" alt="{{ $task->assignee->name }}">--}}
{{--                        <span class="text-sm text-gray-700">{{ $task->assignee->name }}</span>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        @empty--}}
{{--            <div class="text-gray-400 text-sm">Нет задач в этом спринте</div>--}}
{{--        @endforelse--}}
    </div>
</div>

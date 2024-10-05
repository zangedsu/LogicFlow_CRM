<div class="bg-zinc-900/60 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-lg p-6">
{{--    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>--}}



        <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-px sm:grid-cols-2 lg:grid-cols-4">
            <div class=" px-4 py-6 sm:px-6 lg:px-8">
                <p class="text-sm font-medium leading-6 text-gray-400">Всего задач</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-semibold tracking-tight text-white">{{$total_tasks}}</span>
                </p>
            </div>
            <div class=" px-4 py-6 sm:px-6 lg:px-8">
                <p class="text-sm font-medium leading-6 text-gray-400">Выполненных задач</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-semibold tracking-tight text-white">{{$total_completed_tasks}}</span>
                </p>
            </div>
            <div class=" px-4 py-6 sm:px-6 lg:px-8">
                <p class="text-sm font-medium leading-6 text-gray-400">Новые задачи</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-semibold tracking-tight text-white">{{$total_new_tasks}}</span>
                </p>
            </div>
            <div class=" px-4 py-6 sm:px-6 lg:px-8">
                <p class="text-sm font-medium leading-6 text-gray-400">Процент успеха</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-semibold tracking-tight text-white">{{$rate}}%</span>
                </p>
            </div>
        </div>
    </div>
</div>

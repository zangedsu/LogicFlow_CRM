<div>
{{--    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>--}}



        <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-px sm:grid-cols-2 lg:grid-cols-4">
            <div class=" px-4 py-6 sm:px-6 lg:px-8 border-b border-blue-700">
                <p class="text-sm font-light leading-6 text-gray-400 uppercase ">Всего задач</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-light  drop-shadow-xl tracking-tight font-mono text-blue-600">{{$total_tasks}}</span>
                </p>
            </div>
            <div class=" px-4 py-6 sm:px-6 lg:px-8 border-b border-green-700">
                <p class="text-sm font-light leading-6 text-gray-400 uppercase">Выполненных задач</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-light  drop-shadow-xl tracking-tight font-mono text-green-600">{{$total_completed_tasks}}</span>
                </p>
            </div>
            <div class=" px-4 py-6 sm:px-6 lg:px-8 border-b border-yellow-700">
                <p class="text-sm font-light leading-6 text-gray-400 uppercase">Новые задачи</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-light  drop-shadow-xl tracking-tight font-mono text-yellow-600">{{$total_new_tasks}}</span>
                </p>
            </div>
            <div class=" px-4 py-6 sm:px-6 lg:px-8 border-b border-emerald-700">
                <p class="text-sm font-light leading-6 text-gray-400 uppercase">Процент успеха</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-light  drop-shadow-xl tracking-tight font-mono text-emerald-600">{{$rate}}%</span>
                </p>
            </div>
        </div>
    </div>
</div>

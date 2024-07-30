<ul role="list" class="divide-y divide-gray-100 overflow-hidden bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
    @foreach($paginated_clients as $client)
    <li class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 dark:hover:bg-gray-900 duration-300 sm:px-6">
        <div class="flex min-w-0 gap-x-4">
            <div class="h-12 w-12 flex-none rounded-full bg-gray-50">A</div>
            <div class="min-w-0 flex-auto">
                <p class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">
                    <a href="#">
                        <span class="absolute inset-x-0 -top-px bottom-0"></span>
                       {{$client->name}}
                    </a>
                </p>
                <p class="mt-1 flex text-xs leading-5 text-gray-500 dark:text-gray-200">
                    <a href="#" class="relative truncate hover:underline">Редактировать</a>
                </p>
            </div>
        </div>
        <div class="flex shrink-0 items-center gap-x-4">
            <div class="hidden sm:flex sm:flex-col sm:items-end">
{{--                <p class="text-sm leading-6 text-gray-900 dark:text-gray-100">Business Relations</p>--}}
                <div class="mt-1 flex items-center gap-x-1.5">

                    <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                        <div class="h-1.5 w-1.5 rounded-full bg-emerald-500"></div>
                    </div>
                    <p class="text-xs leading-5 text-gray-500 dark:text-gray-200">Есть активные проекты</p>
                </div>
            </div>
            <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
            </svg>
        </div>
    </li>
    @endforeach
        {{ $paginated_clients->links() }}
</ul>

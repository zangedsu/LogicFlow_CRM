<ul role="list" class="divide-y divide-gray-100 overflow-hidden rounded-xl">
    @foreach($paginated_clients as $client)
    <li class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 dark:hover:bg-gray-900 duration-300 sm:px-6">
        <div class="flex min-w-0 gap-x-4">
            @if($client->logo()->first())
                <img src="{{asset('storage/'.$client->logo()->first()->path)}}" class="h-12 w-12 flex-none rounded-full bg-gray-50">
            @else
                <div class="h-12 w-12 flex rounded-full bg-gray-50" ><div class="m-auto">{{mb_substr($client->name, 0, 1)}}</div></div>
            @endif

            <div class="min-w-0 flex-auto">
                <p class="text-sm font-semibold truncate leading-6 text-gray-900 dark:text-white">
                    <a wire:navigate href="{{route('clients.show', $client->id)}}">

                        <span class="absolute inset-x-0 -top-px bottom-0"></span>
                            {{$client->name}}

                    </a>
                </p>
                @if(Auth::user()->hasTeamPermission(Auth::user()->currentTeam()->first(), 'update'))
                <p class="mt-1 flex text-xs leading-5 text-gray-500 dark:text-gray-200">
                    <a wire:navigate href="{{route('clients.edit', $client->id)}}" class="relative truncate hover:underline">Редактировать</a>
                </p>
                @endif
            </div>
        </div>
        <div class="flex shrink-0 items-center gap-x-4">

            <div class="hidden sm:flex sm:flex-col sm:items-end">
{{--                <p class="text-sm leading-6 text-gray-900 dark:text-gray-100">Business Relations</p>--}}
                @if($client->hasActiveProjects())
                <div class="mt-1 flex items-center gap-x-1.5">

                    <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                        <div class="h-1.5 w-1.5 rounded-full bg-emerald-500"></div>
                    </div>
                    <p class="text-xs leading-5 font-mono text-gray-500 dark:text-gray-200">Есть активные проекты</p>
                </div>
                @else
                    <div class="mt-1 flex items-center gap-x-1.5">
                        <div class="flex-none rounded-full bg-red-500/20 p-1">
                            <div class="h-1.5 w-1.5 rounded-full bg-red-500"></div>
                        </div>
                        <p class="text-xs leading-5 font-mono text-gray-500 dark:text-gray-200">Нет активных проектов</p>
                    </div>
                @endif
            </div>

            <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
            </svg>
        </div>
    </li>
    @endforeach
    @if($navigate_links)

            {{ $paginated_clients->links() }}
    @endif

</ul>

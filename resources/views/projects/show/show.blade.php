<x-app-sidebar-layout>
    <div>
        <div class="bg-zinc-900/80 rounded-xl backdrop-blur-3xl">
            <!-- Sticky search header -->
                <header>
                    <!-- Secondary navigation -->
                    <nav class="flex overflow-x-auto border-b border-white/10 py-4">
                        <ul role="list" class="flex min-w-full flex-none gap-x-6 px-4 text-sm font-semibold leading-6 text-gray-400 sm:px-6 lg:px-8">
                            <li>
                                <a wire:navigate href="{{route('projects.show', ['id' => $project->id])}}" class=" @if(!request('tab')))  text-indigo-400 @endif ">Обзор</a>
                            </li><li>
                                <a wire:navigate href="{{route('projects.show', ['id' => $project->id, 'tab'=>'sprints'])}}" class=" @if(request('tab') == 'sprints'))  text-indigo-400 @endif ">Спринты</a>
                            </li>

                            <li>
                                <a href="#" class="">Настройки</a>
                            </li>
                            <li>
                                <a href="#" class="">Участники</a>
                            </li>
                            <li>
                                <a href="#" class="">Спринты</a>
                            </li>
                        </ul>
                    </nav>

                    <!-- Heading -->
                    <div class="flex flex-col items-start justify-between gap-x-8 gap-y-4 bg-gray-700/10 px-4 py-4 sm:flex-row sm:items-center sm:px-6 lg:px-8">
                        <div>
                            <div class="flex items-center gap-x-3">
                                <div class="flex-none rounded-full bg-green-400/10 p-1 text-green-400">
                                    <div class="h-2 w-2 rounded-full bg-current"></div>
                                </div>
                                <h1 class="flex gap-x-3 text-base leading-7">
                                    <span class="font-semibold text-white">{{$project->client->name}}</span>
                                    <span class="text-gray-600">/</span>
                                    <span class="font-semibold text-white">{{$project->name}}</span>
                                </h1>
                            </div>
                            <p class="mt-2 text-xs leading-6 text-gray-400">{{$project->description}}</p>
                        </div>
                        <div class="order-first flex-none rounded-full bg-indigo-400/10 px-2 py-1 text-xs font-medium text-indigo-400 ring-1 ring-inset ring-indigo-400/30 sm:order-none">{{$project->is_active ? 'Активен' : 'Не активен'}}</div>
                    </div>

                    @yield('header')

                </header>

                <!-- Activity list -->
{{--                <div class="border-t border-white/10 pt-11">--}}
{{--                    <h2 class="px-4 text-base font-semibold leading-7 text-white sm:px-6 lg:px-8">Последняя активность</h2>--}}
{{--                    <table class="mt-6 w-full whitespace-nowrap text-left">--}}
{{--                        <colgroup>--}}
{{--                            <col class="w-full sm:w-4/12">--}}
{{--                            <col class="lg:w-4/12">--}}
{{--                            <col class="lg:w-2/12">--}}
{{--                            <col class="lg:w-1/12">--}}
{{--                            <col class="lg:w-1/12">--}}
{{--                        </colgroup>--}}
{{--                        <thead class="border-b border-white/10 text-sm leading-6 text-white">--}}
{{--                        <tr>--}}
{{--                            <th scope="col" class="py-2 pl-4 pr-8 font-semibold sm:pl-6 lg:pl-8">Пользователь</th>--}}
{{--                            <th scope="col" class="hidden py-2 pl-0 pr-8 font-semibold sm:table-cell">Номер</th>--}}
{{--                            <th scope="col" class="py-2 pl-0 pr-4 text-right font-semibold sm:pr-8 sm:text-left lg:pr-20">Статус</th>--}}
{{--                            <th scope="col" class="hidden py-2 pl-0 pr-8 font-semibold md:table-cell lg:pr-20">Продолжительность</th>--}}
{{--                            <th scope="col" class="hidden py-2 pl-0 pr-4 text-right font-semibold sm:table-cell sm:pr-6 lg:pr-8">Время</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody class="divide-y divide-white/5">--}}
{{--                        <tr>--}}
{{--                            <td class="py-4 pl-4 pr-8 sm:pl-6 lg:pl-8">--}}
{{--                                <div class="flex items-center gap-x-4">--}}
{{--                                    <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-8 w-8 rounded-full bg-gray-800">--}}
{{--                                    <div class="truncate text-sm font-medium leading-6 text-white">Michael Foster</div>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td class="hidden py-4 pl-0 pr-4 sm:table-cell sm:pr-8">--}}
{{--                                <div class="flex gap-x-3">--}}
{{--                                    <div class="font-mono text-sm leading-6 text-gray-400">2d89f0c8</div>--}}
{{--                                    <span class="inline-flex items-center rounded-md bg-gray-400/10 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-gray-400/20">main</span>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">--}}
{{--                                <div class="flex items-center justify-end gap-x-2 sm:justify-start">--}}
{{--                                    <time class="text-gray-400 sm:hidden" datetime="2023-01-23T11:00">45 minutes ago</time>--}}
{{--                                    <div class="flex-none rounded-full p-1 text-green-400 bg-green-400/10">--}}
{{--                                        <div class="h-1.5 w-1.5 rounded-full bg-current"></div>--}}
{{--                                    </div>--}}
{{--                                    <div class="hidden text-white sm:block">Completed</div>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td class="hidden py-4 pl-0 pr-8 text-sm leading-6 text-gray-400 md:table-cell lg:pr-20">25s</td>--}}
{{--                            <td class="hidden py-4 pl-0 pr-4 text-right text-sm leading-6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">--}}
{{--                                <time datetime="2023-01-23T11:00">45 minutes ago</time>--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <!-- More items... -->--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}


        @yield('content')

        </div>
    </div>


</x-app-sidebar-layout>

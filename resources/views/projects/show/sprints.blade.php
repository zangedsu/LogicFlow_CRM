@extends('projects.show.show')


@section('content')
    <div class="border-t border-white/10 pt-11">
        <div class="flex justify-between">
            <h2 class="px-4 text-base font-semibold leading-7 text-white sm:px-6 lg:px-8">Спринты</h2>
{{--            <a wire:navigate href="{{route('sprints.create', ['project' => $project->id])}}" type="button"--}}
{{--               class="inline-flex items-center rounded-md bg-zinc-900/80 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:border duration-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">--}}
{{--                <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                    <path--}}
{{--                        d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"/>--}}
{{--                </svg>--}}
{{--                Новый спринт--}}
{{--            </a>--}}
        </div>

        @if($project->sprints->count() > 0)

            <table class="mt-6 w-full whitespace-nowrap text-left">
                <colgroup>
                    <col class="w-full sm:w-4/12">
                    <col class="lg:w-4/12">
                    <col class="lg:w-2/12">
                    <col class="lg:w-1/12">
                    <col class="lg:w-1/12">
                </colgroup>


                <thead class="border-b border-white/10 text-sm leading-6 text-white">
                <tr>
                    <th scope="col" class="py-2 pl-4 pr-8 font-semibold sm:pl-6 lg:pl-8">Название</th>
                    <th scope="col" class="hidden py-2 pl-0 pr-8 font-semibold sm:table-cell">Дата создания</th>
                    <th scope="col" class="py-2 pl-0 pr-4 text-right font-semibold sm:pr-8 sm:text-left lg:pr-20">
                        Статус
                    </th>
                    <th scope="col" class="hidden py-2 pl-0 pr-8 font-semibold md:table-cell lg:pr-20">Дедлайн</th>
                    <th scope="col"
                        class="hidden py-2 pl-0 pr-4 text-right font-semibold sm:table-cell sm:pr-6 lg:pr-8">
                        Задачи
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                @foreach($project->sprints as $sprint)
                    <tr>
                        <td class="py-4 pl-4 pr-8 sm:pl-6 lg:pl-8">
                            <div class="flex items-center gap-x-4">
                                {{--                                    <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-8 w-8 rounded-full bg-gray-800">--}}
                                <a href=""
                                   class="truncate text-sm font-medium leading-6 text-white">{{$sprint->name}}</a>
                            </div>
                        </td>
                        <td class="hidden py-4 pl-0 pr-4 sm:table-cell sm:pr-8">
                            <div class="flex gap-x-3">
                                <div class="font-mono text-sm leading-6 text-gray-400">{{$sprint->created_at}}</div>
                                {{--                                    <span class="inline-flex items-center rounded-md bg-gray-400/10 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-gray-400/20">main</span>--}}
                            </div>
                        </td>
                        <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
                            <div class="flex items-center justify-end gap-x-2 sm:justify-start">
                                <time class="text-gray-400 sm:hidden" datetime="2023-01-23T11:00">45 minutes ago</time>
                                <div class="flex-none rounded-full p-1 text-green-400 bg-green-400/10">
                                    <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                </div>
{{--                                <div class="hidden text-white sm:block">{{$task->state ? $task->state->name : 'Нет'}}</div>--}}
                            </div>
                        </td>
                        <td class="hidden py-4 pl-0 pr-8 text-sm leading-6 text-gray-400 md:table-cell lg:pr-20">{{$sprint->end_date}}</td>
                        <td class="hidden py-4 pl-0 pr-4 text-right text-sm leading-6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">
                            {{$sprint->tasks->count()}}
                        </td>
                    </tr>
                @endforeach

                <!-- More items... -->
                </tbody>
            </table>



        @else
            <div class="text-center  rounded-lg p-6 mt-6">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">Нет спринтов</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">В данном проекте совсем нет спринтов, стоит их
                    создать для начала работы</p>
                <div class="mt-6">
                    <a wire:navigate href="{{route('sprints.create', ['project' => $project->id])}}" type="button"
                       class="inline-flex items-center rounded-md bg-zinc-900/80 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:border duration-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"/>
                        </svg>
                        Создать спринт
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection

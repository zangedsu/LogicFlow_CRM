<div>

    <div class=" w-full h-full  rounded-lg shadow-sm ">
        <div class="flex justify-between">
            <div>
                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{$title}}</h5>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400 pb-2">{{$subtitle}}</p>
            </div>
{{--            <div--}}
{{--                class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">--}}
{{--                12%--}}
{{--                <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">--}}
{{--                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>--}}
{{--                </svg>--}}
{{--            </div>--}}
        </div>
        <div id="{{$chart_id}}"></div>
        <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
            <div class="flex justify-between items-center pt-5">
                <!-- Button -->
{{--                <button--}}
{{--                    id="dropdownDefaultButton"--}}
{{--                    data-dropdown-toggle="lastDaysdropdown"--}}
{{--                    data-dropdown-placement="bottom"--}}
{{--                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"--}}
{{--                    type="button">--}}
{{--                    Last 7 days--}}
{{--                    <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">--}}
{{--                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>--}}
{{--                    </svg>--}}
{{--                </button>--}}
                <!-- Dropdown menu -->
                <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
                        </li>
                    </ul>
                </div>
{{--                <a--}}
{{--                    href="#"--}}
{{--                    class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700  px-3 py-2">--}}
{{--                    Кнопка--}}
{{--                    <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">--}}
{{--                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>--}}
{{--                    </svg>--}}
{{--                </a>--}}
            </div>
        </div>
<div class="text-white">
</div>
    </div>
@if($data)
@script
<script>
    const options{{$chart_id}} = {
        chart: {
            height: "100%",
            maxWidth: "100%",
            type: "{{$chart_type}}",
            fontFamily: "Inter, sans-serif",
            dropShadow: {
                enabled: true,
            },
            toolbar: {
                show: true,
            },
        },
        tooltip: {
            enabled: true,
            x: {
                show: false,
            },
        },
        fill: {
            type: "{{$chart_type == 'area' ? 'gradient' : 'none' }}",
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: {{$chart_type == 'area' ? 6 : 0}},
        },
        grid: {
            show: true,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: 0
            },
        },
        series: @json($data ?? []),

        colors: @json($colors ?? []),
        labels: @json($labels ?? []),
        xaxis: {
            categories: @json($categories ?? []),
            labels: {
                show: true,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: true,
            },
        },
        yaxis: {
            show: true,
        },

        legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
            labels: {
                colors: 'grey',
            },
        },

        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: 20,
                        },
                        total: {
                            showAlways: true,
                            show: true,
                            label: "Всего задач",
                            fontFamily: "Inter, sans-serif",
                            color: "gray",
                            formatter: function (w) {
                                const sum = w.globals.seriesTotals.reduce((a, b) => {
                                    return a + b
                                }, 0)
                                return  sum
                            },
                        },
                        value: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            color: "white",
                            offsetY: -20,
                            formatter: function (value) {
                                return value
                            },
                        },
                    },
                    size: "80%",
                },
                },
                },
    }
    if (document.getElementById("{{$chart_id}}") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("{{$chart_id}}"), options{{$chart_id}});
        chart.render();
    }

</script>
    @endscript
    @endif

</div>




{{--<div class="max-w-sm w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">--}}
{{--    <div class="flex justify-between mb-3">--}}
{{--        <div class="flex items-center">--}}
{{--            <div class="flex justify-center items-center">--}}
{{--                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Your team's progress</h5>--}}
{{--                <svg data-popover-target="chart-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">--}}
{{--                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>--}}
{{--                </svg>--}}
{{--                <div data-popover id="chart-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">--}}
{{--                    <div class="p-3 space-y-2">--}}
{{--                        <h3 class="font-semibold text-gray-900 dark:text-white">Activity growth - Incremental</h3>--}}
{{--                        <p>Report helps navigate cumulative growth of community activities. Ideally, the chart should have a growing trend, as stagnating chart signifies a significant decrease of community activity.</p>--}}
{{--                        <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3>--}}
{{--                        <p>For each date bucket, the all-time volume of activities is calculated. This means that activities in period n contain all activities up to period n, plus the activities generated by your community in period.</p>--}}
{{--                        <a href="#" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">--}}
{{--                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>--}}
{{--                            </svg></a>--}}
{{--                    </div>--}}
{{--                    <div data-popper-arrow></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">--}}
{{--        <div class="grid grid-cols-3 gap-3 mb-2">--}}
{{--            <dl class="bg-orange-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">--}}
{{--                <dt class="w-8 h-8 rounded-full bg-orange-100 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">12</dt>--}}
{{--                <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">To do</dd>--}}
{{--            </dl>--}}
{{--            <dl class="bg-teal-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">--}}
{{--                <dt class="w-8 h-8 rounded-full bg-teal-100 dark:bg-gray-500 text-teal-600 dark:text-teal-300 text-sm font-medium flex items-center justify-center mb-1">23</dt>--}}
{{--                <dd class="text-teal-600 dark:text-teal-300 text-sm font-medium">In progress</dd>--}}
{{--            </dl>--}}
{{--            <dl class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">--}}
{{--                <dt class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">64</dt>--}}
{{--                <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Done</dd>--}}
{{--            </dl>--}}
{{--        </div>--}}
{{--        <button data-collapse-toggle="more-details" type="button" class="hover:underline text-xs text-gray-500 dark:text-gray-400 font-medium inline-flex items-center">Show more details <svg class="w-2 h-2 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">--}}
{{--                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>--}}
{{--            </svg>--}}
{{--        </button>--}}
{{--        <div id="more-details" class="border-gray-200 border-t dark:border-gray-600 pt-3 mt-3 space-y-2 hidden">--}}
{{--            <dl class="flex items-center justify-between">--}}
{{--                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal">Average task completion rate:</dt>--}}
{{--                <dd class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">--}}
{{--                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">--}}
{{--                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>--}}
{{--                    </svg> 57%--}}
{{--                </dd>--}}
{{--            </dl>--}}
{{--            <dl class="flex items-center justify-between">--}}
{{--                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal">Days until sprint ends:</dt>--}}
{{--                <dd class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-gray-600 dark:text-gray-300">13 days</dd>--}}
{{--            </dl>--}}
{{--            <dl class="flex items-center justify-between">--}}
{{--                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal">Next meeting:</dt>--}}
{{--                <dd class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-gray-600 dark:text-gray-300">Thursday</dd>--}}
{{--            </dl>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Radial Chart -->--}}
{{--    <div class="py-6" id="radial-chart"></div>--}}

{{--    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">--}}
{{--        <div class="flex justify-between items-center pt-5">--}}
{{--            <!-- Button -->--}}
{{--            <button--}}
{{--                id="dropdownDefaultButton"--}}
{{--                data-dropdown-toggle="lastDaysdropdown"--}}
{{--                data-dropdown-placement="bottom"--}}
{{--                class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"--}}
{{--                type="button">--}}
{{--                Last 7 days--}}
{{--                <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">--}}
{{--                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>--}}
{{--                </svg>--}}
{{--            </button>--}}
{{--            <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">--}}
{{--                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">--}}
{{--                    <li>--}}
{{--                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <a--}}
{{--                href="#"--}}
{{--                class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">--}}
{{--                Progress report--}}
{{--                <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">--}}
{{--                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>--}}
{{--                </svg>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}




<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="image/x-icon" href="{{asset('storage/assets/logo_web.png')}}" rel="icon">

        <title>Logic Flow - полный контроль над рабочими процессами</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->

            @vite(['resources/css/app.css', 'resources/js/app.js'])
            @livewireStyles

    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="w-full ">

        <div class="flex w-full justify-center">
            <header class="w-full max-w-(--breakpoint-xl) z-30 absolute flex justify-between items-center px-6  py-10 ">
                <div class="flex lg:justify-center ">
{{--                    <svg class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20]" viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8897 14.8858V28.5615C61.8898 28.737 61.8434 28.9095 61.7554 29.0614C61.6675 29.2132 61.5409 29.3392 61.3887 29.4265L49.9104 36.0351V49.1337C49.9104 49.4902 49.7209 49.8192 49.4118 49.9987L25.4519 63.7916C25.3971 63.8227 25.3372 63.8427 25.2774 63.8639C25.255 63.8714 25.2338 63.8851 25.2101 63.8913C25.0426 63.9354 24.8666 63.9354 24.6991 63.8913C24.6716 63.8838 24.6467 63.8689 24.6205 63.8589C24.5657 63.8389 24.5084 63.8215 24.456 63.7916L0.501061 49.9987C0.348882 49.9113 0.222437 49.7853 0.134469 49.6334C0.0465019 49.4816 0.000120578 49.3092 0 49.1337L0 8.10652C0 8.01678 0.0124642 7.92953 0.0348998 7.84477C0.0423783 7.8161 0.0598282 7.78993 0.0697995 7.76126C0.0884958 7.70891 0.105946 7.65531 0.133367 7.6067C0.152063 7.5743 0.179485 7.54812 0.20192 7.51821C0.230588 7.47832 0.256763 7.43719 0.290416 7.40229C0.319084 7.37362 0.356476 7.35243 0.388883 7.32751C0.425029 7.29759 0.457436 7.26518 0.498568 7.2415L12.4779 0.345059C12.6296 0.257786 12.8015 0.211853 12.9765 0.211853C13.1515 0.211853 13.3234 0.257786 13.475 0.345059L25.4531 7.2415H25.4556C25.4955 7.26643 25.5292 7.29759 25.5653 7.32626C25.5977 7.35119 25.6339 7.37362 25.6625 7.40104C25.6974 7.43719 25.7224 7.47832 25.7523 7.51821C25.7735 7.54812 25.8021 7.5743 25.8196 7.6067C25.8483 7.65656 25.8645 7.70891 25.8844 7.76126C25.8944 7.78993 25.9118 7.8161 25.9193 7.84602C25.9423 7.93096 25.954 8.01853 25.9542 8.10652V33.7317L35.9355 27.9844V14.8846C35.9355 14.7973 35.948 14.7088 35.9704 14.6253C35.9792 14.5954 35.9954 14.5692 36.0053 14.5405C36.0253 14.4882 36.0427 14.4346 36.0702 14.386C36.0888 14.3536 36.1163 14.3274 36.1375 14.2975C36.1674 14.2576 36.1923 14.2165 36.2272 14.1816C36.2559 14.1529 36.292 14.1317 36.3244 14.1068C36.3618 14.0769 36.3942 14.0445 36.4341 14.0208L48.4147 7.12434C48.5663 7.03694 48.7383 6.99094 48.9133 6.99094C49.0883 6.99094 49.2602 7.03694 49.4118 7.12434L61.3899 14.0208C61.4323 14.0457 61.4647 14.0769 61.5021 14.1055C61.5333 14.1305 61.5694 14.1529 61.5981 14.1803C61.633 14.2165 61.6579 14.2576 61.6878 14.2975C61.7103 14.3274 61.7377 14.3536 61.7551 14.386C61.7838 14.4346 61.8 14.4882 61.8199 14.5405C61.8312 14.5692 61.8474 14.5954 61.8548 14.6253ZM59.893 27.9844V16.6121L55.7013 19.0252L49.9104 22.3593V33.7317L59.8942 27.9844H59.893ZM47.9149 48.5566V37.1768L42.2187 40.4299L25.953 49.7133V61.2003L47.9149 48.5566ZM1.99677 9.83281V48.5566L23.9562 61.199V49.7145L12.4841 43.2219L12.4804 43.2194L12.4754 43.2169C12.4368 43.1945 12.4044 43.1621 12.3682 43.1347C12.3371 43.1097 12.3009 43.0898 12.2735 43.0624L12.271 43.0586C12.2386 43.0275 12.2162 42.9888 12.1887 42.9539C12.1638 42.9203 12.1339 42.8916 12.114 42.8567L12.1127 42.853C12.0903 42.8156 12.0766 42.7707 12.0604 42.7283C12.0442 42.6909 12.023 42.656 12.013 42.6161C12.0005 42.5688 11.998 42.5177 11.9931 42.4691C11.9881 42.4317 11.9781 42.3943 11.9781 42.3569V15.5801L6.18848 12.2446L1.99677 9.83281ZM12.9777 2.36177L2.99764 8.10652L12.9752 13.8513L22.9541 8.10527L12.9752 2.36177H12.9777ZM18.1678 38.2138L23.9574 34.8809V9.83281L19.7657 12.2459L13.9749 15.5801V40.6281L18.1678 38.2138ZM48.9133 9.14105L38.9344 14.8858L48.9133 20.6305L58.8909 14.8846L48.9133 9.14105ZM47.9149 22.3593L42.124 19.0252L37.9323 16.6121V27.9844L43.7219 31.3174L47.9149 33.7317V22.3593ZM24.9533 47.987L39.59 39.631L46.9065 35.4555L36.9352 29.7145L25.4544 36.3242L14.9907 42.3482L24.9533 47.987Z" fill="currentColor"/></svg>--}}
                    <img class="h-16 w-auto" src="{{asset('storage/assets/logo_web.png')}}">
                </div>
                @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-hidden focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Панель управления
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-hidden focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                               Вход
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-hidden focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Регистрация
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>
        </div>


                    <div class="bg-gray-900">
                        <main>
                            <!-- Hero section -->
                            <div class="relative isolate overflow-hidden">
                                <svg class="absolute inset-0 -z-10 h-full w-full stroke-white/10 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]" aria-hidden="true">
                                    <defs>
                                        <pattern id="983e3e4c-de6d-4c3f-8d64-b9761d1534cc" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
                                            <path d="M.5 200V.5H200" fill="none" />
                                        </pattern>
                                    </defs>
                                    <svg x="50%" y="-1" class="overflow-visible fill-gray-800/20">
                                        <path d="M-200 0h201v201h-201Z M600 0h201v201h-201Z M-400 600h201v201h-201Z M200 800h201v201h-201Z" stroke-width="0" />
                                    </svg>
                                    <rect width="100%" height="100%" stroke-width="0" fill="url(#983e3e4c-de6d-4c3f-8d64-b9761d1534cc)" />
                                </svg>
                                <div class="absolute left-[calc(50%-4rem)] top-10 -z-10 transform-gpu blur-3xl sm:left-[calc(50%-18rem)] lg:left-48 lg:top-[calc(50%-30rem)] xl:left-[calc(50%-24rem)]" aria-hidden="true">
                                    <div class="aspect-1108/632 w-[69.25rem] bg-linear-to-r from-[#80caff] to-[#4f46e5] opacity-20" style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)"></div>
                                </div>
                                <div class="mx-auto max-w-7xl px-6 pb-24 pt-10 sm:pb-40 lg:flex lg:px-8 lg:pt-40">
                                    <div class="mx-auto max-w-2xl shrink-0 lg:mx-0 lg:max-w-xl lg:pt-8">
                                        <div class="mt-24 sm:mt-32 lg:mt-16">
                                            <a href="#" class="inline-flex space-x-6">
                                                <span class="rounded-full bg-indigo-500/10 px-3 py-1 text-sm font-semibold leading-6 text-indigo-400 ring-1 ring-inset ring-indigo-500/20">Beta</span>
                                                <span class="inline-flex items-center space-x-2 text-sm font-medium leading-6 text-gray-300">
                <span> Узнать больше</span>
                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                </svg>
              </span>
                                            </a>
                                        </div>
                                        <h1 class="mt-10 text-4xl font-bold tracking-tight text-white sm:text-6xl">Получите полный контроль над вашими проектами</h1>
                                        <p class="mt-6 text-lg leading-8 text-gray-300">Поддерживайте высокий уровень производительности и достигайте поставленных целей вместе с командой</p>
                                        <div class="mt-10 flex items-center gap-x-6">
                                            <a href="{{route('register')}}" class="rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-400">Начать</a>
                                            <a href="{{route('login')}}" class="text-sm font-semibold leading-6 text-white">Войти <span aria-hidden="true">→</span></a>
                                        </div>
                                    </div>
                                    <div class="mx-aut my-auto mt-16 flex max-w-2xl sm:mt-24 lg:ml-10 lg:mr-0 lg:mt-12 lg:max-w-none lg:flex-none xl:ml-32">
                                        <div class="max-w-3xl flex-none sm:max-w-5xl lg:max-w-none">
                                            <img src="{{asset('storage/assets/landing_screen.png')}}" alt="App screenshot"  class="w-[70rem] rounded-md bg-white/5 shadow-2xl ring-1 ring-white/10">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Logo cloud -->
{{--                            <div class="mx-auto mt-8 max-w-7xl px-6 sm:mt-16 lg:px-8">--}}
{{--                                <h2 class="text-center text-lg font-semibold leading-8 text-white">The world’s most innovative companies use our app</h2>--}}
{{--                                <div class="mx-auto mt-10 grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-10 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 lg:mx-0 lg:max-w-none lg:grid-cols-5">--}}
{{--                                    <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/transistor-logo-white.svg" alt="Transistor" width="158" height="48">--}}
{{--                                    <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/reform-logo-white.svg" alt="Reform" width="158" height="48">--}}
{{--                                    <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/tuple-logo-white.svg" alt="Tuple" width="158" height="48">--}}
{{--                                    <img class="col-span-2 max-h-12 w-full object-contain sm:col-start-2 lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/savvycal-logo-white.svg" alt="SavvyCal" width="158" height="48">--}}
{{--                                    <img class="col-span-2 col-start-2 max-h-12 w-full object-contain sm:col-start-auto lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/statamic-logo-white.svg" alt="Statamic" width="158" height="48">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- Feature section -->--}}
{{--                            <div class="mx-auto mt-32 max-w-7xl px-6 sm:mt-56 lg:px-8">--}}
{{--                                <div class="mx-auto max-w-2xl text-center">--}}
{{--                                    <h2 class="text-base font-semibold leading-7 text-indigo-400">Deploy faster</h2>--}}
{{--                                    <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">Everything you need to deploy your app</p>--}}
{{--                                    <p class="mt-6 text-lg leading-8 text-gray-300">Lorem ipsum dolor sit amet consect adipisicing elit. Possimus magnam voluptatum cupiditate veritatis in accusamus quisquam.</p>--}}
{{--                                </div>--}}
{{--                                <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">--}}
{{--                                    <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">--}}
{{--                                        <div class="flex flex-col">--}}
{{--                                            <dt class="text-base font-semibold leading-7 text-white">--}}
{{--                                                <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-500">--}}
{{--                                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
{{--                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />--}}
{{--                                                    </svg>--}}
{{--                                                </div>--}}
{{--                                                Server monitoring--}}
{{--                                            </dt>--}}
{{--                                            <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-300">--}}
{{--                                                <p class="flex-auto">Non quo aperiam repellendus quas est est. Eos aut dolore aut ut sit nesciunt. Ex tempora quia. Sit nobis consequatur dolores incidunt.</p>--}}
{{--                                                <p class="mt-6">--}}
{{--                                                    <a href="#" class="text-sm font-semibold leading-6 text-indigo-400">Learn more <span aria-hidden="true">→</span></a>--}}
{{--                                                </p>--}}
{{--                                            </dd>--}}
{{--                                        </div>--}}
{{--                                        <div class="flex flex-col">--}}
{{--                                            <dt class="text-base font-semibold leading-7 text-white">--}}
{{--                                                <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-500">--}}
{{--                                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
{{--                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />--}}
{{--                                                    </svg>--}}
{{--                                                </div>--}}
{{--                                                Collaborate--}}
{{--                                            </dt>--}}
{{--                                            <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-300">--}}
{{--                                                <p class="flex-auto">Vero eum voluptatem aliquid nostrum voluptatem. Vitae esse natus. Earum nihil deserunt eos quasi cupiditate. A inventore et molestiae natus.</p>--}}
{{--                                                <p class="mt-6">--}}
{{--                                                    <a href="#" class="text-sm font-semibold leading-6 text-indigo-400">Learn more <span aria-hidden="true">→</span></a>--}}
{{--                                                </p>--}}
{{--                                            </dd>--}}
{{--                                        </div>--}}
{{--                                        <div class="flex flex-col">--}}
{{--                                            <dt class="text-base font-semibold leading-7 text-white">--}}
{{--                                                <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-500">--}}
{{--                                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
{{--                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />--}}
{{--                                                    </svg>--}}
{{--                                                </div>--}}
{{--                                                Task scheduling--}}
{{--                                            </dt>--}}
{{--                                            <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-300">--}}
{{--                                                <p class="flex-auto">Et quod quaerat dolorem quaerat architecto aliquam accusantium. Ex adipisci et doloremque autem quia quam. Quis eos molestiae at iure impedit.</p>--}}
{{--                                                <p class="mt-6">--}}
{{--                                                    <a href="#" class="text-sm font-semibold leading-6 text-indigo-400">Learn more <span aria-hidden="true">→</span></a>--}}
{{--                                                </p>--}}
{{--                                            </dd>--}}
{{--                                        </div>--}}
{{--                                    </dl>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- Feature section -->--}}
{{--                            <div class="mt-32 sm:mt-56">--}}
{{--                                <div class="mx-auto max-w-7xl px-6 lg:px-8">--}}
{{--                                    <div class="mx-auto max-w-2xl sm:text-center">--}}
{{--                                        <h2 class="text-base font-semibold leading-7 text-indigo-400">Everything you need</h2>--}}
{{--                                        <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">No server? No problem.</p>--}}
{{--                                        <p class="mt-6 text-lg leading-8 text-gray-300">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis.</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="relative overflow-hidden pt-16">--}}
{{--                                    <div class="mx-auto max-w-7xl px-6 lg:px-8">--}}
{{--                                        <img src="https://tailwindui.com/img/component-images/dark-project-app-screenshot.png" alt="App screenshot" class="mb-[-12%] rounded-xl shadow-2xl ring-1 ring-white/10" width="2432" height="1442">--}}
{{--                                        <div class="relative" aria-hidden="true">--}}
{{--                                            <div class="absolute -inset-x-20 bottom-0 bg-linear-to-t from-gray-900 pt-[7%]"></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="mx-auto mt-16 max-w-7xl px-6 sm:mt-20 md:mt-24 lg:px-8">--}}
{{--                                    <dl class="mx-auto grid max-w-2xl grid-cols-1 gap-x-6 gap-y-10 text-base leading-7 text-gray-300 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3 lg:gap-x-8 lg:gap-y-16">--}}
{{--                                        <div class="relative pl-9">--}}
{{--                                            <dt class="inline font-semibold text-white">--}}
{{--                                                <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                                    <path fill-rule="evenodd" d="M5.5 17a4.5 4.5 0 01-1.44-8.765 4.5 4.5 0 018.302-3.046 3.5 3.5 0 014.504 4.272A4 4 0 0115 17H5.5zm3.75-2.75a.75.75 0 001.5 0V9.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0l-3.25 3.5a.75.75 0 101.1 1.02l1.95-2.1v4.59z" clip-rule="evenodd" />--}}
{{--                                                </svg>--}}
{{--                                                Push to deploy.--}}
{{--                                            </dt>--}}
{{--                                            <dd class="inline">Lorem ipsum, dolor sit amet consectetur adipisicing elit aute id magna.</dd>--}}
{{--                                        </div>--}}
{{--                                        <div class="relative pl-9">--}}
{{--                                            <dt class="inline font-semibold text-white">--}}
{{--                                                <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                                    <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />--}}
{{--                                                </svg>--}}
{{--                                                SSL certificates.--}}
{{--                                            </dt>--}}
{{--                                            <dd class="inline">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo.</dd>--}}
{{--                                        </div>--}}
{{--                                        <div class="relative pl-9">--}}
{{--                                            <dt class="inline font-semibold text-white">--}}
{{--                                                <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                                    <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 01-9.201 2.466l-.312-.311h2.433a.75.75 0 000-1.5H3.989a.75.75 0 00-.75.75v4.242a.75.75 0 001.5 0v-2.43l.31.31a7 7 0 0011.712-3.138.75.75 0 00-1.449-.39zm1.23-3.723a.75.75 0 00.219-.53V2.929a.75.75 0 00-1.5 0V5.36l-.31-.31A7 7 0 003.239 8.188a.75.75 0 101.448.389A5.5 5.5 0 0113.89 6.11l.311.31h-2.432a.75.75 0 000 1.5h4.243a.75.75 0 00.53-.219z" clip-rule="evenodd" />--}}
{{--                                                </svg>--}}
{{--                                                Simple queues.--}}
{{--                                            </dt>--}}
{{--                                            <dd class="inline">Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus.</dd>--}}
{{--                                        </div>--}}
{{--                                        <div class="relative pl-9">--}}
{{--                                            <dt class="inline font-semibold text-white">--}}
{{--                                                <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                                    <path fill-rule="evenodd" d="M10 2.5c-1.31 0-2.526.386-3.546 1.051a.75.75 0 01-.82-1.256A8 8 0 0118 9a22.47 22.47 0 01-1.228 7.351.75.75 0 11-1.417-.49A20.97 20.97 0 0016.5 9 6.5 6.5 0 0010 2.5zM4.333 4.416a.75.75 0 01.218 1.038A6.466 6.466 0 003.5 9a7.966 7.966 0 01-1.293 4.362.75.75 0 01-1.257-.819A6.466 6.466 0 002 9c0-1.61.476-3.11 1.295-4.365a.75.75 0 011.038-.219zM10 6.12a3 3 0 00-3.001 3.041 11.455 11.455 0 01-2.697 7.24.75.75 0 01-1.148-.965A9.957 9.957 0 005.5 9c0-.028.002-.055.004-.082a4.5 4.5 0 018.996.084V9.15l-.005.297a.75.75 0 11-1.5-.034c.003-.11.004-.219.005-.328a3 3 0 00-3-2.965zm0 2.13a.75.75 0 01.75.75c0 3.51-1.187 6.745-3.181 9.323a.75.75 0 11-1.186-.918A13.687 13.687 0 009.25 9a.75.75 0 01.75-.75zm3.529 3.698a.75.75 0 01.584.885 18.883 18.883 0 01-2.257 5.84.75.75 0 11-1.29-.764 17.386 17.386 0 002.078-5.377.75.75 0 01.885-.584z" clip-rule="evenodd" />--}}
{{--                                                </svg>--}}
{{--                                                Advanced security.--}}
{{--                                            </dt>--}}
{{--                                            <dd class="inline">Lorem ipsum, dolor sit amet consectetur adipisicing elit aute id magna.</dd>--}}
{{--                                        </div>--}}
{{--                                        <div class="relative pl-9">--}}
{{--                                            <dt class="inline font-semibold text-white">--}}
{{--                                                <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                                    <path fill-rule="evenodd" d="M7.84 1.804A1 1 0 018.82 1h2.36a1 1 0 01.98.804l.331 1.652a6.993 6.993 0 011.929 1.115l1.598-.54a1 1 0 011.186.447l1.18 2.044a1 1 0 01-.205 1.251l-1.267 1.113a7.047 7.047 0 010 2.228l1.267 1.113a1 1 0 01.206 1.25l-1.18 2.045a1 1 0 01-1.187.447l-1.598-.54a6.993 6.993 0 01-1.929 1.115l-.33 1.652a1 1 0 01-.98.804H8.82a1 1 0 01-.98-.804l-.331-1.652a6.993 6.993 0 01-1.929-1.115l-1.598.54a1 1 0 01-1.186-.447l-1.18-2.044a1 1 0 01.205-1.251l1.267-1.114a7.05 7.05 0 010-2.227L1.821 7.773a1 1 0 01-.206-1.25l1.18-2.045a1 1 0 011.187-.447l1.598.54A6.993 6.993 0 017.51 3.456l.33-1.652zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />--}}
{{--                                                </svg>--}}
{{--                                                Powerful API.--}}
{{--                                            </dt>--}}
{{--                                            <dd class="inline">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo.</dd>--}}
{{--                                        </div>--}}
{{--                                        <div class="relative pl-9">--}}
{{--                                            <dt class="inline font-semibold text-white">--}}
{{--                                                <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                                    <path d="M4.632 3.533A2 2 0 016.577 2h6.846a2 2 0 011.945 1.533l1.976 8.234A3.489 3.489 0 0016 11.5H4c-.476 0-.93.095-1.344.267l1.976-8.234z" />--}}
{{--                                                    <path fill-rule="evenodd" d="M4 13a2 2 0 100 4h12a2 2 0 100-4H4zm11.24 2a.75.75 0 01.75-.75H16a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75h-.01a.75.75 0 01-.75-.75V15zm-2.25-.75a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75H13a.75.75 0 00.75-.75V15a.75.75 0 00-.75-.75h-.01z" clip-rule="evenodd" />--}}
{{--                                                </svg>--}}
{{--                                                Database backups.--}}
{{--                                            </dt>--}}
{{--                                            <dd class="inline">Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus.</dd>--}}
{{--                                        </div>--}}
{{--                                    </dl>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- Stats -->--}}
{{--                            <div class="mx-auto mt-32 max-w-7xl px-6 sm:mt-56 lg:px-8">--}}
{{--                                <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">--}}
{{--                                    <h2 class="text-base font-semibold leading-8 text-indigo-400">Our track record</h2>--}}
{{--                                    <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">Trusted by thousands of developers&nbsp;worldwide</p>--}}
{{--                                    <p class="mt-6 text-lg leading-8 text-gray-300">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.</p>--}}
{{--                                </div>--}}
{{--                                <dl class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-10 text-white sm:mt-20 sm:grid-cols-2 sm:gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-4">--}}
{{--                                    <div class="flex flex-col gap-y-3 border-l border-white/10 pl-6">--}}
{{--                                        <dt class="text-sm leading-6">Developers on the platform</dt>--}}
{{--                                        <dd class="order-first text-3xl font-semibold tracking-tight">8,000+</dd>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex flex-col gap-y-3 border-l border-white/10 pl-6">--}}
{{--                                        <dt class="text-sm leading-6">Daily requests</dt>--}}
{{--                                        <dd class="order-first text-3xl font-semibold tracking-tight">900m+</dd>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex flex-col gap-y-3 border-l border-white/10 pl-6">--}}
{{--                                        <dt class="text-sm leading-6">Uptime guarantee</dt>--}}
{{--                                        <dd class="order-first text-3xl font-semibold tracking-tight">99.9%</dd>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex flex-col gap-y-3 border-l border-white/10 pl-6">--}}
{{--                                        <dt class="text-sm leading-6">Projects deployed</dt>--}}
{{--                                        <dd class="order-first text-3xl font-semibold tracking-tight">12m</dd>--}}
{{--                                    </div>--}}
{{--                                </dl>--}}
{{--                            </div>--}}

{{--                            <!-- CTA section -->--}}
{{--                            <div class="relative isolate mt-32 px-6 py-32 sm:mt-56 sm:py-40 lg:px-8">--}}
{{--                                <svg class="absolute inset-0 -z-10 h-full w-full stroke-white/10 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]" aria-hidden="true">--}}
{{--                                    <defs>--}}
{{--                                        <pattern id="1d4240dd-898f-445f-932d-e2872fd12de3" width="200" height="200" x="50%" y="0" patternUnits="userSpaceOnUse">--}}
{{--                                            <path d="M.5 200V.5H200" fill="none" />--}}
{{--                                        </pattern>--}}
{{--                                    </defs>--}}
{{--                                    <svg x="50%" y="0" class="overflow-visible fill-gray-800/20">--}}
{{--                                        <path d="M-200 0h201v201h-201Z M600 0h201v201h-201Z M-400 600h201v201h-201Z M200 800h201v201h-201Z" stroke-width="0" />--}}
{{--                                    </svg>--}}
{{--                                    <rect width="100%" height="100%" stroke-width="0" fill="url(#1d4240dd-898f-445f-932d-e2872fd12de3)" />--}}
{{--                                </svg>--}}
{{--                                <div class="absolute inset-x-0 top-10 -z-10 flex transform-gpu justify-center overflow-hidden blur-3xl" aria-hidden="true">--}}
{{--                                    <div class="aspect-1108/632 w-[69.25rem] flex-none bg-linear-to-r from-[#80caff] to-[#4f46e5] opacity-20" style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)"></div>--}}
{{--                                </div>--}}
{{--                                <div class="mx-auto max-w-2xl text-center">--}}
{{--                                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Boost your productivity.<br>Start using our app today.</h2>--}}
{{--                                    <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-300">Incididunt sint fugiat pariatur cupidatat consectetur sit cillum anim id veniam aliqua proident excepteur commodo do ea.</p>--}}
{{--                                    <div class="mt-10 flex items-center justify-center gap-x-6">--}}
{{--                                        <a href="#" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-xs hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Get started</a>--}}
{{--                                        <a href="#" class="text-sm font-semibold leading-6 text-white">Learn more <span aria-hidden="true">→</span></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </main>

                        <!-- Footer -->
                        <footer aria-labelledby="footer-heading" class="relative">
                            <h2 id="footer-heading" class="sr-only">Footer</h2>
                            <div class="mx-auto max-w-7xl px-6 pb-8 pt-4 lg:px-8">
                                <div class="border-t border-white/10 pt-8 md:flex md:items-center md:justify-between">
                                    <div class="flex space-x-6 md:order-2">
{{--                                        <a href="#" class="text-gray-500 hover:text-gray-400">--}}
{{--                                            <span class="sr-only">Facebook</span>--}}
{{--                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">--}}
{{--                                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />--}}
{{--                                            </svg>--}}
{{--                                        </a>--}}
{{--                                        <a href="#" class="text-gray-500 hover:text-gray-400">--}}
{{--                                            <span class="sr-only">Instagram</span>--}}
{{--                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">--}}
{{--                                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />--}}
{{--                                            </svg>--}}
{{--                                        </a>--}}
{{--                                        <a href="#" class="text-gray-500 hover:text-gray-400">--}}
{{--                                            <span class="sr-only">X</span>--}}
{{--                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">--}}
{{--                                                <path d="M13.6823 10.6218L20.2391 3H18.6854L12.9921 9.61788L8.44486 3H3.2002L10.0765 13.0074L3.2002 21H4.75404L10.7663 14.0113L15.5685 21H20.8131L13.6819 10.6218H13.6823ZM11.5541 13.0956L10.8574 12.0991L5.31391 4.16971H7.70053L12.1742 10.5689L12.8709 11.5655L18.6861 19.8835H16.2995L11.5541 13.096V13.0956Z" />--}}
{{--                                            </svg>--}}
{{--                                        </a>--}}
{{--                                        <a href="#" class="text-gray-500 hover:text-gray-400">--}}
{{--                                            <span class="sr-only">GitHub</span>--}}
{{--                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">--}}
{{--                                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />--}}
{{--                                            </svg>--}}
{{--                                        </a>--}}
{{--                                        <a href="#" class="text-gray-500 hover:text-gray-400">--}}
{{--                                            <span class="sr-only">YouTube</span>--}}
{{--                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">--}}
{{--                                                <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd" />--}}
{{--                                            </svg>--}}
{{--                                        </a>--}}
                                    </div>
                                    <p class="mt-8 text-xs leading-5 text-gray-400 md:order-1 md:mt-0">&copy; 2024 Logic Flow, Все права защищены.</p>
                                </div>
                            </div>
                        </footer>
                    </div>
    </div>


    </body>
</html>

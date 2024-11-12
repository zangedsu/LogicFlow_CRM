

    <!-- Start All Card -->
    <div class="flex flex-col gap-4 min-h-[calc(100vh-212px)] h-screen">
{{--        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">--}}
{{--        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>--}}
        <div class="relative flex flex-row items-stretch gap-4" x-data="{ selectedchat: false }">

            <div class="lg:max-w-[326px] w-full bg-white flex-1 flex flex-col gap-2 border border-black/10 dark:bg-zinc-900 rounded-xl">
                <div x-data="{ open:false }" class="flex items-center justify-between gap-2 px-4 py-2 dark:bg-transparent border-b">
                    <div class="relative w-full ">
{{--                        <input @click="open = true" type="text" id="voice-search"--}}
{{--                               class="h-10 form-input dark:text-white/80 dark:placeholder:text-white/30  ring-0 border-b dark:border-darkborder dark:bg-transparent dark:focus:border-white/30"--}}
{{--                               placeholder="Поиск..." required="">--}}
                        <!-- search box -->
                            <div>

                                <div @click.away="open = false" @close.stop="open = false" @keyup.escape="open = false" class="relative">
                                    <input wire:keydown.enter="selectChatFromSearch('private',{{$team_contacts->first()?->id}})" wire:model.live="chat_search" @click="open = true " id="combobox" type="text"
                                           class="w-full bg-transparent transition-all duration-500 rounded-md border-0 py-1.5 pl-3 pr-12 text-white shadow-sm ring-1 ring-inset ring-gray-300 disabled:opacity-50 disabled:bg-gray-200 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                           role="combobox" aria-controls="options" aria-expanded="false" placeholder="Поиск...">
                                    <button  @click="open = ! open" type="button"
                                            class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 disabled:opacity-50 focus:outline-none">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                             aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>

                                    <ul x-collapse.duration.700ms x-show="open" class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-zinc-900/80 backdrop-blur py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                        id="options" role="listbox">
                                        <!--
                                          Combobox option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                                          Active: "text-white bg-indigo-600", Not Active: "text-gray-900"
                                        -->
                                        @if($team_contacts?->count() > 0)
                                            @foreach($team_contacts as $contact)
                                                <li wire:click="selectChatFromSearch('private',{{$contact->id}})" wire:key="{{$contact->id}}" class="relative cursor-default select-none py-2 pl-3 pr-9 text-white"
                                                    role="option" tabindex="-1">
                                                    <!-- Selected: "font-semibold" -->
                                                    <span class="block truncate">{{$contact->name}}</span>

                                                </li>
                                            @endforeach
                                        @else
                                            <p class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900">Ничего не нашлось 😕</p>
                                        @endif

                                    </ul>
                                </div>



                        </div>
                        <!-- search box -->
                    </div>


                        <div class="flex items-center gap-2">
{{--                        <button x-show="!open" x-transition.duration.100ms type="button"--}}
{{--                                class="flex items-center justify-center w-6 h-6 text-black transition-all duration-300 rounded sm:w-9 sm:h-9 dark:text-zinc-300 dark:hover:text-white dark:hover:bg-white/5 hover:bg-light/50">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">--}}
{{--                                <path fill="currentColor"--}}
{{--                                      d="M3 2H19.0049C20.1068 2 21 2.89821 21 3.9908V20.0092C21 21.1087 20.1074 22 19.0049 22H3V2ZM7 4H5V20H7V4ZM9 20H19V4H9V20ZM11 16C11 14.3431 12.3431 13 14 13C15.6569 13 17 14.3431 17 16H11ZM14 12C12.8954 12 12 11.1046 12 10C12 8.89543 12.8954 8 14 8C15.1046 8 16 8.89543 16 10C16 11.1046 15.1046 12 14 12ZM22 6H24V10H22V6ZM22 12H24V16H22V12Z">--}}
{{--                                </path>--}}
{{--                            </svg>--}}
{{--                        </button>--}}
                        <div x-show="!open" x-transition.duration.100ms x-data="{ dropdown: false }" class="ltr:ml-auto rtl:mr-auto dropdown">
                            <a href="javaScript:;"
                               class="flex items-center justify-center w-6 h-6 text-black transition-all duration-300 rounded sm:w-9 sm:h-9 dark:text-zinc-300 dark:hover:text-white dark:hover:bg-white/5 hover:bg-light/50"
                               @click="dropdown = !dropdown" @keydown.escape="dropdown = false">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                                    <path fill="currentColor"
                                          d="M12 3C11.175 3 10.5 3.675 10.5 4.5C10.5 5.325 11.175 6 12 6C12.825 6 13.5 5.325 13.5 4.5C13.5 3.675 12.825 3 12 3ZM12 18C11.175 18 10.5 18.675 10.5 19.5C10.5 20.325 11.175 21 12 21C12.825 21 13.5 20.325 13.5 19.5C13.5 18.675 12.825 18 12 18ZM12 10.5C11.175 10.5 10.5 11.175 10.5 12C10.5 12.825 11.175 13.5 12 13.5C12.825 13.5 13.5 12.825 13.5 12C13.5 11.175 12.825 10.5 12 10.5Z">
                                    </path>
                                </svg>
                            </a>
                            <ul x-show="dropdown" @click.away="dropdown = false" x-transition=""
                                x-transition.duration.300ms="" class="ltr:right-0 absolute bg-zinc-700 rounded-xl text-white p-4 rtl:left-0 whitespace-nowrap">
                                <li><a href="javascript:;">Новая группа</a></li>
{{--                                <li><a href="javascript:;">Starred Massage</a></li>--}}
{{--                                <li><a href="javascript:;">Setting</a></li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="space-y-2 h-[calc(100vh-277px)] px-4 overflow-y-auto">
                    <!-- team chat -->
                    <li>
                        <a  wire:click="selectChat('team')" @click="selectedchat = true"
                           class="flex items-start gap-2 p-2 transition-all cursor-pointer duration-300 rounded bg-light/50 dark:bg-white/10 dark:hover:bg-white/10 hover:border-transparent hover:bg-light/50">
                            <div class="flex items-center flex-1 gap-2 p-1">
                                <div class="w-9 h-9">
                                    <div class="h-8 w-8 flex rounded-full bg-gray-50" ><div class="m-auto">{{mb_substr(\Illuminate\Support\Facades\Auth::user()->currentTeam()->first()->name, 0, 1)}}</div></div>
                                </div>
                                <div class="flex-1 ltr:text-left rtl:text-right">
                                    <p class="line-clamp-1 dark:text-white">Чат команды {{\Illuminate\Support\Facades\Auth::user()->currentTeam()->first()->name}}</p>
                                    <p class="text-xs text-zinc-300 line-clamp-1">{{Auth::user()->currentTeam->chat->messages()->latest()->take(1)->first()->message ?? 'Нет сообщений'}}</p>
                                </div>
                            </div>
                            <div class="ltr:text-right rtl:text-left">
{{--                                <p class="flex-none text-xs text-zinc-500 mb-1.5">19:28</p>--}}
                                <span class="inline-block items-center rounded text-xs justify-center px-1.5 py-0.5 bg-purple text-white">{{$this->unreadMessagesCount(Auth::user()->currentTeam->chat->id)}}</span>
                            </div>
                        </a>
                    </li>
                    @if($chat_list?->count() > 0)
                        @foreach($chat_list as $chat)
                    <li>
                        <a wire:click="selectChat({{$chat->id}})" @click="selectedchat = true"
                           class="flex items-start gap-2 p-2 transition-all duration-300 rounded bg-light/50 dark:bg-white/10 dark:hover:bg-white/10 hover:border-transparent hover:bg-light/50">
                            <div class="flex items-center flex-1 gap-2 p-1">
                                <div class="w-9 h-9">
{{--                                    <img class="flex-none object-cover overflow-hidden rounded-full"--}}
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ $chat->members()->where('users.id', '!=', Auth::id())->first()->profile_photo_path ? asset('storage/'. $chat->members()->where('users.id', '!=', Auth::id())->first()->profile_photo_path) :  $chat->members()->where('users.id', '!=', Auth::id())->first()->profile_photo_url }}" alt="" />
                                </div>
                                <div class="flex-1 ltr:text-left rtl:text-right">
                                    <p class="line-clamp-1 dark:text-white">{{$this->getChatName($chat)}}</p>
                                    <p class="text-xs text-zinc-300 line-clamp-1">{{$chat->messages()->latest()->take(1)->first()->message ?? 'Нет сообщений'}}</p>
                                </div>
                            </div>
                            <div class="ltr:text-right rtl:text-left">
                                <p class="flex-none text-xs text-zinc-500 mb-1.5">{{\Carbon\Carbon::parse($chat->messages()->latest()->take(1)->first()->created_at)->toTimeString('minute') ?? ''}}</p>
                                <span class="inline-block items-center rounded text-xs justify-center px-1.5 py-0.5 bg-purple text-white">{{$this->unreadMessagesCount($chat->id)}}</span>
                            </div>
                        </a>
                    </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <div x-data="{ open_emoji : false }" class="h-full  flex-1 w-full bg-white dark:bg-zinc-900 rounded-xl "
                 :class="!selectedchat ? 'hidden md:block' : ''">
                <div x-data="{ inputText: '' }" class="border rounded border-black/10 ">
                    @if($selected_chat)
                    <div class="flex justify-between gap-3 p-3 border-b  dark:border-darkborder">

                        <div class="flex items-center gap-2 p-1">
                            <button type="button" class="md:hidden" @click="selectedchat = false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     fill="currentColor" viewBox="0 0 256 256">
                                    <path
                                        d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z">
                                    </path>
                                </svg>
                            </button>
                            @if($selected_chat->chat_type == 'private')
                            <img class="flex-none object-cover overflow-hidden rounded-full w-9 h-9"
                                 src="{{ asset('storage/profile-photos/wXAqjD2iVYVhgvBh6RNsS9WMr7U2l9I1KTwmCxVq.jpg') }}" alt="">
                            @else
                                <div class="h-9 w-9 flex rounded-full bg-gray-50" ><div class="m-auto">{{mb_substr(\Illuminate\Support\Facades\Auth::user()->currentTeam()->first()->name, 0, 1)}}</div></div>
                            @endif
                            <div>
                                <p class="dark:text-white">{{$this->getChatName($selected_chat)}}</p>
                               @if($selected_chat->chat_type == 'private')  <p class="text-xs text-zinc-300">{{$selected_chat->members()->where('users.id', '!=', Auth::id())->first()->email}}</p> @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="button"
                                    class="flex items-center justify-center w-6 h-6 text-black transition-all duration-300 bg-transparent rounded sm:w-9 sm:h-9 dark:text-zinc-300 dark:hover:text-white dark:hover:bg-white/5 hover:bg-light/40">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                                    <path fill="currentColor"
                                          d="M9.36556 10.6821C10.302 12.3288 11.6712 13.698 13.3179 14.6344L14.2024 13.3961C14.4965 12.9845 15.0516 12.8573 15.4956 13.0998C16.9024 13.8683 18.4571 14.3353 20.0789 14.4637C20.599 14.5049 21 14.9389 21 15.4606V19.9234C21 20.4361 20.6122 20.8657 20.1022 20.9181C19.5723 20.9726 19.0377 21 18.5 21C9.93959 21 3 14.0604 3 5.5C3 4.96227 3.02742 4.42771 3.08189 3.89776C3.1343 3.38775 3.56394 3 4.07665 3H8.53942C9.0611 3 9.49513 3.40104 9.5363 3.92109C9.66467 5.54288 10.1317 7.09764 10.9002 8.50444C11.1427 8.9484 11.0155 9.50354 10.6039 9.79757L9.36556 10.6821ZM6.84425 10.0252L8.7442 8.66809C8.20547 7.50514 7.83628 6.27183 7.64727 5H5.00907C5.00303 5.16632 5 5.333 5 5.5C5 12.9558 11.0442 19 18.5 19C18.667 19 18.8337 18.997 19 18.9909V16.3527C17.7282 16.1637 16.4949 15.7945 15.3319 15.2558L13.9748 17.1558C13.4258 16.9425 12.8956 16.6915 12.3874 16.4061L12.3293 16.373C10.3697 15.2587 8.74134 13.6303 7.627 11.6707L7.59394 11.6126C7.30849 11.1044 7.05754 10.5742 6.84425 10.0252Z">
                                    </path>
                                </svg>
                            </button>
                            <button type="button"
                                    class="flex items-center justify-center w-6 h-6 text-black transition-all duration-300 bg-transparent rounded sm:w-9 sm:h-9 dark:text-zinc-300 dark:hover:text-white dark:hover:bg-white/5 hover:bg-light/40">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M0.991116 4.42862C0.991116 4.42862 1.35723 4.0625 1.875 4.0625H11.875C11.875 4.0625 13.1694 4.0625 14.0847 4.97779C14.0847 4.97779 15 5.89308 15 7.1875V14.6875C15 14.6875 15 15.2053 14.6339 15.5714C14.6339 15.5714 14.2678 15.9375 13.75 15.9375H3.75C3.75 15.9375 2.45558 15.9375 1.54029 15.0222C1.54029 15.0222 0.625 14.1069 0.625 12.8125V5.3125C0.625 5.3125 0.625 4.79473 0.991116 4.42862ZM1.875 5.3125V12.8125C1.875 12.8125 1.875 13.5892 2.42417 14.1383C2.42417 14.1383 2.97335 14.6875 3.75 14.6875H13.75V7.1875C13.75 7.1875 13.75 6.41085 13.2008 5.86167C13.2008 5.86167 12.6517 5.3125 11.875 5.3125H1.875Z"
                                          fill="currentcolor" />
                                    <path
                                        d="M18.125 12.673L14.6851 10.7073C14.5907 10.6534 14.4838 10.625 14.375 10.625L14.361 10.6252C14.3101 10.6263 14.2596 10.6336 14.2106 10.647C14.0506 10.6906 13.9146 10.796 13.8323 10.9399C13.7784 11.0343 13.75 11.1412 13.75 11.25C13.75 11.2625 13.7504 11.2749 13.7511 11.2874C13.7637 11.498 13.8817 11.688 14.0649 11.7927L18.4399 14.2927C18.7396 14.4639 19.1214 14.3598 19.2927 14.0601C19.3466 13.9657 19.375 13.8588 19.375 13.75V6.25C19.375 5.90482 19.0952 5.625 18.75 5.625C18.6412 5.625 18.5343 5.65338 18.4399 5.70735L14.0649 8.20735C13.8702 8.31862 13.75 8.52571 13.75 8.75C13.75 8.75874 13.7502 8.76748 13.7505 8.77621C13.7547 8.87601 13.7828 8.97336 13.8323 9.06009C13.9146 9.20401 14.0506 9.30936 14.2106 9.35298C14.2641 9.36759 14.3194 9.375 14.375 9.375L14.3919 9.37477C14.4949 9.37198 14.5956 9.34377 14.6851 9.29265L18.125 7.32699V12.673Z"
                                        fill="currentcolor" />
                                </svg>
                            </button>
                            <button type="button" x-data="{ dropdown: false }" class="ml-auto dropdown">
                                <a href="javaScript:;"
                                   class="flex items-center justify-center w-6 h-6 text-black transition-all duration-300 bg-transparent rounded sm:w-9 sm:h-9 dark:text-zinc-300 dark:hover:text-white dark:hover:bg-white/5 hover:bg-light/40"
                                   @click="dropdown = !dropdown" @keydown.escape="dropdown = false">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                                        <path fill="currentColor"
                                              d="M12 3C11.175 3 10.5 3.675 10.5 4.5C10.5 5.325 11.175 6 12 6C12.825 6 13.5 5.325 13.5 4.5C13.5 3.675 12.825 3 12 3ZM12 18C11.175 18 10.5 18.675 10.5 19.5C10.5 20.325 11.175 21 12 21C12.825 21 13.5 20.325 13.5 19.5C13.5 18.675 12.825 18 12 18ZM12 10.5C11.175 10.5 10.5 11.175 10.5 12C10.5 12.825 11.175 13.5 12 13.5C12.825 13.5 13.5 12.825 13.5 12C13.5 11.175 12.825 10.5 12 10.5Z">
                                        </path>
                                    </svg>
                                </a>
                                <ul x-show="dropdown" @click.away="dropdown = false" x-transition=""
                                    x-transition.duration.300ms="" class="ltr:right-0 rtl:left-0 whitespace-nowrap"
                                    style="display: none;">
                                    <li><a href="javascript:;">View Profile</a></li>
                                    <li><a href="javascript:;">Media, links and docs</a></li>
                                    <li><a href="javascript:;">Mute notification</a></li>
                                    <li><a href="javascript:;">Setting</a></li>
                                </ul>
                            </button>
                        </div>

                    </div>
                    @endif
                    <div class="h-[calc(100vh-346px)] relative overflow-y-auto bg-transparent p-5">
                        @if($selected_chat)
                        <div class="grid max-w-4xl  grid-cols-1 mx-auto space-y-7">
                                @foreach($selected_chat_messages as $message)
                                    @if($message->sender_id == \Illuminate\Support\Facades\Auth::id())
                                        <div class="ltr:text-right rtl:text-left place-self-end">
                                            <div class="text-white max-w-60  ltr:rounded-bl-none rtl:rounded-br-none bg-gradient-to-r from-teal-700/20 to-cyan-700/20 rounded-lg p-2 px-4">
                                               {!! $message->message!!}
                                            </div>
                                            <div class="text-xs font-extralight pt-2 px-2 text-gray-300">
                                                {{\Carbon\Carbon::parse($message->created_at)->locale('ru')->diffForHumans()}}
                                            </div>
                                        </div>
                                    @else
                                    <div class="ltr:text-right rtl:text-left place-self-start ">
                                        <div class="text-white max-w-60 ltr:rounded-bl-none rtl:rounded-br-none bg-white/5 rounded-lg p-2 px-4">
                                            {!! $message->message!!}
                                        </div>
                                        <div class="text-xs font-extralight pt-2 px-2 text-gray-300">
                                            {{\Carbon\Carbon::parse($message->created_at)->locale('ru')->diffForHumans()}}
                                        </div>
                                    </div>
                                    @endif

                                @endforeach

                        </div>
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white">
                               Сначала выберите чат
                            </div>
                        @endif
                    </div>
                        <!-- emoji panel -->
                        <div @click.away="open_emoji = false" x-show="open_emoji" x-transition class="absolute bottom-16 m-2 min-h-24 w-full p-2 md:w-1/3 bg-zinc-800/80  backdrop-blur rounded flex flex-wrap gap-2">
                            <button @click="$wire.new_message_text += '👍'" class="hover:scale-125 duration-300">👍</button>
                            <button @click="$wire.new_message_text += '👎'" class="hover:scale-125 duration-300">👎</button>
                            <button @click="$wire.new_message_text += '👊'" class="hover:scale-125 duration-300">👊</button>
                            <button @click="$wire.new_message_text += '👋'" class="hover:scale-125 duration-300">👋</button>
                            <button @click="$wire.new_message_text += '🎉'" class="hover:scale-125 duration-300">🎉</button>
                            <button @click="$wire.new_message_text += '🙂'" class="hover:scale-125 duration-300">🙂</button>
                            <button @click="$wire.new_message_text += '😢'" class="hover:scale-125 duration-300">😢</button>
                            <button @click="$wire.new_message_text += '🤟'" class="hover:scale-125 duration-300">🤟</button>
                            <button @click="$wire.new_message_text += '😧'" class="hover:scale-125 duration-300">😧</button>
                            <button @click="$wire.new_message_text += '🤬'" class="hover:scale-125 duration-300">🤬</button>
                            <button @click="$wire.new_message_text += '🤮'" class="hover:scale-125 duration-300">🤮</button>
                            <button @click="$wire.new_message_text += '😘'" class="hover:scale-125 duration-300">😘</button>
                            <button @click="$wire.new_message_text += '️️️😱'" class="hover:scale-125 duration-300">😱</button>
                            <button @click="$wire.new_message_text += '😧️'" class="hover:scale-125 duration-300">😧️</button>
                            <button @click="$wire.new_message_text += '🤢'" class="hover:scale-125 duration-300">🤢</button>
                            <button @click="$wire.new_message_text += '😝'" class="hover:scale-125 duration-300">😝</button>
                            <button @click="$wire.new_message_text += '🤨'" class="hover:scale-125 duration-300">🤨</button>
                            <button @click="$wire.new_message_text += '😐'" class="hover:scale-125 duration-300">😐</button>
                            <button @click="$wire.new_message_text += '😞'" class="hover:scale-125 duration-300">😞</button>
                            <button @click="$wire.new_message_text += '🥳'" class="hover:scale-125 duration-300">🥳</button>
                            <button @click="$wire.new_message_text += '😤'" class="hover:scale-125 duration-300">😤</button>
                            <button @click="$wire.new_message_text += '😪'" class="hover:scale-125 duration-300">😪</button>
                            <button @click="$wire.new_message_text += '💶'" class="hover:scale-125 duration-300">💶</button>
                            <button @click="$wire.new_message_text += '😍'" class="hover:scale-125 duration-300">😍</button>
                            <button @click="$wire.new_message_text += '👌'" class="hover:scale-125 duration-300">👌</button>
                            <button @click="$wire.new_message_text += '😉'" class="hover:scale-125 duration-300">😉</button>
                            <button @click="$wire.new_message_text += '😁'" class="hover:scale-125 duration-300">😁</button>
                            <button @click="$wire.new_message_text += '😎'" class="hover:scale-125 duration-300">😎</button>
                            <button @click="$wire.new_message_text += '👀'" class="hover:scale-125 duration-300">👀</button>
                            <button @click="$wire.new_message_text += '🩼'" class="hover:scale-125 duration-300">🩼</button>
                        </div>
                    <div class="">
                        @if($selected_chat)
                        <div class="flex items-center gap-4 px-4 py-2 bg-light/20 border-t">
                            <div class="flex items-center flex-none gap-2">
{{--                                <button type="button"--}}
{{--                                        class="flex items-center justify-center w-6 h-6 text-black transition-all duration-300 bg-transparent rounded sm:w-9 sm:h-9 dark:text-zinc-300 dark:hover:text-white dark:hover:bg-white/5 hover:bg-light/40">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">--}}
{{--                                        <path fill="currentColor"--}}
{{--                                              d="M11.9998 3C10.3429 3 8.99976 4.34315 8.99976 6V10C8.99976 11.6569 10.3429 13 11.9998 13C13.6566 13 14.9998 11.6569 14.9998 10V6C14.9998 4.34315 13.6566 3 11.9998 3ZM11.9998 1C14.7612 1 16.9998 3.23858 16.9998 6V10C16.9998 12.7614 14.7612 15 11.9998 15C9.23833 15 6.99976 12.7614 6.99976 10V6C6.99976 3.23858 9.23833 1 11.9998 1ZM3.05469 11H5.07065C5.55588 14.3923 8.47329 17 11.9998 17C15.5262 17 18.4436 14.3923 18.9289 11H20.9448C20.4837 15.1716 17.1714 18.4839 12.9998 18.9451V23H10.9998V18.9451C6.82814 18.4839 3.51584 15.1716 3.05469 11Z">--}}
{{--                                        </path>--}}
{{--                                    </svg>--}}
{{--                                </button>--}}
{{--                                <button type="button"--}}
{{--                                        class="flex items-center justify-center w-6 h-6 transition-all duration-300 bg-transparent rounded sm:w-9 sm:h-9 dark:text-zinc-300 dark:hover:text-white dark:hover:bg-white/5 hover:bg-light/40">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">--}}
{{--                                        <path fill="currentColor"--}}
{{--                                              d="M21 15V18H24V20H21V23H19V20H16V18H19V15H21ZM21.0082 3C21.556 3 22 3.44495 22 3.9934V13H20V5H4V18.999L14 9L17 12V14.829L14 11.8284L6.827 19H14V21H2.9918C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H21.0082ZM8 7C9.10457 7 10 7.89543 10 9C10 10.1046 9.10457 11 8 11C6.89543 11 6 10.1046 6 9C6 7.89543 6.89543 7 8 7Z">--}}
{{--                                        </path>--}}
{{--                                    </svg>--}}
{{--                                </button>--}}
                                <button @click="open_emoji = !open_emoji" type="button"
                                        class="flex items-center justify-center w-6 h-6 text-black transition-all duration-300 bg-transparent rounded sm:w-9 sm:h-9 dark:text-zinc-300 dark:hover:text-white dark:hover:bg-white/5 hover:bg-light/40">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                                        <path fill="currentColor"
                                              d="M10.5199 19.8634C10.5955 18.6615 10.8833 17.5172 11.3463 16.4676C9.81124 16.3252 8.41864 15.6867 7.33309 14.7151L8.66691 13.2248C9.55217 14.0172 10.7188 14.4978 12 14.4978C12.1763 14.4978 12.3501 14.4887 12.5211 14.471C14.227 12.2169 16.8661 10.7083 19.8634 10.5199C19.1692 6.80877 15.9126 4 12 4C7.58172 4 4 7.58172 4 12C4 15.9126 6.80877 19.1692 10.5199 19.8634ZM19.0233 12.636C15.7891 13.2396 13.2396 15.7891 12.636 19.0233L19.0233 12.636ZM22 12C22 12.1677 21.9959 12.3344 21.9877 12.5L12.5 21.9877C12.3344 21.9959 12.1677 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM10 10C10 10.8284 9.32843 11.5 8.5 11.5C7.67157 11.5 7 10.8284 7 10C7 9.17157 7.67157 8.5 8.5 8.5C9.32843 8.5 10 9.17157 10 10ZM17 10C17 10.8284 16.3284 11.5 15.5 11.5C14.6716 11.5 14 10.8284 14 10C14 9.17157 14.6716 8.5 15.5 8.5C16.3284 8.5 17 9.17157 17 10Z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <input x-model="inputText" wire:keydown.enter="sendMessage" wire:model="new_message_text" type="text" value="" placeholder="Введите сообщение"
                                   class="w-full bg-transparent transition-all duration-500 rounded-md border-0 py-1.5 pl-3 pr-12 text-white shadow-sm ring-1 ring-inset ring-gray-300 disabled:opacity-50 disabled:bg-gray-200 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <button wire:click="sendMessage" type="button"
                                    class="btn py-2 px-3 bg-purple border border-purple rounded-md text-white transition-all duration-300 hover:bg-purple/[0.85] hover:border-purple/[0.85]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                                    <path fill="currentColor"
                                          d="M3.5 1.3457C3.58425 1.3457 3.66714 1.36699 3.74096 1.4076L22.2034 11.562C22.4454 11.695 22.5337 11.9991 22.4006 12.241C22.3549 12.3241 22.2865 12.3925 22.2034 12.4382L3.74096 22.5925C3.499 22.7256 3.19497 22.6374 3.06189 22.3954C3.02129 22.3216 3 22.2387 3 22.1544V1.8457C3 1.56956 3.22386 1.3457 3.5 1.3457ZM5 4.38261V11.0001H10V13.0001H5V19.6175L18.8499 12.0001L5 4.38261Z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End All Card -->


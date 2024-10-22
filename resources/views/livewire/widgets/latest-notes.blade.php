<div class="h-fit  min-h-full ">
    <!-- Activity feed -->
    <h2 class="text-lg font-extralight text-sky-700 uppercase leading-6 ">Последние заметки к задачам</h2>
    @if($notes?->count() > 0)
        <ul role="list" class="mt-6 space-y-6 max-h-96 overflow-y-auto scroll-auto -scroll-ml-10">
            @foreach($notes as $note)
                <li class="relative flex gap-x-4">
                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                        <div class="w-px bg-gray-200"></div>
                    </div>
                    <img src="{{ $note->user()->first()->profile_photo_path ? asset('storage/'. $note->user()->first()->profile_photo_path) :$note->user()->first()->profile_photo_url }}" alt="" class="relative mt-3 h-6 w-6 flex-none rounded-full bg-gray-50">
                    <div class="flex-auto bg-zinc-900 rounded-md p-3 ring-1 ring-inset ring-gray-200">
                        <div class="flex justify-between gap-x-4">
                            <div class="py-0.5 text-xs leading-5 text-gray-50"><span class="font-medium text-gray-100">{{$note->user()->first()->name}}</span> написал(а)</div>
                            <time datetime="2023-01-23T15:56" class="flex-none py-0.5 text-xs leading-5 text-gray-500 font-mono">{{$this->getFormattedTime($note->created_at)}}</time>
                        </div>
                        <p class="text-sm leading-6 text-gray-500">{{$note->text}}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="text-sm py-6 w-full text-white">Пока нет комментариев 🤷‍</div>
    @endif

    <!-- New comment form -->
{{--    <div class="mt-6 flex gap-x-3">--}}
{{--        <img src="{{ auth()->user()->profile_photo_path ? asset('storage/'.auth()->user()->profile_photo_path) :auth()->user()->profile_photo_url }}" alt="" class="h-6 w-6 flex-none rounded-full bg-gray-50">--}}
{{--        <form wire:submit="sendComment" class="relative flex-auto">--}}
{{--            <div class="overflow-hidden rounded-lg pb-12 shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">--}}
{{--                <label for="comment" class="sr-only">Текст комментария</label>--}}
{{--                <textarea wire:model="comment_text" rows="2" name="comment" id="comment" class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-50 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Текст комментария..."></textarea>--}}
{{--            </div>--}}

{{--            <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">--}}
{{--                <div class="flex items-center space-x-5">--}}
{{--                    <div class="flex items-center">--}}
{{--                        --}}{{--                        <button type="button" class="-m-2.5 flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500">--}}
{{--                        --}}{{--                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                        --}}{{--                                <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />--}}
{{--                        --}}{{--                            </svg>--}}
{{--                        --}}{{--                            <span class="sr-only">Attach a file</span>--}}
{{--                        --}}{{--                        </button>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <button type="submit" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Отправить</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
</div>

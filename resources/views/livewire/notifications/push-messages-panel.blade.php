<div>

    @if($notifications->count()>0)
            <div aria-live="assertive" class="z-50 pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6 overflow-y-auto">
                <div class="flex w-full flex-col items-center space-y-4 sm:items-end ">
                    @foreach($notifications as $index => $notification)
                    <div wire:key="{{Str::random(15)}}" class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white/80 backdrop-blur-xl shadow-lg ring-1 ring-black ring-opacity-5">
                        @script
                        <script>
                            setTimeout(() => {
                                $wire.hideNotification({{$notification['id']}})
                            }, 5000)
                        </script>
                        @endscript

                        <div class="p-4">

                            <div class="flex items-center">
                                <div class="flex w-0 flex-1 justify-between">
                                    <p class="w-0 flex-1 text-sm font-medium text-gray-900">{{$notification['msg']}}</p>
                                </div>
                                <div class="ml-4 flex shrink-0">
                                    <button type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" wire:click="hideNotification({{$notification['id']}})">
                                        <span class="sr-only">Close</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

    @endif

</div>

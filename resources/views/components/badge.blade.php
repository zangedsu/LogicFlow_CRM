@php
    $statusStyles = [
        'new' => 'border-sky-500 text-sky-500',
        'in_process' => 'border-emerald-500 text-emerald-500',
        'failed' => 'border-red-500 text-red-500',
        'completed' => 'border-gray-500 text-gray-500',
    ];
@endphp
<span class="w-fit cursor-pointer inline-flex overflow-hidden rounded-md border bg-neutral-950  text-xs font-medium {{ $statusStyles[$state] ?? '' }}">
    <span class="flex items-center gap-1 bg-sky-500/10 px-2 py-1 dark:bg-emerald-500/10">
      <span class="flex size-1 items-center justify-center rounded-full bg-emerald-500 dark:emerald-500"
            aria-label="notification">
    <span class="size-1 animate-ping rounded-full bg-sky-500 motion-reduce:animate-none dark:emerald-500">
    </span>
</span>
        {{ $slot }}
    </span>
</span>

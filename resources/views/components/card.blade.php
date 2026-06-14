@props(['title' => null, 'subtitle' => null, 'padding' => 'p-6'])
<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700']) }}>
    @if ($title || isset($header) || isset($actions))
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between gap-3">
            <div class="min-w-0">
                @isset($header)
                    {{ $header }}
                @else
                    <h3 class="font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $title }}</h3>
                    @if ($subtitle)<p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $subtitle }}</p>@endif
                @endisset
            </div>
            @isset($actions)<div class="shrink-0">{{ $actions }}</div>@endisset
        </div>
    @endif
    <div class="{{ $padding }}">{{ $slot }}</div>
</div>

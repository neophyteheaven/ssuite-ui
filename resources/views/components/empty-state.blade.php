@props(['title' => 'Nothing here yet', 'description' => null])
<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center text-center py-12 px-6']) }}>
    <div class="w-12 h-12 rounded-full bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center mb-4 text-brand-500">
        @isset($icon)
            {{ $icon }}
        @else
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6h6v6m2 4H7a2 2 0 01-2-2V5a2 2 0 012-2h6l6 6v10a2 2 0 01-2 2z"/></svg>
        @endisset
    </div>
    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $title }}</h3>
    @if ($description)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1 max-w-sm">{{ $description }}</p>@endif
    @isset($action)<div class="mt-4">{{ $action }}</div>@endisset
</div>

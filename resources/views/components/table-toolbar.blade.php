@props([
    'searchable' => true,
    'placeholder' => 'Search…',
])

{{-- Shared s-suite table toolbar: search box (left) + filters/actions slots (right).
     Brand-themed via the --color-brand-* token scale from the ssuite-ui Tailwind preset.
     Usage:
       <x-table-toolbar>
           <x-slot:filters> … status / date filters … </x-slot:filters>
           <x-slot:actions> <x-primary-button>New</x-primary-button> </x-slot:actions>
       </x-table-toolbar>
--}}
<div {{ $attributes->merge(['class' => 'flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-4']) }}>
    <div class="flex flex-1 items-center gap-2">
        @if($searchable)
            <div class="relative w-full sm:max-w-xs">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                    </svg>
                </span>
                <input type="search"
                    {{ ($attributes->has('wire:model') ? $attributes->only('wire:model') : '') }}
                    placeholder="{{ $placeholder }}"
                    class="block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:border-brand-500 focus:ring-brand-500 py-2.5 pl-9 pr-4 text-sm placeholder-gray-400 shadow-sm transition" />
            </div>
        @endif
        @isset($filters)
            <div class="flex items-center gap-2">{{ $filters }}</div>
        @endisset
    </div>

    @isset($actions)
        <div class="flex items-center gap-2">{{ $actions }}</div>
    @endisset
</div>

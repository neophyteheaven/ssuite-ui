@props(['variant' => 'primary', 'type' => 'submit', 'href' => null])
@php
    $base = 'inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 disabled:opacity-50 disabled:pointer-events-none';
    $variants = [
        'primary'   => 'bg-brand-600 hover:bg-brand-700 text-white shadow-sm',
        'secondary' => 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700',
        'danger'    => 'bg-red-600 hover:bg-red-700 text-white shadow-sm',
        'ghost'     => 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700',
    ];
    $cls = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp
@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $cls]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $cls]) }}>{{ $slot }}</button>
@endif

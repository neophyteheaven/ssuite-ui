@props(['name', 'id' => null, 'label' => null, 'type' => 'text', 'hint' => null])
@php $id = $id ?? $name; @endphp
<div>
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
        {{ $attributes->merge(['class' => 'w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 text-sm focus:border-brand-500 focus:ring-brand-500']) }}>
    @if ($hint)<p class="mt-1 text-xs text-gray-400 dark:text-gray-500">{{ $hint }}</p>@endif
    @error($name)<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
</div>

@props(['name', 'id' => null, 'label' => null, 'multiple' => false])
@php $id = $id ?? $name; @endphp
{{-- Brand-themed TomSelect dropdown. The init script lives in the shared
     partials/tomselect.blade.php (include it once in the app layout); this
     component just renders the .js-select element it enhances. --}}
<div>
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ $label }}</label>
    @endif
    <select name="{{ $name }}{{ $multiple ? '[]' : '' }}" id="{{ $id }}" @if ($multiple) multiple @endif
        {{ $attributes->merge(['class' => 'js-select w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 text-sm']) }}>
        {{ $slot }}
    </select>
    @error($name)<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
</div>

@props(['app', 'size' => 'md'])
@php
    // Render the app's REAL logo from the suite registry (matches each app's own
    // nav). 'fill' = solid icon (else stroke). 'viewBox' for non-24 coord spaces.
    // FontAwesome (saas.php) is only a fallback if an app has no suite svg.
    $svg     = config('suite.products.'.$app.'.svg');
    $fill    = (bool) config('suite.products.'.$app.'.fill', false);
    $viewBox = config('suite.products.'.$app.'.viewBox', '0 0 24 24');
    $fa      = config('saas.products.'.$app.'.icon');
    $svgClass = ['xs' => 'w-3 h-3', 'sm' => 'w-4 h-4', 'md' => 'w-5 h-5', 'lg' => 'w-6 h-6'][$size] ?? 'w-5 h-5';
    $faClass  = ['xs' => 'text-[11px]', 'sm' => 'text-sm', 'md' => 'text-lg', 'lg' => 'text-xl'][$size] ?? 'text-lg';
@endphp
@if ($svg)
    @if ($fill)
        <svg class="{{ $svgClass }}" fill="currentColor" viewBox="{{ $viewBox }}" aria-hidden="true"><path d="{{ $svg }}"/></svg>
    @else
        <svg class="{{ $svgClass }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="{{ $viewBox }}" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $svg }}"/></svg>
    @endif
@elseif ($fa)
    <i class="{{ $fa }} {{ $faClass }}"></i>
@endif

@props(['active' => false])

@php
    $classes = 'block text-left px-3 text-sm leading-6
hover:bg-gray-300 focus:bg-gray-300';
    if ($active) $classes .='block text-left px-3 text-sm leading-6
hover:bg-gray-300 focus:bg-gray-300 bg-gray-400 text-bold';
@endphp

<a {{ $attributes (['class' => $classes])}}>
    {{ $slot }}
</a>

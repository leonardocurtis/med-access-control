@props(['active'])

@php
$classes = $active
    ? 'flex items-center gap-3 rounded-lg bg-blue-600 px-4 py-3 text-white shadow-md transition'
    : 'flex items-center gap-3 rounded-lg px-4 py-3 text-gray-600 transition hover:bg-gray-100 hover:text-gray-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
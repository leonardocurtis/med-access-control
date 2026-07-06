@props([
    'name',
    'size' => 'h-9 w-9'
])

@php
    $name = trim($name);

    $initial = $name !== ''
        ? strtoupper(mb_substr($name, 0, 1))
        : '?';

    $hash = crc32($name);
    $hue = abs($hash % 360);

    $background = "hsl({$hue},70%,45%)";
@endphp

<div
    class="{{ $size }} flex items-center justify-center rounded-full font-semibold text-white select-none"
    style="background-color: {{ $background }}"
>
    {{ $initial }}
</div>
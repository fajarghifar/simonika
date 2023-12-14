@props([
    'route'
])

<x-button {{ $attributes->class(['btn btn-outline-warning']) }} route="{{ $route }}">
    <i class="fa-solid fa-pen-to-square"></i>
    {{ $slot }}
</x-button>

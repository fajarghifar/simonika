@props([
    'route'
])

<x-button {{ $attributes->class(['btn btn-outline-info']) }} route="{{ $route }}">
    <i class="fa-solid fa-eye"></i>

    {{ $slot }}
</x-button>

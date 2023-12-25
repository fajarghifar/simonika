@props([
    'route'
])

<a href="{{ $route }}" {{ $attributes->class(['btn btn-icon btn-outline-success']) }}>
    <i class="fa-solid fa-plus me-2"></i>
</a>

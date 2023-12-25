@props([
    'route'
])

<form action="{{ $route }}" method="POST" class="d-inline-block">
    @csrf
    <x-button type="submit" {{ $attributes->class(['btn btn-outline-info']) }} onclick="return confirm('Apakah Anda yakin untuk memulihkan baris ini?')">
        <i class="fa-solid fa-arrow-rotate-left"></i>
        {{ $slot }}
    </x-button>
</form>

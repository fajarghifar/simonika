@props([
    'route'
])

<form action="{{ $route }}" method="POST" class="d-inline-block">
    @csrf
    @method('delete')
    <x-button type="submit" {{ $attributes->class(['btn btn-outline-danger']) }} onclick="return confirm('Apakah Anda yakin menghapus baris ini?')">
        <i class="fa-solid fa-trash"></i>
        {{ $slot }}
    </x-button>
</form>

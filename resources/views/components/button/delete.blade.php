@props([
    'route'
])

<form action="{{ $route }}" method="POST" class="d-inline-block">
    @csrf
    @method('delete')
    <x-button type="submit" {{ $attributes->class(['btn btn-outline-danger']) }} onclick="return confirm('Apakah Anda yakin menghapus baris ini?')">
        <x-icon.trash/>
        {{ $slot }}
    </x-button>
</form>

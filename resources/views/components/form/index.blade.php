@props([
    'action',
    'method',
    'class' => ''
])

<form action="{{ $action }}" method="POST" class="{{ $class }}">
    @csrf
    @method($method)

    {{ $slot }}
</form>

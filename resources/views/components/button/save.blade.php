@props([

])

<x-button type="submit" {{ $attributes->class(['btn btn-primary']) }}>
    {{ $slot }}
</x-button>

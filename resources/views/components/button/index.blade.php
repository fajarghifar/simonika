@props([
    'type' => null ?? 'button',
    'route',
    'onclick' => null ?? ''
])

@isset($route)
    <a href="{{ $route }}" {{ $attributes->class(['btn btn-primary']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class(['btn btn-primary']) }} onclick="{{ $onclick }}">
        {{ $slot }}
    </button>
@endisset

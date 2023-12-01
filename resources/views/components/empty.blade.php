@props([
    'title',
    'message',
    'buttonLabel',
    'buttonRoute'
])

<div class="empty">
    <div class="empty-icon">
        <x-icon.sad/>
    </div>
    <p class="empty-title">
        {{ $title }}
    </p>
    <p class="empty-subtitle text-secondary">
        {{ $message }}
    </p>
    <div class="empty-action">
        <a href="{{ $buttonRoute }}" class="btn btn-primary">
            <x-icon.plus/>
            {{ $buttonLabel }}
        </a>
    </div>
</div>

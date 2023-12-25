@props([
    'title',
    'message',
    'buttonLabel',
    'buttonRoute'
])

<div class="empty">
    <div class="empty-icon">
        <i class="fa-regular fa-face-frown"></i>
    </div>
    <p class="empty-title">
        {{ $title }}
    </p>
    <p class="empty-subtitle text-secondary">
        {{ $message }}
    </p>
    <div class="empty-action">
        <a href="{{ $buttonRoute }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-2"></i>
            {{ $buttonLabel }}
        </a>
    </div>
</div>

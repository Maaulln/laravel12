@props(['icon' => '🏆', 'title'])

<div class="award-banner">
    <div class="award-icon">{{ $icon }}</div>
    <div class="award-text">
        <strong>{{ $title }}</strong>
        {{ $slot }}
    </div>
</div>

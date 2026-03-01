@props(['name', 'value'])

<div class="skill-row">
    <div class="skill-name">
        <span>{{ $name }}</span>
        <span>{{ $value }}/100</span>
    </div>
    <div class="skill-bar-bg">
        <div class="skill-bar-fill" data-value="{{ $value }}"></div>
    </div>
</div>

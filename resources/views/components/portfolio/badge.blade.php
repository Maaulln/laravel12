@props(['icon', 'name'])

<div class="badge">
    <span class="badge-icon">{{ $icon }}</span>
    <div class="badge-name">{!! nl2br(e($name)) !!}</div>
    <div class="badge-unlocked">✔</div>
</div>

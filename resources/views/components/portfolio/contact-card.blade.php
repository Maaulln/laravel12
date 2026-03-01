@props(['icon', 'label', 'value', 'href' => null])

@if($href)
<a class="contact-card" href="{{ $href }}" @if(str_starts_with($href, 'http')) target="_blank" @endif>
@else
<div class="contact-card">
@endif
    <div class="contact-icon">{{ $icon }}</div>
    <div>
        <div class="contact-label">{{ $label }}</div>
        <div class="contact-value">{!! $value !!}</div>
    </div>
@if($href)
</a>
@else
</div>
@endif

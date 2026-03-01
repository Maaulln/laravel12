@props(['title', 'company', 'date', 'icon' => '⚔️'])

<div class="exp-card">
    <div class="exp-header">
        <div>
            <div class="exp-title">{{ $title }}</div>
            <div class="exp-company">{{ $icon }} {{ $company }}</div>
        </div>
        <div class="exp-date">{{ $date }}</div>
    </div>
    <div class="exp-body">
        {{ $slot }}
    </div>
</div>

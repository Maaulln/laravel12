{{--
    Message Detail
    Retro Game Console Theme
--}}
@extends('layouts.portfolio')

@section('title', 'Message – ' . ($message->subject ?? 'No Subject'))
@section('brand', 'MSG_READER.EXE v1.0')
@section('xp', '1500 / 3000')
@section('level', '03')

@section('content')
    {{-- Header --}}
    <div class="home-hero">
        <div class="glitch-container">
            <div class="glitch-text" data-text="MESSAGE">MESSAGE</div>
        </div>
        <div class="subtitle-line">
            <span class="bracket">[</span>
            <span class="typed-subtitle">TRANSMISSION DETAIL</span>
            <span class="bracket">]</span>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="msg-alert msg-success">
            <span class="msg-icon">✔</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Message Card --}}
    <div class="section-header">
        <span>📧 TRANSMISSION #{{ $message->id }}</span>
    </div>

    <div class="message-detail-card">
        <div class="detail-row">
            <span class="detail-label">FROM:</span>
            <span class="detail-value">{{ $message->name }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">EMAIL:</span>
            <span class="detail-value">{{ $message->email }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">SUBJECT:</span>
            <span class="detail-value">{{ $message->subject ?? '(No Subject)' }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">DATE:</span>
            <span class="detail-value">{{ $message->created_at->format('d M Y – H:i:s') }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">STATUS:</span>
            <span class="detail-value status-read">● READ</span>
        </div>

        <div class="detail-divider"></div>

        <div class="detail-message">
            <div class="detail-label" style="margin-bottom: 8px;">MESSAGE:</div>
            <div class="detail-body">{!! nl2br(e($message->message)) !!}</div>
        </div>
    </div>

    {{-- Actions --}}
    <div class="form-actions" style="margin-top: 20px;">
        <a href="{{ route('messages.index') }}" class="btn-retro btn-back">
            <span class="btn-icon">◀</span> BACK TO INBOX
        </a>
        <form method="POST" action="{{ route('messages.destroy', $message) }}" style="display: inline;" onsubmit="return confirm('DELETE this transmission? This action cannot be undone.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-retro btn-delete">
                <span class="btn-icon">🗑</span> DELETE
            </button>
        </form>
    </div>
@endsection

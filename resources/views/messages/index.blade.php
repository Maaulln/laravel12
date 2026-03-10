{{--
    Messages Inbox
    Retro Game Console Theme
--}}
@extends('layouts.portfolio')

@section('title', 'Messages – Inbox')
@section('brand', 'INBOX.EXE v1.0')
@section('xp', '1500 / 3000')
@section('level', '03')

@section('content')
    {{-- Header --}}
    <div class="home-hero">
        <div class="glitch-container">
            <div class="glitch-text" data-text="INBOX">INBOX</div>
        </div>
        <div class="subtitle-line">
            <span class="bracket">[</span>
            <span class="typed-subtitle">RECEIVED TRANSMISSIONS</span>
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

    <div class="section-header">
        <span>📨 MESSAGES ({{ $messages->total() }})</span>
    </div>

    {{-- Messages List --}}
    <div class="messages-list">
        @forelse($messages as $msg)
            <a href="{{ route('messages.show', $msg) }}" class="message-item {{ $msg->is_read ? 'read' : 'unread' }}">
                <div class="message-status">
                    @if($msg->is_read)
                        <span class="status-dot read-dot">●</span>
                    @else
                        <span class="status-dot unread-dot">◆</span>
                    @endif
                </div>
                <div class="message-content">
                    <div class="message-header-row">
                        <span class="message-sender">{{ $msg->name }}</span>
                        <span class="message-date">{{ $msg->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="message-subject">{{ $msg->subject ?? '(No Subject)' }}</div>
                    <div class="message-preview">{{ Str::limit($msg->message, 80) }}</div>
                </div>
            </a>
        @empty
            <div class="empty-inbox">
                <div class="empty-icon">📭</div>
                <p>NO TRANSMISSIONS RECEIVED YET</p>
                <p class="empty-sub">Inbox is empty. Waiting for incoming signals...</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($messages->hasPages())
        <div class="retro-pagination">
            {{ $messages->links() }}
        </div>
    @endif

    {{-- Navigation --}}
    <div class="form-actions" style="margin-top: 20px;">
        <a href="{{ url('/') }}" class="btn-retro btn-back">
            <span class="btn-icon">◀</span> BACK TO BASE
        </a>
    </div>
@endsection

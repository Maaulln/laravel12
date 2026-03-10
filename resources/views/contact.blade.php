{{--
    Contact / Send Message Page
    Retro Game Console Theme
--}}
@extends('layouts.portfolio')

@section('title', 'Contact – Send Message')
@section('brand', 'CONTACT.EXE v1.0')
@section('xp', '500 / 3000')
@section('level', '02')

@section('content')
    {{-- Header --}}
    <div class="home-hero">
        <div class="glitch-container">
            <div class="glitch-text" data-text="CONTACT">CONTACT</div>
        </div>
        <div class="subtitle-line">
            <span class="bracket">[</span>
            <span class="typed-subtitle">SEND A MESSAGE TO HQ</span>
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

    {{-- Contact Form --}}
    <div class="section-header">
        <span>📡 TRANSMISSION FORM</span>
    </div>

    <div class="contact-form-container">
        <form method="POST" action="{{ route('contact.store') }}" class="retro-form">
            @csrf

            {{-- Name --}}
            <div class="form-group">
                <label class="form-label" for="name">NAME <span class="required">*</span></label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-input @error('name') input-error @enderror"
                    value="{{ old('name') }}"
                    placeholder="ENTER YOUR CALLSIGN..."
                    required
                >
                @error('name')
                    <div class="error-text">⚠ {{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label" for="email">EMAIL <span class="required">*</span></label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-input @error('email') input-error @enderror"
                    value="{{ old('email') }}"
                    placeholder="ENTER YOUR EMAIL FREQUENCY..."
                    required
                >
                @error('email')
                    <div class="error-text">⚠ {{ $message }}</div>
                @enderror
            </div>

            {{-- Subject --}}
            <div class="form-group">
                <label class="form-label" for="subject">SUBJECT</label>
                <input
                    type="text"
                    id="subject"
                    name="subject"
                    class="form-input @error('subject') input-error @enderror"
                    value="{{ old('subject') }}"
                    placeholder="MISSION BRIEFING TITLE..."
                >
                @error('subject')
                    <div class="error-text">⚠ {{ $message }}</div>
                @enderror
            </div>

            {{-- Message --}}
            <div class="form-group">
                <label class="form-label" for="message">MESSAGE <span class="required">*</span></label>
                <textarea
                    id="message"
                    name="message"
                    class="form-input form-textarea @error('message') input-error @enderror"
                    rows="6"
                    placeholder="TYPE YOUR MESSAGE HERE..."
                    required
                >{{ old('message') }}</textarea>
                @error('message')
                    <div class="error-text">⚠ {{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="form-actions">
                <button type="submit" class="btn-retro btn-submit">
                    <span class="btn-icon">📤</span> TRANSMIT MESSAGE
                </button>
                <a href="{{ url('/') }}" class="btn-retro btn-back">
                    <span class="btn-icon">◀</span> BACK TO BASE
                </a>
            </div>
        </form>
    </div>

    {{-- Terminal Style Info --}}
    <div class="terminal-box" style="margin-top: 30px;">
        <div class="terminal-header">
            <span class="terminal-dot red"></span>
            <span class="terminal-dot yellow"></span>
            <span class="terminal-dot green"></span>
            <span class="terminal-title">contact@maulana:~</span>
        </div>
        <div class="terminal-body">
            <p class="terminal-line"><span class="prompt">$</span> echo "All fields marked with * are required"</p>
            <p class="terminal-line"><span class="prompt">$</span> echo "Your message will be stored securely"</p>
            <p class="terminal-line"><span class="prompt">$</span> echo "Response time: within 24-48 hours"</p>
            <p class="terminal-line"><span class="prompt">$</span> <span class="cursor-blink">_</span></p>
        </div>
    </div>
@endsection

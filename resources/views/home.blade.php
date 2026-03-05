{{--
    Home Page
    Retro Game Console Theme - matching about page style
--}}
@extends('layouts.portfolio')

@section('title', 'Home – Maulana Chandra Irawan')
@section('brand', 'HOME.EXE v1.0')
@section('xp', '1000 / 3000')
@section('level', '01')

@section('content')
    {{-- Welcome Hero Section --}}
    <div class="home-hero">
        <div class="glitch-container">
            <div class="glitch-text" data-text="WELCOME">WELCOME</div>
        </div>
        <div class="subtitle-line">
            <span class="bracket">[</span>
            <span class="typed-subtitle">TO MY DIGITAL REALM</span>
            <span class="bracket">]</span>
        </div>
        <div class="boot-sequence">
            <p class="boot-line">SYSTEM BOOT SEQUENCE INITIATED...</p>
            <p class="boot-line">LOADING MODULES: <span class="accent">■■■■■■■■■■</span> 100%</p>
            <p class="boot-line">STATUS: <span class="status-online">ONLINE</span></p>
        </div>
    </div>

    {{-- Quick Nav Cards --}}
    <div class="section-header">
        <span>🎮 SELECT YOUR DESTINATION</span>
    </div>

    <div class="nav-cards-grid">
        <a href="{{ url('/about') }}" class="nav-card">
            <div class="nav-card-icon">📜</div>
            <div class="nav-card-title">PROFILE</div>
            <div class="nav-card-desc">View my portfolio & achievements</div>
            <div class="nav-card-prompt">PRESS A TO CONTINUE &gt;</div>
        </a>

        <a href="#" class="nav-card">
            <div class="nav-card-icon">⚔️</div>
            <div class="nav-card-title">PROJECTS</div>
            <div class="nav-card-desc">Explore my latest works & quests</div>
            <div class="nav-card-prompt">COMING SOON...</div>
        </a>

        <a href="#" class="nav-card">
            <div class="nav-card-icon">📡</div>
            <div class="nav-card-title">CONTACT</div>
            <div class="nav-card-desc">Send a message to HQ</div>
            <div class="nav-card-prompt">PRESS B TO CONNECT &gt;</div>
        </a>

        <a href="#" class="nav-card">
            <div class="nav-card-icon">📚</div>
            <div class="nav-card-title">BLOG</div>
            <div class="nav-card-desc">Read my tech chronicles</div>
            <div class="nav-card-prompt">COMING SOON...</div>
        </a>
    </div>

    {{-- Featured Stats --}}
    <div class="section-header" style="margin-top: 30px;">
        <span>📊 QUICK STATS</span>
    </div>

    <div class="home-stats-grid">
        <div class="home-stat">
            <div class="stat-icon">🏆</div>
            <div class="stat-info">
                <div class="stat-number">10+</div>
                <div class="stat-label-sm">PROJECTS COMPLETED</div>
            </div>
        </div>
        <div class="home-stat">
            <div class="stat-icon">⚡</div>
            <div class="stat-info">
                <div class="stat-number">5+</div>
                <div class="stat-label-sm">YEARS EXPERIENCE</div>
            </div>
        </div>
        <div class="home-stat">
            <div class="stat-icon">🎯</div>
            <div class="stat-info">
                <div class="stat-number">∞</div>
                <div class="stat-label-sm">PASSION FOR CODE</div>
            </div>
        </div>
    </div>

    {{-- Terminal Style Footer --}}
    <div class="terminal-box" style="margin-top: 30px;">
        <div class="terminal-header">
            <span class="terminal-dot red"></span>
            <span class="terminal-dot yellow"></span>
            <span class="terminal-dot green"></span>
            <span class="terminal-title">terminal@maulana:~</span>
        </div>
        <div class="terminal-content">
            <p><span class="prompt">$</span> whoami</p>
            <p class="response">maulana-chandra-irawan</p>
            <p><span class="prompt">$</span> cat mission.txt</p>
            <p class="response">Building innovative AI/ML solutions for the future.</p>
            <p><span class="prompt">$</span> <span class="cursor-blink">_</span></p>
        </div>
    </div>
@endsection
